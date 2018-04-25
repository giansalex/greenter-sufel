<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 24/04/2018
 * Time: 21:35.
 */

namespace Greenter;

use Greenter\Notify\Attachment;
use Greenter\Notify\Notification;
use Greenter\Notify\NotificatorInterface;

/**
 * Class SufelPublisher.
 */
class SufelPublisher implements NotificatorInterface
{
    /**
     * @var SufelAdapter
     */
    private $sufel;

    /**
     * SufelPublisher constructor.
     *
     * @param SufelAdapter $sufel
     */
    public function __construct(SufelAdapter $sufel)
    {
        $this->sufel = $sufel;
    }

    /**
     * @param Notification $notification
     * @param array        $options
     *
     * @return mixed
     *
     * @throws \Sufel\Client\ApiException
     */
    public function notify(Notification $notification, $options = [])
    {
        $this->ensureLogin($options);

        $files = $notification->getFiles();
        $xml = $this->getFileFromType($files, 'xml');
        $pdf = $this->getFileFromType($files, 'pdf');

        return $this->sufel->publish($xml, $pdf);
    }

    /**
     * @param Attachment[] $files
     * @param string       $type
     *
     * @return string
     */
    private function getFileFromType($files, $type)
    {
        foreach ($files as $file) {
            if (strpos($file->getType(), $type) !== false) {
                return $file->getContent();
            }
        }

        return '';
    }

    /**
     * @param $options
     * @throws \Sufel\Client\ApiException
     */
    private function ensureLogin($options)
    {
        $credentials = $options['sufel'];

        if ($this->sufel->isAuthorized($credentials['user'])) {
            return;
        }

        $this->sufel->login($credentials['user'], $credentials['password']);
    }
}
