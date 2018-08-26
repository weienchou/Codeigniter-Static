<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api
{

    public static function _return($code = 1, $response = array())
    {
        $return = ['code' => intval($code)];

        if (!empty($response)) {
            $return['data'] = $response;
        }

        header('Content-Type: application/json');
        echo json_encode($return);
        exit();
    }
}
