<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 24/04/2018
 * Time: 22:18.
 */

namespace Tests\Greenter\Sufel;

use Greenter\SufelAdapter;

/**
 * Class SufelAdapterTest.
 */
class SufelAdapterTest extends \PHPUnit_Framework_TestCase
{
    use SufelAdapterTrait;
    /**
     * @var SufelAdapter
     */
    private $sufel;

    protected function setUp()
    {
        $this->sufel = $this->getSufelAdapter();
    }

    public function testLogin()
    {
        $this->sufel->login('20000000001', '123456');
        $this->assertTrue(true);
    }
}
