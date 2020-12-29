<?php

namespace Utilities\Validation;

use Utilities\Validate;

class ValidatePerson
{

    public static function validate($dni, $names, $lastNames, $email, $phone)
    {
        $alert = null;

        if (Validate::isEmpty($dni)) {
            $alert =  "Debe ingresar el documento de identidad";
        } elseif (Validate::isEmpty($dni) || !Validate::validateLength(7, 20, $dni)){
            $alert =  "El documento de identidad debe tener entre 7 y 20 caracteres";
        } elseif (Validate::isEmpty($names) || !Validate::validateLength(3, 30, $names)) {
            $alert =  "Los nombres deben estar entre 3 y 30 caracteres";
        } elseif (Validate::isEmpty($lastNames) || !Validate::validateLength(3, 30, $lastNames)) {
            $alert = "Los apellidos deben estar entre 3 y 30 caracteres";
        }elseif (Validate::isEmpty($email) || !Validate::isEmail($email)) {
            $alert =  "Debe ingresar el correo con referencia válida";
        } elseif (Validate::isEmpty($phone) || !Validate::validateLength(7, 20, $phone)) {
            $alert =  "El teléfono de contacto debe estar entre 7 y 20 caracteres";
        }

        return $alert;
    }

    public static function validatePerson($personId, $dni, $names, $lastNames, $email, $phone)
    {
        $alert = null;
        if (Validate::isEmpty($personId)) {
            $alert = "Identificador inválido";
        }else{
            $alert = self::validate($dni, $names, $lastNames, $email, $phone);
        }

        return $alert;
    }

}
