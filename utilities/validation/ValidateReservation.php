<?php

namespace Utilities\Validation;

use Utilities\Validate;

class ValidateReservation
{

    public static function validate($room, $person, $finalPrice, $state)
    {
        $alert = null;

        if (Validate::isEmpty($room)) {
            $alert =  "Debe seleccionar la habitación";
        } elseif (Validate::isEmpty($person)) {
            $alert =  "Debe seleccionar la persona";
        }elseif (!Validate::isEmpty($finalPrice) && $finalPrice < 10000 || $finalPrice > 1000000) {
            $alert =  "El precio final debe estar entre $10.0000 y $10 000.000";
        } elseif (Validate::isEmpty($state)) {
            $alert =  "Debe seleccionar el estado de la reservación";
        }

        return $alert;
    }

    public static function validateReservation($reservationId, $room, $person, $finalPrice, $state)
    {
        $alert = null;
        if (Validate::isEmpty($reservationId)) {
            $alert = "Identificador inválido";
        }else{
            $alert = self::validate($room, $person, $finalPrice, $state);
        }

        return $alert;
    }

}
