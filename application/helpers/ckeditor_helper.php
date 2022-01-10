<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

function jquery_ckeditor($data){
  $ck_options = "";
  if(isset($data["options"])){
    $options = $data["options"];
    if(is_array($options)){
      if(count($options) != 0){
        $ck_options .= "function(){\n";
        $index = 0;
        foreach($options as $opt_name => $opt_value){
          $ck_options .= ($index != 0) ? ", " : "";
          $ck_options .= $opt_name . ": " . $opt_value . "\n";
          $index++;
        }
        $ck_options .= "}";
      }
    }
  }

  $return  = "";
  $return .= "<script type=\"text/javascript\">\n";
  $return .= "<!--\n";
  $return .= "$(document).ready(function(){\n";
  $return .= "$( '#".$data['replace']."' ).ckeditor(".$ck_options.");\n";
  $return .= "});\n";
  $return .= "-->\n";
  $return .= "</script>\n";

  echo $return;
}