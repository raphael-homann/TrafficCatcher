<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 21/12/16
 * Time: 05:16
 */

namespace Efrogg\TrafficCatcher\Modifier;


use Efrogg\TrafficCatcher\Data\Data;

interface Modifier
{
    public function modify(Data $data);
}