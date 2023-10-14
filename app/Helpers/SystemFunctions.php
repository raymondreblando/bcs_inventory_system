<?php

namespace App\Helpers;

class SystemFunctions 
{
    public function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function randomString($length){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $string = '';
            for ($i = 0; $i < $length; $i++) {
                $string .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $string;
    }
    public function formatDateTime($date, $format){ 
        $formattedDate = date($format, strtotime($date));
        return $formattedDate;
    }
    public function notification($info, $icon, $duration, $event){
        $data = array(
            'identifier' => 'toast',
            'info' => $info,
            'icon' => $icon,
            'duration' => $duration,
            'event' => $event
        );
        header('Content-Type: application/json');
        $json = json_encode($data);
        echo $json;
    }
    public function html_fetch($value){
        $data = array(
            'identifier' => 'html',
            'value' => $value
        );
        header('Content-Type: application/json');
        $json = json_encode($data);
        echo $json;
    }
} 