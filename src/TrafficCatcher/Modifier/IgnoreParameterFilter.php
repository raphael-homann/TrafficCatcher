<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 21/12/16
 * Time: 05:16
 */

namespace Efrogg\TrafficCatcher\Modifier;


use Efrogg\TrafficCatcher\Data\Data;

class IgnoreParameterFilter implements Modifier
{

    protected $ignore_list = array();

    /**
     * IgnoreParameterFilter constructor.
     * @param array $ignore_list
     */
    public function __construct(array $ignore_list)
    {
        $this->ignore_list = $ignore_list;
    }


    public function modify(Data $data)
    {
        $exploded = parse_url($data->url);
        parse_str($exploded["query"],$params);
        foreach($params as $paramName=>$value) {
            if(in_array($paramName,$this->ignore_list)) {
                unset($params[$paramName]);
            }
        }
        $exploded["query"] = http_build_query($params);
        if(!empty($params)) {
            $data->url = $exploded["path"]."?".$exploded["query"];
        } else {
            $data->url = $exploded["path"];
       }

    }


}