<?php


namespace Utilities;

class Validate
{
    public static function validateMinLength($minLength, $field)
    {
        return (strlen($field) >= $minLength);
    }

    public static function validateMaxLength($maxLength, $field)
    {
        return (strlen($field) <= $maxLength);
    }

    public static function validateLength($minLength, $maxLength, $field)
    {
        return self::validateMinLength($minLength, $field)&&self::validateMaxLength($maxLength,$field);
    }

    public static function isEmpty($field)
    {
        $validate = false;
        if (!isset($field) || empty($field)) {
            $validate = true;
        }
        return $validate;
    }

    public static function isEmail($email)
    {
        $validate = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validate = true;
        }
        return $validate;
    }
}