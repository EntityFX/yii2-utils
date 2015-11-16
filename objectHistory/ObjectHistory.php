<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.11.15
 * Time: 14:20
 */

namespace entityfx\utils\objectHistory;


use yii\base\Component;
use yii\di\Container;

class ObjectHistory extends Component {

    const EVENT_OBJECT_CHANGED = "objectHistoryChanged";

    public function init() {
        $diConfig = include('di.php');
        $container = new Container();
        $container->setSingleton('ObjectHistoryMapper', $diConfig['mapper']);
        $container->setSingleton(
            'entityfx\utils\objectHistory\contracts\repositories\ObjectHistoryRepositoryInterface',
            function ($container, $params, $config) use ($diConfig) {
                return $container->get(
                    $diConfig['repository'],
                    [$container->get('ObjectHistoryMapper')]
                );
            }
        );
        $container->set(
            'entityfx\utils\objectHistory\contracts\ObjectHistoryManagerInterface',
            function ($container, $params, $config) use ($diConfig) {
                return $container->get(
                    $diConfig['manager'],
                    [
                        $container->get(
                            'entityfx\utils\objectHistory\contracts\repositories\ObjectHistoryRepositoryInterface'
                        )
                    ]
                );
            }
        );
        $this->initEventHandlers($container);
        parent::init();
    }

    protected function initEventHandlers(Container $container) {
        $this->on(self::EVENT_OBJECT_CHANGED, function(ObjectHistoryEvent $event) use ($container) {

            /** @var contracts\ObjectHistoryManagerInterface $objectHistoryManager */
            $objectHistoryManager = $container->get(
                'entityfx\utils\objectHistory\contracts\ObjectHistoryManagerInterface'
            );
            $objectHistoryManager->objectModified($event->historyType, $event->guid, $event->category);
        });
    }
}