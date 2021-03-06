<?php
namespace entityfx\utils\crypto;

use entityfx\utils\crypto\implementation\DefaultCryptoAlgorithm;
use entityfx\utils\crypto\CryptoAlgorithmEnum;
use entityfx\utils\crypto\CryptoAlgorithmInterface;

class CryptoFactory {

    const DEFULT_CRYPTO_INTERFACE = 'IDefaultCryptoAlgoritm';

    /**
     * @param CryptoAlgorithmEnum $algorithm
     *
     * @return CryptoAlgorithmInterface
     */
    public static function create(CryptoAlgorithmEnum $algorithm) {
        $cryptoInterface = self::resolveCryptoInterface($algorithm);
        if ($cryptoInterface !== self::DEFULT_CRYPTO_INTERFACE) {
            /** @var $ioc Phemto */
            $ioc = Yii::app()->ioc->container;
            return $ioc->create($cryptoInterface);
        } else {
            return new DefaultCryptoAlgorithm();
        }
    }

    private static function resolveCryptoInterface(CryptoAlgorithmEnum $algorithm) {
        switch ($algorithm->getValue()) {
            case CryptoAlgorithmEnum::XXTEA :
                return 'IXXTeaCryptoAlgorithm';
            case CryptoAlgorithmEnum::USE_DEFAULT :
            default :
                return self::DEFULT_CRYPTO_INTERFACE;
        }
    }
}