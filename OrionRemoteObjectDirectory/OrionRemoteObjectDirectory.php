<?php

class OrionRemoteObjectDirectory {
  
  private static $remoteDirectory;
  //{ className:session => { nodes => {nodeid,..}, 
  //                         class => className,
  //                         session => session
  //                       }

  public static function getEntry($className, $session=false){
    
    if($session == false){
      $session = 0;
    }
    return $remoteDirectory[$className.':'.$session];
    
  }

  public static function createEntry($className, $session=false){

    $nodeList = self::getNodes($className, $session);
    $remoteDirectory[$className.':'.$session] = array(
                                'nodes' => {$nodeList}, 'class' => $className, 
                                'session' => $session );
  }

  private static function getNodes($className, $session=false){

  }

  public static function checkEntry($className, $session=false){
    if($session == false){
      $session = 0;
    }
    if( isset($remoteDirectory[$className.':'.$session])){
      return true;
    }else{
      return false;
    }

}

?>

