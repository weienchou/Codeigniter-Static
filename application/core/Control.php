<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Control extends CI_Controller
{
    public static function _echo($file, $title = '', $data = [], $return = true, $header = 'text/html')
    {
        $file = $file . '.twig';
        if (preg_match("/^_/", $file)) {
            echo '[' . $file . '] can\'t render.';
            die();
        }

        $data = is_object($data) ? get_object_vars($data) : $data;
        $data['isDev'] = isDev();

        $html = self::_minify(twig()->render($file, [
            'data' => $data,
        ]));

        if ($return) {
            if (!headers_sent()) {
                header('Content-Type: ' . $header);
            }

            echo $html;
        } else {
            return $html;
        }
        exit();
    }

    private static function _minify($str)
    {
        $search = array(
            '/\>[^\S ]+/su',
            '/[^\S ]+\</su',
            '/(\s)+/su',
            '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/su',
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            '',
        );

        $buffer = preg_replace($search, $replace, $str);

        return $buffer;
    }
}
