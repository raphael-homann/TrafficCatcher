<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 03:53
 */

namespace Efrogg\TrafficCatcher\Trigger;


class GetParameterTrigger implements TriggerInterface
{
    protected $get_parameter_name = "tc";

    /**
     * GetParameterTrigger constructor.
     * @param string $get_parameter_name
     */
    public function __construct($get_parameter_name)
    {
        $this->get_parameter_name = $get_parameter_name;
    }

    /**
     * d�termine si le traffic doit etre capt�
     * @return bool
     */
    public function accept()
    {
       return isset($_GET[$this->get_parameter_name]) && !empty($_GET[$this->get_parameter_name]);
    }

    /**
     * Renvoie le nom de la session
     * @return String
     */
    public function getSessionName()
    {
        return $_GET[$this->get_parameter_name];
    }

    /**
     * d�termine si la capture doit etre stopp��e
     * @return mixed
     */
    public function refuse()
    {
        return isset($_GET[$this->get_parameter_name]) && empty($_GET[$this->get_parameter_name]);
    }
}