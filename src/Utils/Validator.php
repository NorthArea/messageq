<?php declare(strict_types=1);


namespace Northarea\PhpAmqp\Utils;

/**
 * Class Validator
 * @package Npsh\Lib\PhpAmqp\Utils
 */
class Validator
{
    /**
     * @param string $email
     * @return mixed
     */
    public function email(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param int $integer
     * @return mixed
     */
    public function integer($integer)
    {
        return filter_var($integer, FILTER_VALIDATE_INT);
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function url(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}