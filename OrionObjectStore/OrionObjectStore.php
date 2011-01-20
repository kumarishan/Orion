<?php

class OrionObjectStore {
  
  private static $objectStore = null;

  public static function createObject( $className, $session=false, $params = array() ){
    
    $obj = new $className($params);
    if( $session == false ){
      $objectStore[$className.':0'] = $obj;
    }else{
      $objectStore[$className.':'.$session] = $obj;
    }
     
  }

  public static function getObject( $className, $session=false){
    if($session == false ){
      return $objectStore[$className.':0'];
    }else{
      return $objectStore[$className.':'.$session];
    }
  }

  public static function destroyObject( $className, $session=false){
    if($session == false){
      $session = 0;
    }
    unset($objectStore[$className.':'.$session]);
  }
  
  public static function checkStore( $className , $session = false){
    if($session == false){
      $session = 0;
    }
    if( isset($objectStore[$className.':'.$session])){
      return true;
    }else {
      return false;
    }
  }
}

?>
