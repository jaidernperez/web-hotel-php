<?php

namespace Utilities\Validation;

use Utilities\Validate;

class ValidateUser
{

    public static function validate($role, $person, $userName, $password, $confirmPassword)
    {
        $alert = null;

        if (Validate::isEmpty($role)) {
            $alert = "Debe seleccionar el rol del usuario";
        } elseif (Validate::isEmpty($person)) {
            $alert = "Debe seleccionar la persona";
        } elseif (Validate::isEmpty($userName) || !Validate::validateLength(4, 20, $userName)) {
            $alert = "El nombre de usuario debe estar entre 4 y 20 caracteres";
        } elseif (Validate::isEmpty($password) || !Validate::validateLength(6, 20, $password)) {
            $alert = "La clave debe estar entre 6 y 20 caracteres";
        } elseif (Validate::isEmpty($confirmPassword) || $confirmPassword != $password) {
            $alert = "Las contraseñas no coinciden";
        }

        return $alert;
    }

    public static function validatePasswords($password, $newPassword, $confirmPassword)
    {
        $alert = null;

        if (Validate::isEmpty($password) || !Validate::validateLength(6, 20, $password)) {
            $alert = "La clave debe estar entre 6 y 20 caracteres";
        } elseif (Validate::isEmpty($newPassword) || !Validate::validateLength(6, 20, $newPassword)) {
            $alert = "La nueva clave debe estar entre 6 y 20 caracteres";
        } elseif (Validate::isEmpty($confirmPassword) || $confirmPassword != $newPassword) {
            $alert = "Las contraseñas no coinciden";
        }

        return $alert;
    }

    public static function validateUser($userId, $role, $person, $userName, $password, $confirmPassword)
    {
        $alert = null;
        if (Validate::isEmpty($userId)) {
            $alert = "Identificador inválido";
        } else {
            $alert = self::validate($role, $person, $userName, $password, $confirmPassword);
        }

        return $alert;
    }

}
