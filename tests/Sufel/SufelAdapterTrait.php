<?php
/**
 * Created by PhpStorm.
 * User: LPALQUILER-11
 * Date: 25/04/2018
 * Time: 11:55.
 */

namespace Tests\Greenter\Sufel;

use Greenter\Store\TokenStoreInterface;
use Greenter\SufelAdapter;
use Sufel\Client\Api\CompanyApi;
use Sufel\Client\Configuration;
use Sufel\Client\Model\AuthToken;

/**
 * Trait SufelAdapterTrait.
 *
 * @method \PHPUnit_Framework_MockObject_MockBuilder getMockBuilder($className)
 */
trait SufelAdapterTrait
{

    public function getSufelAdapter()
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setHost('http://localhost:8090/api');

        $api = new CompanyApi(null, $config);
        $sufel = new SufelAdapter($api);
        $sufel->setTokenStorage($this->getStore());

        return $sufel;
    }

    private function getStore()
    {
        $store = $this->getMockBuilder(TokenStoreInterface::class)->getMock();

        $store->method('get')->willReturn(null);

        $store->method('save')->willReturnCallback(function ($user, AuthToken $token) {
            var_dump($token);
        });

        /** @var $store TokenStoreInterface */
        return $store;
    }
}
