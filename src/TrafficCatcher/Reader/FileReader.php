<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 05:46
 */

namespace Efrogg\TrafficCatcher\Reader;


class FileReader extends SimpleReader
{

    protected $file_name;

    /**
     * FileReader constructor.
     * @param $file_name
     */
    public function __construct($file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * @param int $options
     * @return array
     */
    public function read($options=0)
    {
        $this->data = array();
        if ($fp = fopen($this->file_name, "r")) {
            while ($data = fgetcsv($fp)) {
                list($session_name,$url,$post) = $data;
                foreach($this->filters as $filter) {
                    if(!$filter->accept($session_name,$url,$post)) {
                        continue(2);    // saute a la session suivante dès le premier refus
                    }
                }
                if($options & ReaderOption::SESSION_NAME_ONLY) {
                    $this->data[$session_name]++;
                } else {
                    $this->data[$session_name][] = array(
                        "url" => $url,
                        "data" => $post
                    );
                }
            }
        }
    }

}