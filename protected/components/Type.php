<?php


class Type{
  public static function indexOf($type){
    $index=TypeIndex::model()->findByAttributes(array('type'=>$type))->id;
    if(isset($index))return $index;
    else return 0;
  }
}