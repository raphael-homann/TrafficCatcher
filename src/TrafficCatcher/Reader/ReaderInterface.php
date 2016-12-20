<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 05:46
 */

namespace Efrogg\TrafficCatcher\Reader;


interface ReaderInterface
{

    /**
     * @param int $options
     * @return array
     */
    public function read($options=0);

    /**
     * @param ReaderFilterInterface $filter
     */
    public function addFilter(ReaderFilterInterface $filter);

    /**
     * @return array
     */
    public function getData();

    /**
     * @return array
     */
    public function getSessions();
}