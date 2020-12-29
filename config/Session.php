<?php

namespace Config;

use Utilities\Hash;

class Session
{

    public static function init()
    {
        if(session_status()!=PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function destroy($key = FALSE)
    {
        if ($key) {
            if (is_array($key)) {
                for ($i = 0; $i < count($key); $i++) {
                    self::destroy($key[$i]);
                }
            } else {
                self::destroyKey($key);
            }
        } else {
            session_destroy();
        }
    }

    public static function set($key, $value)
    {
        if (!empty($key)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function setFlash($key, $value)
    {
        self::init();
        self::set($key, $value);
    }

    public static function setFlashWI($key, $value)
    {
        self::set($key, $value);
    }

    public static function getFlash($key)
    {
        self::init();
        return self::getFlashWi($key);
    }

    public static function getFlashWi($key)
    {
        $value = self::get($key);
        self::destroy($key);
        return $value;
    }

    public static function isAuthenticated()
    {
        Session::init();
        return Session::get("authenticated");
    }

    public static function isValidCredentials()
    {
        if (self::isAuthenticated()){
            $user_id = Session::get("user");
            $hash = Session::get("key");
            return Hash::basicHash($user_id) == $hash;
        }
        return false;
    }

    private static function destroyKey($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

}
