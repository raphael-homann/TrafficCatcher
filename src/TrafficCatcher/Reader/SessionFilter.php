<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 06:06
 */

namespace Efrogg\TrafficCatcher\Reader;


class SessionFilter implements ReaderFilterInterface
{

    protected $session_name;

    /**
     * SessionFilter constructor.
     * @param $session_name
     */
    public function __construct($session_name)
    {
        $this->session_name = $session_name;
    }


    public function accept($session_name, $url, $post)
    {
        return $session_name == $this->session_name;
    }
}