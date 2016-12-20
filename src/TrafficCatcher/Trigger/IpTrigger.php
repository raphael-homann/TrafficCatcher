<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 03:53
 */

namespace Efrogg\TrafficCatcher\Trigger;


class IpTrigger implements TriggerInterface
{

    protected $ratio = 100;

    /**
     * exemple : 10 = 1 / 10
     * @param int $ratio
     * @return IpTrigger
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
        return $this;
    }



    /**
     * détermine si le traffic doit etre capté
     * @return bool
     */
    public function accept()
    {
        /*
         * exemple :
         * 10% => 1/10 (100/10=10)
         * 20% = 1/5 (100/20 = 5)
         * 30% = 1/3 (100/30 = 3.333)
         */
        $accept = ip2long($_SERVER["REMOTE_ADDR"])%$this->ratio===0;
        return $accept;
    }

    /**
     * Renvoie le nom de la session
     * @return String
     */
    public function getSessionName()
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}