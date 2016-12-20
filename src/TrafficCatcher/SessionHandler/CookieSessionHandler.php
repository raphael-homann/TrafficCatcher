<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:05
 */

namespace Efrogg\TrafficCatcher\SessionHandler;


use Efrogg\TrafficCatcher\Trigger\TriggerInterface;

class CookieSessionHandler extends SimpleSessionHandler
{

    /**
     * @var string
     */
    protected $cookie_name;
    protected $cookie_path;

    public function __construct($cookie_name="tc",$cookie_path="/")
    {
        $this->cookie_name = $cookie_name;
        $this->cookie_path = $cookie_path;

        if(isset($_COOKIE[$cookie_name])) {
            parent::setSessionName($_COOKIE[$cookie_name]);
        }
    }

    public function setSessionName($sessionName)
    {
        parent::setSessionName($sessionName);
        setcookie($this->cookie_name,$sessionName,null,$this->cookie_path);
    }

    public function stop()
    {
        parent::stop();
        setcookie($this->cookie_name,'',time()-86400,$this->cookie_path);
    }

}