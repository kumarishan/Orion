<?php

class OrionScheduler {

  private static $objectList;

  public static function scheduleObject($className, $session = false, $params = array()){
    
    OrionObjectStore::createObject($className, $session, $params);
    OrionPersistence::iniPersistence($className, $session);

  }

  
  public static function isScheduled($className, $session=false){
    return OrionObjectStore::checkStore($className, $session);
  }

}




?>
