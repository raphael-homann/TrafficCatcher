<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 06:17
 */

namespace Efrogg\TrafficCatcher\Reader;


abstract class SimpleReader implements ReaderInterface
{


    /** @var  array */
    protected $data = array();

    /** @var  ReaderFilterInterface[] */
    protected $filters = array();

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param ReaderFilterInterface $filter
     * @return mixed
     */
    public function addFilter(ReaderFilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    public function getSessions() {
        return array_keys($this->data);
    }
}