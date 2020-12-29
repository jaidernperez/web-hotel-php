<?php


namespace Utilities;


class Hash
{
    public static function hashPwd($password){
        return hash("sha512", $password);
    }

    public static function basicHash($string){
        return hash("sha512", $string);
    }

}