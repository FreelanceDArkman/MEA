<?php


namespace App\Package;

class Curl
{

    private $ch;
    private $data;
    private $method = 'POST';

    public function __construct($function, $parameters, $method = 'POST', $url = '')
    {
//        $data = array("function" => "Login", "parameters" => [
//            array(
//                "session_id"=> "S1234",
//                "username"=>"1234567",
//                "pwd" => "aabb1213",
//                "os" => "Windows",                                              //Windows, Linux
//                "browser" => "Chrome",                                       //IE, Chrome, Firefox
//                "ip_address" => "202.168.55.199",
//                "access_channel" => "Mobile",                            //Mobile, Web
//                "device_id" => "712fewfwg1554fdwq",
//                "device_os" => "iOS"
//            )
//        ]);

        $this->method = $method;
        if(empty($url))
            $this->url = 'http://suntrue.sun-system.com:8043/meaws/meafund';
        $this->data = array("function" => $function, "parameters" => array($parameters));
    }


    public function getResult()
    {
        $data_string = json_encode($this->data);
        $this->ch = curl_init($this->url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($this->ch);
        return json_decode($result);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }

    public function objToArray($obj, &$arr){

        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }

        foreach ($obj as $key => $value)
        {
            if (!empty($value))
            {
                $arr[$key] = array();
                $this->objToArray($value, $arr[$key]);
            }
            else
            {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

}

