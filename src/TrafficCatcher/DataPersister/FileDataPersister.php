<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 04:11
 */

namespace Efrogg\TrafficCatcher\DataPersister;


use Efrogg\TrafficCatcher\Data\Data;

abstract class FileDataPersister implements DataPersisterInterface
{
    protected $storage_path = null;

    /**
     * FileDataPersister constructor.
     * @param null $storage_path
     */
    public function __construct($storage_path)
    {
        $this->storage_path = rtrim($storage_path,"/");
    }

    public function persist(Data $data, $session_name)
    {
        $file_name = $this->storage_path."/".$this -> getFileName($session_name).".log";
        $fp = fopen($file_name,"a");
        fputcsv($fp,array($session_name,$data->url,json_encode($data->data)));
        fclose($fp);
    }

    /**
     * @param $session_name
     * @return string
     */
    abstract protected function getFileName($session_name);
}