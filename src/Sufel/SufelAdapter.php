<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 24/04/2018
 * Time: 21:36
 */

namespace Greenter;

use Sufel\Client\Api\CompanyApi;
use Sufel\Client\Model\AuthToken;
use Sufel\Client\Model\CompanyCredential;
use Sufel\Client\Model\FilesDocument;

/**
 * Class SufelAdapter
 * @package Greenter
 */
class SufelAdapter
{
    /**
     * @var CompanyApi
     */
    private $api;

    /**
     * @var AuthToken
     */
    public $authToken;

    /**
     * SufelAdapter constructor.
     * @param CompanyApi $api
     */
    public function __construct(CompanyApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        if (!$this->authToken) {
            return false;
        }

        if (time() >= $this->authToken->getExpire()) {
            return false;
        }

        return true;
    }

    /**
     * Login Company
     *
     * @param string $user
     * @param string $password
     * @throws \Sufel\Client\ApiException
     */
    public function login($user, $password)
    {
        $result = $this->api->authCompany(new CompanyCredential([
            'ruc' => $user,
            'password' => $password,
        ]));

        $this->authToken = $result;
    }

    /**
     * @param string $xml
     * @param string $pdf
     * @return array Links
     * @throws \Sufel\Client\ApiException
     */
    public function publish($xml, $pdf)
    {
        $res = $this->api->addDocument(new FilesDocument([
            'xml' => $xml,
            'pdf' => $pdf,
        ]));

        return [
          'xml' => $res->getXml(),
          'pdf' => $res->getPdf(),
        ];
    }
}