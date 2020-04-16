<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UUID {

  //public static $namespace;
  //public static $name;

  const namesp = '11111111-1111-1111-1111-111111111111';

  public static function v3($name)
  {
    if(!self::is_valid(UUID::namesp)) return false;
    $nhex = str_replace(array('-','{','}'), '', UUID::namesp);
    $nstr = '';
    for($i = 0; $i < strlen($nhex); $i+=2)
    {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }
    $hash = md5($nstr . $name);
    return sprintf('%08s-%04s-%04x-%04x-%12s',
      substr($hash, 0, 8),
      substr($hash, 8, 4),
      (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,
      (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
      substr($hash, 20, 12)
    );
  }

  public static function v4()
  {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }

  public static function v5($name)
  {
    if(!self::is_valid(UUID::namesp)) return false;
    $nhex = str_replace(array('-','{','}'), '', UUID::namesp);
    $nstr = '';

    for($i = 0; $i < strlen($nhex); $i+=2)
    {
      $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    $hash = sha1($nstr . $name);
    return sprintf('%08s-%04s-%04x-%04x-%12s',
      substr($hash, 0, 8),
      substr($hash, 8, 4),
      (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
      (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
      substr($hash, 20, 12)
    );
  }

  public static function is_valid($uuid) {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
                      '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
  }
}
