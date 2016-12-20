<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 06:05
 */

namespace Efrogg\TrafficCatcher\Reader;


interface ReaderFilterInterface
{

    public function accept($session_name, $url, $post);
}