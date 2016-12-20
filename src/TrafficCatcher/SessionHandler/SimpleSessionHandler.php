<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:05
 */

namespace Efrogg\TrafficCatcher\SessionHandler;


class SimpleSessionHandler implements SessionHandlerInterface
{

    /** @var  string */
    protected $session_name;

    public function setSessionName($sessionName)
    {
        $this->session_name = $sessionName;
    }

    public function getSessionName()
    {
        return $this->session_name;
    }
}