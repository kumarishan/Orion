<?php

class OrionController {

  public static function getRemoteClassObject($className, $session=false){
  
    if(OrionRemoteObjectDirectory::checkEntry($className, $session) == false ){
     OrionRemoteObjectDirectory::createEntry($className, $session);
     $info = OrionRemoteObjectDirectory::getEntry($className, $session);
     $infoMessage = OrionRMS::getInfoMessage($info, 'REMOTEOBJECTCREATION');
     foreach($info['nodes'] as $node ){
       self::sendMessage($node, 'OrionController', $infoMessage);
     }
    }else{
      $info = OrionRemoteObjectDirectory::getEntry($className, $session);
    }
    $objStub = OrionRFC::getRemoteObjectStub($info);   
    return $objStub;

  }

  private static function enterRemoteObjectInfo($className, $session=false, $nodeList){
  
  }

  public static function sendMessage($node, $service, $message){

  }
  
  public static function fetchPackage($package){

  }

  public static function createLocalObject($className, $session=false, $params = array()){
    OrionScheduler::scheduleObject($className, $session, $params);
  }
}

?>
