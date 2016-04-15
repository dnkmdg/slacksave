<?php
  
  /*
    MySQL som förutsätts:
     
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
    Definiera användare som 'användare' => 'lösenord';    
    För att inte använda autentisering, kommentera bort definitionen "AUTH_USERS"
  */ 
  require_once 'class/auth.php';   
  $users = array("rick" => "astley");
  define('AUTH_USERS',auth::serialized_users($users));
  //Definiera namn på sidan
  define('AUTH_REALM','&lt;F/NHACKAT&gt;');  
  
  /* 
    Definiera uppgifter för databas-anslutning
  */   
  define('DBUSER','finhack');
  define('DBPASS','$t34MYf3Et+399');
  define('DBHOST','localhost');  
  define('DBNAME','finhack');  
  
  /* 
    Definiera Slack-token och Slack-team
  */   
  define('SL_TOKEN',json_encode(array(
    'introductions' => 'a9JKvsbr9rm5fwilFsVnZ1It',
    'jobb' => 'vQHtuG71hdRy9F8tAyIqjbNS'
  )));
  define('SL_TEAM','T0G7KTQ68');
  define('SL_API_TOKEN','xoxp-16257942212-32953202976-33412846918-0558901562');
  
  /*
    Definiera response-texter för Slacks bot att visa i kanalen.
    Om ingen text anges resulterar det i att Slack ignorerar. 
  */
  //Svar om meddelandet sparats. 
  define('RESPONSES',json_encode(array(
    'introductions' => "Tack så mycket! Din introduktion sparad för framtiden :). För att titta på din och andras presentationer, gå till http://apps.icatserver.com/finhackat/?channel=introductions \nAnv: rick \nPass: astley",
    'jobb' => "Tack för tipset, annonsen finns nu på http://apps.icatserver.com/finhackat/?channel=jobb \nAnv: rick \nPass: astley"
  )));
  //Svar om meddelandet inte sparats.
  define('RESPONSE_SAVED_FAIL','Något gick helt åt pipan. Säg till @foag.'); 
  //Svar om anropet innehåller fel enligt SL_TOKEN eller SL_TEAM.
  define('RESPONSE_CALL_ERROR','Felaktigt anrop från Slack');
  //Svar om AUTH_USERS ger fel anv/lösenord
  define('RESPONSE_AUTH_ERROR','Fel uppgifter, försök inte luras!');
  
  /*
    Definiera testdata (JSON från en utgående webhook-POST från Slack.
    Avkommentera för att testa utan att spamma kanaler som påverkas.
  */
  $testpost = '{"token":"a9JKvsbr9rm5fwilFsVnZ1It","team_id":"T0G7KTQ68","team_domain":"finhackat","service_id":"33218487348","channel_id":"C0S3HCBEU","channel_name":"introductions","timestamp":"1460226325.000157","user_id":"U0YU15YUQ","user_name":"foag","text":"intro testar slimmad kod","trigger_word":"intro"}';
  //define('TESTPOST',$testpost);
