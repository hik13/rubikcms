<?php

class Paginator {
  public static function getArrayForPagination($now,$count,$onPage,$link,$varname){
      $array=array();
      $num=ceil($count/$onPage);
      for ($i=1;$i<=$num;$i++) {
          if ($now==$i) {
          $array[$i]["active"]=true; 
          } else {
          $array[$i]["link"]="/".$link."/".$varname."/".$i;
          }
      }
      return $array;
  }
  
  public static function getPaginationContent(CController $cntrl,$array){
      if (!empty($array))
      return $cntrl->renderPartial('//common/pagging',array('pagination'=>$array),true);
  }
  
}

?>
