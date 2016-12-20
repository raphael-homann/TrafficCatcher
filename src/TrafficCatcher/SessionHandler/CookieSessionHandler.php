<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:05
 */

namespace Efrogg\TrafficCatcher\SessionHandler;


class CookieSessionHandler extends SimpleSessionHandler
{

    /**
     * @var string
     */
    protected $cookie_name;

    public function __construct($cookie_name="tc")
    {
        $this->cookie_name = $cookie_name;
    }
}