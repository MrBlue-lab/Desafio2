<?php

class Randomid {

    private static $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function generate_string($strength) {
        $input_length = strlen(self::$permitted_chars);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = self::$permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

}

/**
  class Password {
  const SALT = 'EstoEsUnSaltillo';
  public static function hash($password) {
  return hash('sha512', self::SALT, $password);
  }

  public static function verify($password, $hash) {
  return ($hash == self::hash($password));
  }
  }
class Bitacora {

    public static function write($texto) {
        try {
            $myfile = fopen("/home/daw205/Documentos/EjemplosPHP/Desafio2/auxiliar/bitacora.txt", "w+");
            $txt = $texto . "\n";
            fwrite($myfile, $txt);
            fclose($myfile);
        } catch (Exception $ex) {
            
        }
    }

}

 **/