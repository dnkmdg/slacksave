<?php
  class Slacker {
    function __construct(){
      if(defined('TESTPOST')) $_POST = json_decode(TESTPOST,true);
      
      if(isset($_POST,$_POST['token'],$_POST['team_id'])):
        $is_valid = Auth::validate_post($_POST);
        
        if($is_valid):   
          $this->save_post($_POST);
          die();
        else:
          $this->output_json(array('text'=>RESPONSE_CALL_ERROR));
          die();
        endif;
      else:
        $template = 'templates/main.php';
      
        if(defined('AUTH_USERS')):
          Auth::challenge($template);
        else:
          require_once($template);
        endif;
      endif;
    }
    
    function get_posts($channel,$unique = false){
      $sql = "
        SELECT
          user_name, user_avatar, timestamp, text 
        FROM 
          intro_post t1 
        WHERE ";
      if($unique):
        $sql .= "
          t1.id = (
            SELECT 
              t2.id
            FROM 
              intro_post t2
            WHERE 
              t2.user_name = t1.user_name           
            ORDER BY t2.id DESC
            LIMIT 1
          )
        AND ";
      endif;
      
      $sql .= " 
          channel_name = :channel
        ORDER BY `timestamp` desc;
      ";

      
      $presentations = Db::select($sql,'assoc',array(':channel'=>$channel));
      
      return $presentations;
    }
    
    function save_post($data){
      $binds = array_merge(array('id' => null),$data);
      $binds['user_avatar'] = $this->get_avatar($data['user_id']);
      
      $vals = implode(",",
                      array_map(
                        function($a){
                          return ':'.$a;
                        },array_keys($binds)
                       )
                     );
      $keys = implode(",",array_keys($binds));
      $sql = "INSERT INTO intro_post($keys) VALUES($vals)";
      
      try{
        Db::run($sql,$binds);
        $ret_val = array("text"=>Slacker::save_response($data['channel_name']));
      } catch(PDOException $ex){
        $ret_val = array("text"=>RESPONSE_SAVED_FAIL);      
      }       
      
      $this->output_json($ret_val);
    }
    
    function get_avatar($user_id){
      $url = 'https://slack.com/api/users.info?token='.SL_API_TOKEN.'&user='.$user_id;
      $response = json_decode(file_get_contents($url));
      
      if($response->ok == true && isset($response->user->profile->image_512)):
        return $response->user->profile->image_512;
      else:
        return '';
      endif;
      
    }
    
    function output_json($data){
      header('Content-Type: application/json');
      if(is_array($data)) $data = json_encode($data);
      echo $data;      
    }
    
    public static function format_text($text){
      if(substr($text, 0,6) == 'intro '):
        $text = substr($text, 6);
      endif;
      
      $text = preg_replace_callback("/<(.*?)>/", function($matches){
        $url = explode("|",$matches[1]);
        return '<a href="'.$url[0].'">'.$url[1].'</a>';
      }, $text);
      
      return nl2br($text);
    }
    public static function get_channels(){
      $sql = "
        SELECT 
          DISTINCT channel_name
        FROM
          intro_post
        ORDER BY 
          channel_name ASC
      ";
      
      return db::select($sql,'assoc');
    }
    public static function save_response($channel){
      $responses = json_decode(RESPONSES,true);
      return $responses[$channel];
    }
  }
