<?php

namespace SmartVoucher;

use kornrunner\Keccak;
use kornrunner\Secp256k1;

class Util {
  
  /**
   * sign message based on eth.account.sign
   * Utility function to sign message with a private key
   * return Signature string
   */
  public static function sign($message, $private_key) {
    $hashed_message = self::message_hash($message);
    
    $hash = str_replace('0x', '', $hashed_message);
    $private_key = str_replace('0x', '', $private_key);
    
    $secp256k1 = new Secp256k1();
    $signature = $secp256k1->sign($hash, $private_key);
    
    $r = gmp_strval($signature->getR(), 16);
    $s = gmp_strval($signature->getS(), 16);
    $recoveryParam = $signature->getRecoveryParam();
    
    
    
    return '0x' . $signature->r->toString(16) . $signature->s->toString(16) . '1c';
  }
  
  protected static function fromNat($val) {
    if ($val == '0x0') {
      return '0x';
    }
        
    if (strlen($val) % 2 === 0) {
      return $val;
    }
    
    return '0x0' . substr($val, 2);
  }
  
  protected static function pad($l, $hex) {
    if (strlen($hex) === ($l * 2 + 2)) {
      return $hex;
    }
    return self::pad($l, "0x0" . substr($hex, 2));
  }
  
  
  
  /**
   * encode signature according eth.account.sign
   */
  protected static function encodeSignature($v, $r, $s) {
    
  }
  
  /**
   * convert number to hex
   * @param $n - decimal number
   */
  protected static  function fromNumber($n) {
    $hex = dechex($n);
    if (strlen($hex) % 2 === 0) {
      return '0x' . $hex;
    }
    
    return '0x0' . $hex;
  }
  
  private static function message_hash($data) {
    $messageHex = str_replace('0x', '', $data);
    $messageBytes = pack("H*", $messageHex);
    $messageBuffer = unpack('H*', $messageBytes);
    $preamble = "\x19Ethereum Signed Message:\n" . strlen($messageBytes);
    $preambleBuffer = unpack('H*', $preamble);
    $ethMessage =  array_merge($preambleBuffer , $messageBuffer);
    $str_1 = pack("H*", $ethMessage[0]);
    $str_2 = pack("H*", $ethMessage[1]);
    
    $str = $str_1 . $str_2;
    $keccak = Keccak::hash($str, 256);
    return '0x' . $keccak;
  }
}
