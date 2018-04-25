<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 24/04/2018
 * Time: 22:08.
 */

namespace Greenter\Store;

use Sufel\Client\Model\AuthToken;

/**
 * Interface TokenStoreInterface.
 */
interface TokenStoreInterface
{
    /**
     * Get Token by user.
     *
     * @param string $user
     *
     * @return AuthToken
     */
    public function get($user);

    /**
     * Save token by user.
     *
     * @param string    $user
     * @param AuthToken $token
     */
    public function save($user, AuthToken $token);
}
