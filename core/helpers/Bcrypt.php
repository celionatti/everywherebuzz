<?php

/**
 * Bcrypt Trait
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 CelioNatti
 */

namespace app\core\helpers;

trait Bcrypt
{
    /**
     * Summary of hashPassword
     * Create a Password Hash.
     * creates a new password hash using a strong one-way hashing algorithm.
     * @param string $string
     * @param int $cost
     * @return string
     */
    public function hashPassword(string $string, int $cost = 12)
    {
        return password_hash($string, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    /**
     * Summary of comparePassword
     *
     * Verifies that the given hash matches the given password. password_verify() is compatible with crypt(). Therefore, password hashes created by crypt() can be used with password_verify().
     * @param mixed $password
     * @param mixed $hashPassword
     * @return bool
     */
    public function comparePassword($password, $hashPassword)
    {
        return password_verify($password, $hashPassword);
    }

    public function hash(string $string)
    {
        return hash('sha256', $string);
    }

    public function hashCheck(string $know_string, string $user_string)
    {
        return hash_equals($know_string, $user_string);
    }

}