<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:33
 */

namespace Efrogg\TrafficCatcher\DataPersister;



class FilePerSessionDataPersister extends FileDataPersister
{

    /**
     * @param $session_name
     * @return string
     */
    protected function getFileName($session_name)
    {
        return $session_name;
    }
}