<?php defined('BASEPATH') or exit('No direct script access allowed');

class mUser extends Model
{
    const FT = 'member';
    const PK = 'id';

    public static function one($acount = '')
    {
        return self::rows([
            'email' => $acount,
        ]);
    }
}
