<?php
  include "config.php";

  //login script
  if(isset($_POST['login'])){
    if(!isset($_POST['name']) || empty($_POST['name'])){
      echo json_encode(array('error'=>'name empty')); exit;
    }elseif (!isset($_POST['pass']) || empty($_POST['pass'])) {
      echo json_encode(array('error'=>'pass empty')); exit;
    }else{

        $db = new Database();
        $username = $db->escapeString($_POST['name']);
        $password = md5($db->escapeString($_POST['pass']));

        $db->select('admin','admin_id,admin_fullname',null,"username = '$username' AND password = '$password'",null,0);
        $result = $db->getResult();
        if(!empty($result)){
            if(count($result[0]) > 1){
                /* Start the Session */
                session_start();
                /* Set Session Variable */
                foreach($result as $row){
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['admin_fullname'] = $row['admin_fullname'];
                }

                echo json_encode(array('success'=>'true')); exit;
            }else{
              echo json_encode(array('success'=>'Username and password are not matched.')); exit;
            }
            
        }else{
            echo json_encode(array('error'=>'Username and password are not matched.')); exit;
        }
    }
  }

  //logout script
  if(isset($_POST['logout'])){
    /* start the session */
    session_start();
    /* remove all session variables */
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_fullname']);

    echo '1'; exit;
  }


  //Modify Password Script
  if(isset($_POST['edit-pass'])){
    if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
        echo json_encode(array('error'=>'Old Password Field is Empty.'));
    }else if(!isset($_POST['new_pass']) || empty($_POST['new_pass'])){
        echo json_encode(array('error'=>'New Password Field is Empty.'));
    }else{
        $db = new Database();

        $old_pass = md5($db->escapeString($_POST['old_pass']));
        $new_pass = md5($db->escapeString($_POST['new_pass']));

        if(!session_id()){ session_start(); }

        $id = $_SESSION['admin_id'];

        $db->select('admin','admin_id',null,"admin_id='{$id}' AND password='{$old_pass}'",null,null);
        $exist = $db->getResult();
        if(!empty($exist)){
            $db->update('admin',array('password'=>$new_pass),"admin_id= '{$id}' AND password = '{$old_pass}'");
            $response = $db->getResult();
            if(!empty($response)){
                echo json_encode(array('success'=>$response)); exit;
            }else{
                echo json_encode(array('error'=>'Password not changed.')); exit;
            }
        }else{
            echo json_encode(array('error'=>'Old Password is not matched.')); exit;
        }
    }
  }


  //change User Status
  if(isset($_POST['change-status'])){
    $db = new Database();

    $params = [

    ];
    
  }



?>
