<?php

namespace entityfx\utils\workers;

use entityfx\utils\exceptions\WorkerException;
use entityfx\utils\webService\WebClientProxyFactory;
use entityfx\utils\workers\contracts\repositories\WorkerData;
use entityfx\utils\workers\contracts\repositories\WorkerRepositoryInterface;
use entityfx\utils\workers\contracts\WorkerInterface;
use entityfx\utils\workers\contracts\WorkerSettings;
use entityfx\utils\workers\contracts\WorkerWithProxiesInterface;
use yii\base\Exception;
use yii\di\Container;

class WorkerFactory {
    /**
     * @param int $workerId
     *
     * @throws WorkerException
     * @return WorkerInterface
     */
    public static function createWorker($workerId) {
        $container = self::getIoc();
        /** @var $workerRepository WorkerRepositoryInterface */
        $workerRepository = $container->get('entityfx\utils\workers\contracts\repositories\WorkerRepositoryInterface');
        /** @var $workerData WorkerData */
        $workerData = $workerRepository->getById($workerId);
        if ($workerData == null) {
            throw new WorkerException("Worker doesn't exist", WorkerInterface::FAULT_WORKER_DOESNT_EXIST);
        }

        $workerSettings = new WorkerSettings();
        $workerSettings->workerData = $workerData;

        try {
            /** @var $worker WorkerInterface */
            $worker = $container->get($workerData->className, []);
            $worker->setWorkerSettings($workerSettings);
        } catch(Exception $exception) {
            throw new WorkerException("Cannot instantiate worker '{$workerData->className}'", WorkerInterface::FAULT_WORKER_DOESNT_EXIST, $exception);
        }
        /** @var $worker WorkerWithProxiesInterface */
        if ($worker instanceof WorkerWithProxiesInterface) {
            $workerWebClientProxyList = $workerRepository->getWorkerWebClientIdList($workerId);
            $webClientProxyList = self::createWebClientProxies($workerWebClientProxyList);
            $worker->setWebClientProxyList($webClientProxyList);
        }

        return $container->get('entityfx\utils\workers\contracts\WorkerInterceptorInterface', ['worker' => $worker]);

    }

    public static function createWorkerAndRun($workerId, array $args = null) {
        $worker = self::createWorker($workerId);

        if ($worker !== null) $worker->run($args);
    }

    /**
     * @return Container
     */
    private static function getIoc() {
        $diConfig = include('di.php');
        $container = new Container();
        $container->setSingleton('workerMapper', $diConfig['workerMapper']);
        $container->setSingleton(
            'entityfx\utils\workers\contracts\repositories\WorkerRepositoryInterface',
            function ($container, $params, $config) use ($diConfig) {
                return $container->get(
                    $diConfig['workerRepository'],
                    [$container->get('workerMapper')]
                );
            }
        );
        $container->set(
            'entityfx\utils\workers\contracts\WorkerInterceptorInterface',
            function ($container, $params, $config) use ($diConfig) {
                return $container->get(
                    $diConfig['workerInterceptor'],
                    [
                        $params['worker'],
                        $container->get('entityfx\utils\workers\contracts\repositories\WorkerRepositoryInterface')
                    ]
                );
            }
        );

        return $container;
    }

    public static function createWebClientProxies($proxyIdList) {
        $proxyList = [];
        foreach($proxyIdList as $proxyId) {
            $proxyList = array_merge($proxyList, WebClientProxyFactory::create($proxyId));
        }
        return $proxyList;
    }
}
