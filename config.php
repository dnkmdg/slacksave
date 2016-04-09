<?php
  
  /*
    MySQL:
     
    CREATE DATABASE `my_slack_db` DEFAULT CHARACTER SET = `utf8` DEFAULT COLLATE = `utf8_general_ci`;
    
    USE 'my_slack_db';
    
    CREATE TABLE `intro_post` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `token` varchar(24) DEFAULT NULL,
      `team_id` varchar(9) DEFAULT NULL,
      `team_domain` varchar(9) DEFAULT NULL,
      `service_id` varchar(11) DEFAULT NULL,
      `channel_id` varchar(9) DEFAULT NULL,
      `channel_name` varchar(13) DEFAULT NULL,
      `timestamp` varchar(17) DEFAULT NULL,
      `user_id` varchar(9) DEFAULT NULL,
      `user_name` varchar(36) DEFAULT NULL,
      `text` varchar(4000) DEFAULT NULL,
      `trigger_word` varchar(24) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  */

  /* 
    Define users as 'user' => 'password';    
    To disable authentication, simply comment out define('AUTH_USERS')
  */ 
  require_once 'class/auth.php';   
  $users = array(
    "user" => "pass",
    "user2" => "pass"
  );
  define('AUTH_USERS',auth::serialized_users($users));
  //Define realm name
  define('AUTH_REALM','NAME OF REALM');  
  
  /* 
    Define DB credentials
  */   
  define('DBUSER','');
  define('DBPASS','');
  define('DBHOST','');  
  define('DBNAME','');  
  
  /* 
    Define Slack token and Slack team to validate the call
  */   
  define('SL_TOKEN','');
  define('SL_TEAM','');
  
  /*
    Define response messages for the Slack bot to display in the channel.
    Empty messages are simply ignored
  */
  //Message saved
  define('RESPONSE_SAVED_SUCCESS','');
  //Message save failed
  define('RESPONSE_SAVED_FAIL',''); 
  //Error in Slack call (SL_TOKEN, SL_TEAM)
  define('RESPONSE_CALL_ERROR','');
  //Error in authentication
  define('RESPONSE_AUTH_ERROR','');
  
  /*
    Define testdata, data below is a dummy-post
    Uncomment to test without having to spam the channel
  */
  $testpost = '{"token":"a9JKvsbr9rm5fwilFsVnZ1It","team_id":"TXXXXXXX","team_domain":"test","service_id":"48618487348","channel_id":"C9S3ABCDE","channel_name":"introductions","timestamp":"1460226325.000157","user_id":"UXXXXXXXX","user_name":"rick_astley","text":"Never gonna give you up, never gonna let you down, never gonna run around and desert you","trigger_word":"intro"}';
  //define('TESTPOST',$testpost);
