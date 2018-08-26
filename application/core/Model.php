<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Model
{
    public static function rows($where, $condition = [])
    {
        $k = self::getKey();
        $data = md()->get(self::getTable(), '*',
            array_merge($where, $condition)
        );

        if (empty($data)) {
            return [];
        } else {
            return $data;
        }
    }

    private static function getTable($child = '')
    {
        $that = get_called_class();
        return constant($that . '::FT' . (($child) ? '_' . $child : ''));
    }

    private static function getKey($child = '')
    {
        $that = get_called_class();
        return constant($that . '::PK' . (($child) ? '_' . $child : ''));
    }

}
