<?php

class OrionController {

  public static function getRemoteClassObject($className, $session=false){
  
    $nodelList = OrionRemoteObjectDirectory::getNodes($className);

  }

  private static function enterRemoteObjectInfo($className, $session=false, $nodeList){
  
  }

  
}

?>
