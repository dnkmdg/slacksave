<?php
  class Auth{
    public static function challenge($validated_template){
      $valid_passwords = json_decode(AUTH_USERS,true);
      $valid_users = array_keys($valid_passwords);
      
      $user = hash("sha512",$_SERVER['PHP_AUTH_USER']);
      $pass = hash("sha512",$_SERVER['PHP_AUTH_PW']);
      
      $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
      
      if(!$validated):
        header('WWW-Authenticate: Basic realm="'.AUTH_REALM.'"');
        header('HTTP/1.0 401 Unauthorized');
        die (RESPONSE_AUTH_ERROR);
      else:
        require_once $validated_template;
      endif;
    }
    
    public static function serialized_users($users){
      $hashed_users = array();
      
      foreach($users as $u => $p):
        $hashed_users[hash("sha512",$u)] = hash("sha512",$p);
      endforeach;
      
      return json_encode($hashed_users);
    }
    
    public static function validate_post($post){
      return (SL_TOKEN == $post['token'] && SL_TEAM == $post['team_id']);
    }
  }
