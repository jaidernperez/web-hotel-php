<?php

namespace Utilities\Validation;

use Utilities\Validate;

class ValidateRoom
{

    public static function validate($roomType, $name, $price, $availability)
    {
        $alert = null;
        if (Validate::isEmpty($roomType)) {
            $alert = "Debe seleccionar el tipo de habitación";
        } elseif (Validate::isEmpty($name) || !Validate::validateLength(2, 30, $name)) {
            $alert = "Debe ingresar un nombre de habitación entre 2 y 30 caracteres";
        } elseif (Validate::isEmpty($price) || $price < 10000 || $price > 100000000) {
            $alert = "El precio debe estar entre $ 10 000 y 1 000 000";
        } elseif (Validate::isEmpty($availability)) {
            $alert = "Debe ingresar la disponibilidad de la habitación";
        }

        return $alert;
    }

    public static function validateRoom($roomId, $roomType, $name, $price, $availability)
    {
        $alert = null;
        if (Validate::isEmpty($roomId)) {
            $alert = "Identificador inválido";
        }else{
            $alert = self::validate($roomType, $name, $price, $availability);
        }

        return $alert;
    }

}
