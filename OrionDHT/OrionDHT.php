<?php
define ("KEYBITSIZE", 40);

class OrionDHT {
 
  private static $managerNodeId;
  private static $loadBalanceNodeId;
  private static $fingerTable;
  private static $managerSuccessor;
  private static $n;

  public static intialize($managerNode, $loadBalanceNode, $n){

    self::$managerNodeId = self::acquireManagerNodeId($managerNode);
    self::$loadBalanceNodeId = self::acquireLoadBalanceNodeId($loadBalanceNode);
    self::$n = $n;
    self::iniFingerTable();

  }

  //Chord DHT + Balanced binary tree based Id management + PNS
  private static function acquireManagerNodeId($node){
    
    $string = "";
    for( $i = 0; $i < 20; $i++){
      rand(1,26);
    }
    $c = 0.5
    $id = sha1($string);
    $id = base_convert($id, 16, 10);
    
    OrionRMS::createDHTSOAP("managerSuccessor",array("id" => $id));
    $r = OrionController::callOrionDHT("managerSuccessor", $node["ip"], $message);

    $successorSet = array(1 => $r);
    $prev = $r;
    for( $i = 2; $i < $c*log(self::$n+2, KEYBITSIZE); $i++){
      $message = OrionRMS::createDHTSOAP("getManagerSuccessor", array());
      $prev = OrionController::callOrionDHT("getManagerSuccessor", $prev["ip"], $message);
      $successorSet[$i] = $prev;
    }
    $max = 1;
    $maxRange = 0;
    for( $i = 1; $i < $successorSet; $i++){
      if($successorSet[$i+1] - $successorSet[$i] > $maxRange ){
        $maxRange = $successorSet[$i+1] - $successorSet[$i];
        $max = $i+1;
      }
    }
    $newId = ($successorSet[$max] + $successorSet[$max-1])/2;
     
     
        
  }

  
  public static function getManagerSuccessor(){
    return array("ip" => $fingerTable[1]["ip"], "id" => $fingerTable[1]["id"]);
  }


  public static function iniManagerFingerTable(){
    
  }

  public static function lookupManager($className, $session=false){
    if($session == false){
      $session = 0;
    }
    $key = $className.':'.$session;
    $key = sha1($key);
    $key = base_convert($key, 16, 10);
    self::managerSuccessor($key);

  }

  public static function managerSuccessor($id){
 
    if($id > self::$managerNodeId && $id <= self::$managerSuccessor){
      return array( "ip" => self::$fingerTable[1]["ip"], "id" => self::$managerSuccessor);
    }else{
      for( $i = KEYBITSIZE; $i >= 1; $i-- ){
        if( $fingerTable[$i] > self::$managerNodeId && $fingerTable[$i] <= $id && OrionStatistics::suggestHop($fingerTable[$i]["ip"]) ){
          $message = OrionRMS::createDHTSOAP("managerSuccessor", array("id" => $id));
          OrionController::callOrionDHT("managerSuccessor", $fingerTable[$i]["ip"], $message);
          break;
        }
      }
      return array( "ip" => self::$fingerTable[1]["ip"], "id" => self::$managerSuccessor);
    }
  }

  //Koorde
  public static function loadBalance($className, $message, $session=false){
    
  }

  private static function acquireLoadBalanceNodeId(){
    
  }

}

?>
