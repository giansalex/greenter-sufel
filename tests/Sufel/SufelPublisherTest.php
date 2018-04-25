<?php
/**
 * Created by PhpStorm.
 * User: LPALQUILER-11
 * Date: 25/04/2018
 * Time: 12:02
 */

namespace Tests\Greenter\Sufel;

use Greenter\Notify\Attachment;
use Greenter\Notify\Notification;
use Greenter\SufelPublisher;

class SufelPublisherTest extends \PHPUnit_Framework_TestCase
{
    use SufelAdapterTrait;
    /**
     * @var SufelPublisher
     */
    private $publisher;

    protected function setUp()
    {
        $adapter = $this->getSufelAdapter();
        $this->publisher = new SufelPublisher($adapter);
    }

    public function testNotify()
    {
        $notification = $this->getNotification();

        $links = $this->publisher->notify($notification, [
            'sufel' => [
                'user'     => '20000000001',
                'password' => '123456',
            ]
        ]);

        $this->assertNotEmpty($links['xml']);
        $this->assertNotEmpty($links['pdf']);

        var_dump($links);
    }

    private function getNotification()
    {
        $notification = new Notification();
        $notification->setFiles([
            (new Attachment())
                ->setName('20000000001-01-F001-177.xml')
                ->setType('text/xml')
                ->setContent(file_get_contents(__DIR__ . '/../Resources/20000000001-01-F001-177.xml')),
            (new Attachment())
                ->setName('20000000001-01-F001-177.pdf')
                ->setType('application/pdf')
                ->setContent(file_get_contents(__DIR__ . '/../Resources/20000000001-01-F001-177.pdf')),
        ]);

        return $notification;
    }
}