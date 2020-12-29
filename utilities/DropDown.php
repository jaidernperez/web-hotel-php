<?php


namespace Utilities;


class DropDown
{
    public static function show($id, $records, $style, $msg, $idSelected, $event): string
    {
        $xhtml = "<select class='{$style}' id='{$id}' name='{$id}'>\n";
        if (!empty($msg)) {
            $xhtml .= "<option value=''>{$msg}</option>\n";
        }
        foreach ($records as $key => $record) {
            if ($key == $idSelected) {
                $xhtml .= "<option  value='{$key}' selected >{$record}</option>\n";
            } else {
                $xhtml .= "<option  value='{$key}'>{$record}</option>\n";
            }
        }
        $xhtml .= " </select>";
        return $xhtml;
    }
}