<?php
class OrionObjectStore {
  
  private static $objectStore = null;

  public static function createObject( $filename, $className, $session=false ){
    
    //get the code from the remote
   
    //load the file
    include $filename;

    $obj = new $className;
    if( $session == false ){
      $objectStore[$className.':0'] = $obj;
    }else{
      //call some of the initialization from persistent controller

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

}
?>
