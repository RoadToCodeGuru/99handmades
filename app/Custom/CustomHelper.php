<?php

namespace App\Custom;

class CustomHelper 
{
      public function getActualOperatorAndPhoneNumber($phone_number){
        $phone_number = $phone_number;
        $first_number = substr($phone_number, 0, 1);
        $start_number = substr($phone_number, 0, 3);
        $phone_length = strlen($phone_number);
        $operator = 'no_operator';
        // replace with 95 with 0 if phone number starts with 09
        if($first_number == 0){
          $phone_number = "95".substr($phone_number, 1);
        }elseif($first_number == 9){
          if($start_number == "959"){
            if($phone_length == 8){ // 959 can be 9 + mpt start with 59
              $operator = 'MPT'; //MPT
              return array($operator, "95".$phone_number);
            }elseif($phone_length == 9){ // 959 can be a pure ooredoo
              $operator = 'OOREDOO'; // Ooredoo
              return array($operator, "959".$phone_number);
            }
          }else{ // add 95 because already started with 9
              if($this->isOoredoo("959".$phone_number)){
                  $operator = 'OOREDOO';
                  return array($operator, "959".$phone_number);
              }
            $phone_number = "95".$phone_number;
          }
        }else{
          $phone_number = "959".$phone_number;
        }
        if($this->is_mpt($phone_number)){
          $operator = 'MPT'; // MPT
        }elseif($this->isTelenor($phone_number)){
          $operator = 'TELENOR'; //Telenor
        }elseif($this->isOoredoo($phone_number)){
          $operator = 'OOREDOO'; // Ooredoo
        }elseif($this->isMytel($phone_number)){
          $operator = 'MYTEL'; // Mytel
        }elseif($this->isMec($phone_number)){
          $operator = 'MEC'; // MEC
        }
        return array($operator, $phone_number);
      }
    
      
      function is_mpt($phone){
    
        $is_mpt = false;
    
        $first_4 = substr($phone,0,4);
        $first_5 = substr($phone,0,5);
    
        $ph_length = strlen($phone);
    
        switch ($first_4) {
            
            case '9592':
                if($ph_length == 10){
                    $is_mpt = true;
                }
                elseif ($ph_length == 12) {
                    if($first_5 == '95925' || $first_5 == '95926'){
                        $is_mpt = true;
                    }
                }
                
                break;
    
    
            case '9594':
                if($ph_length == 11){
                    if($first_5 == '95941' || $first_5 == '95943'){
                        $is_mpt = true;
                    }
                    
                }
                elseif ($ph_length == 12) {
                    if($first_5 == '95940' || $first_5 == '95942' || $first_5 == '95944' || $first_5 == '95945'){
                        $is_mpt = true;
                    }
                }
                
                break;
    
            case '9595':
                if($ph_length == 10){
                    $is_mpt = true;
                }
                
                break;
    
    
            case '9598':
                if($ph_length == 12){
                    if($first_5 == '95989' || $first_5 == '95988'){
                        $is_mpt = true;
                    }
                    
                }
                
                break;
    
            
            default:
                # code...
                break;
        }
        return $is_mpt;
      }
      function isTelenor($phone = ""){
        $is_telenor = false;
        $start_number = substr($phone, 0, 4);
        $phone_length = strlen($phone);
        if($start_number == "9597" && $phone_length == 12){
          $is_telenor = true;
        }
        return $is_telenor;
      }
      function isOoredoo($phone = ""){
        $is_ooredoo = false;
        $start_number = substr($phone, 0, 4);
        $phone_length = strlen($phone);
        if($start_number == "9599" && $phone_length == 12){
          $is_ooredoo = true;
        }
        return $is_ooredoo;
      }
      function isMyTel($phone = ""){
        $is_mytel = false;
        $start_number = substr($phone, 0, 4);
        $phone_length = strlen($phone);
        if($start_number == "9596" && $phone_length == 12){
          $is_mytel = true;
        }
        return $is_mytel;
      }
      function isMec($phone = ""){
        $is_mec = false;
        $start_number = substr($phone, 0, 4);
        $phone_length = strlen($phone);
        if($start_number == "9593"){
          if($phone_length == 11){
            $is_mec = true;
          }elseif($start_number == "95934" && $phone_length == 12){
            $is_mec = true;
          }
        }
        return $is_mec;
      }
}