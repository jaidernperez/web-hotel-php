<?php

namespace Utilities;

class Alert
{
    public static function setAlert($icon, $title, $text)
    {
        echo "
    <script>
        Swal.fire({
            icon: '$icon',
            title: '$title',
            text: '$text'
        })
    </script>";
    }

    public static function getAlert($icon, $title, $text)
    {
        return "
    <script>
        Swal.fire({
            icon: '$icon',
            title: '$title',
            text: '$text'
        })
    </script>";
    }
}