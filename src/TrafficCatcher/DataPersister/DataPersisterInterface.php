<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:11
 */

namespace Efrogg\TrafficCatcher\DataPersister;


use Efrogg\TrafficCatcher\Data\Data;

interface DataPersisterInterface
{
    public function persist(Data $data,$session_name);
}