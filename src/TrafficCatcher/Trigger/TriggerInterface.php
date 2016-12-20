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
     * détermine si le traffic doit etre capté
     * @return bool
     */
    public function accept();

    /**
     * Renvoie le nom de la session
     * @return String
     */
    public function getSessionName();

    /**
     * détermine si la capture doit etre stoppéée
     * @return mixed
     */
    public function refuse();
}