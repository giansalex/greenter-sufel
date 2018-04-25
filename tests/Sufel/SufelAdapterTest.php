<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 24/04/2018
 * Time: 22:18
 */

namespace Tests\Greenter\Sufel;

use Greenter\SufelAdapter;
use Sufel\Client\Api\CompanyApi;
use Sufel\Client\Configuration;

class SufelAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SufelAdapter
     */
    private $sufel;

    protected function setUp()
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setHost('http://localhost:8090/api');

        $api = new CompanyApi(null, $config);
        $this->sufel = new SufelAdapter($api);
    }

    public function testLogin()
    {
        $this->assertTrue(true);
    }
}