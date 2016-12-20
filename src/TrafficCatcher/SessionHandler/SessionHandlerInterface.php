<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:07
 */

namespace Efrogg\TrafficCatcher\SessionHandler;


interface SessionHandlerInterface
{
    public function setSessionName($sessionName);

    public function getSessionName();

    public function stop();
}