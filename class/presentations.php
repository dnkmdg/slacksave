<?php
  class Presentations {
    function __construct(){
      if(defined('TESTPOST')) $_POST = json_decode(TESTPOST,true);
      
      if(isset($_POST,$_POST['token'],$_POST['team_id'])):
        $is_valid = Auth::validate_post($_POST);
        
        if($is_valid):   
          $this->save_presentation($_POST);
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
    
    function get_presentations(){
      $sql = "
	      SELECT
		      user_name, timestamp, text 
		    FROM 
		      intro_post t1 
		    WHERE 
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
        ORDER BY user_name;
      ";
      
		  $presentations = Db::select($sql,'assoc');
		  
		  return $presentations;
    }
    
    function save_presentation($data){
      $binds = array_merge(array('id' => null),$data);
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
        $ret_val = array("text"=>RESPONSE_SAVED_SUCCESS);
      } catch(PDOException $ex){
        $ret_val = array("text"=>RESPONSE_SAVED_FAIL);      
      }       
      
      $this->output_json($ret_val);
    }
    
    function output_json($data){
      header('Content-Type: application/json');
      if(is_array($data)) $data = json_encode($data);
      echo $data;      
    }
  }
