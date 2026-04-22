<?php
  
if (!function_exists('set_active')){
  function set_active($uri,$output = 'active' ){
    if (is_array($uri)) {
      foreach ($uri as $u) {
        if(Route::is($u)) {
          return $output;
        }
      }
    } else {
      # code...
      if(Route::is($uri)){
        return $output;
      }
    }
  }
}

if (!function_exists('set_open')){
  function set_open($uri,$output = 'open' ){
    if (is_array($uri)) {
      foreach ($uri as $u) {
        if(Route::is($u)) {
          return $output;
        }
      }
    } else {
      # code...
      if(Route::is($uri)){
        return $output;
      }
    }
  }
}