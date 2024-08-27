<?php

namespace app\services;

class Validate{

   private static $valid = ["080","081","090","091","070"];
   public static function checkSpecialChar($str){
    return preg_match('/[\'^$%&*()}{@#~?><>,| =_+-]/',$str)===1;
   }

   public static function checkString($str){
      return ctype_alpha($str) === false;
   }

   public static function checkDigit($str){
      return ctype_digit($str) === false;
   }

   public static function phone($str){
      $start_of_num = str_split($str,3)[0];
      $result = array_filter(self::$valid,function($entry) use($start_of_num){
         if($entry == $start_of_num){
            return true;
         }
      });

      if($result){
         return true;
      }else{
         return false;
      }
   }
}