<?php
  
class OrionLoadBalancer {

  public static function loadBalance($message, $className, $session=false){
    
    //implements Load balancing level DHT with de bruign graph Koorde like
    //O(logn/loglogn) hops and O(logn) neighbours
    //simple node join and remove operation
    //this network is not going to be large somewhat 4 to 10 in size
    //will be called by OrionController when it thinks tha its time to load balance 
    //the request.....

  }


}

?>

