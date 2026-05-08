<?php

class AuthMiddlewareWeb {

  public static function isLogin() {
    if (isset($_SESSION['token'])) {
      return true;
    } else {
      return false;  
    }
  }
}