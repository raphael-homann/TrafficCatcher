<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 03:54
 */

namespace Efrogg\TrafficCatcher\Trigger;


interface TriggerInterface
{
    /**
     * d�termine si le traffic doit etre capt�
     * @return bool
     */
    public function accept();

    /**
     * Renvoie le nom de la session
     * @return String
     */
    public function getSessionName();

    /**
     * d�termine si la capture doit etre stopp��e
     * @return mixed
     */
    public function refuse();
}