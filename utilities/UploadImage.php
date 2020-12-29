<?php


namespace Utilities;


use Exception;

class UploadImage
{
    private $destinationFolder;
    private $maxSize;
    private $extensions;
    private $startName;

    public function __construct($destinationFolder, $maxSize, $extensions, $startName)
    {
        $this->destinationFolder = $destinationFolder;
        $this->maxSize = $maxSize;
        $this->extensions = $extensions;
        $this->startName = $startName;
    }

    public function uploadFile($fileBrowse)
    {
        $result = [];
        $result["status"] =  false;

        $size = $_FILES[$fileBrowse]["size"];
        $name = $_FILES[$fileBrowse]["name"];
        $ext = $this->getExtension($name);
        if (!is_dir($this->destinationFolder)) {
            $result["error"] = "El destino no es un directorio";
        } else if (!is_writable($this->destinationFolder)) {
            $result["error"] = "El destino no se puede escribir";
        } else if (empty($name)) {
            $result["error"] = "Archivo no especificado";
        } else if ($size > $this->maxSize) {
            $result["error"] = "Archivo demasiado grande";
        } else if (in_array($ext, $this->extensions)) {
            $uploadName = $this->getRandomName() . "." . $ext;
            if (move_uploaded_file($_FILES[$fileBrowse]["tmp_name"], $this->destinationFolder . $uploadName)) {
                $result["status"] =  true;
                $result["name"] = $uploadName;
            } else {
                $result["error"] = "Error al subir el archivo";
            }
        } else {
            $result["error"] = "Formato de archivo invalido";
        }
        return $result;
    }

    private function getRandomName(){
       return $this->startName . "-" . substr(md5(rand(1111, 9999)), 0, 8) . $this->getRandom() . rand(1111, 1000) . rand(99, 9999);
    }

    private function getRandom()
    {
        return strtotime(date('Y-m-d H:i:s')) . rand(1111, 9999) . rand(11, 99) . rand(111, 999);
    }

    private function getExtension($string)
    {
        try {
            $parts = explode(".", $string);
            $ext = strtolower($parts[count($parts) - 1]);
        } catch (Exception $c) {
            $ext = null;
        }
        return $ext;
    }
}