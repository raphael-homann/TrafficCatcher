<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 05:46
 */

namespace Efrogg\TrafficCatcher\Reader;


class PathReader extends SimpleReader
{

    protected $path;


    /**
     * FileReader constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = rtrim($path);
    }


    public function read($options=0)
    {
        $this->data=array();
        $fileList = glob($this->path."/*.log");
        usort($fileList, function($a,$b) {
            return filemtime($a) - filemtime($b);
        });

        foreach($fileList as $file_name) {
            $freader = new FileReader($file_name);
            foreach($this->filters as $filter) {
                $freader->addFilter($filter);
            }
            $freader->read($options);
            $this->mergeData($freader->getData(),$options);
        }
        return $this->data;
    }

    protected function mergeData($read,$options)
    {
        if($options & ReaderOption::SESSION_NAME_ONLY) {
            foreach($read as $session_name=>$count) {
                $this->data[$session_name]+=$count;
            }
        } else {
            foreach($read as $session_name=>$pages) {
                foreach($pages as $page) {
                    $this->data[$session_name][]=$page;
                }
            }
        }
    }

}