<?php


namespace App\Helpers;


class Strings
{
    public static function phone($phone)
    {
        $phone = str_replace('.','',$phone);
        $phone = str_replace('-','',$phone);
        $phone = str_replace('(','',$phone);
        $phone = str_replace(')','',$phone);
        $phone = str_replace(' ','',$phone);

        $dd = substr($phone,0,2);

        return '(' . $dd . ')' . substr($phone,2);
    }
}
