<?php 
    include '../admin/php_files/config.php';

    //login script
    if(isset($_POST['login'])){
        if(!isset($_POST['name']) || empty($_POST['name'])){
        echo json_encode(array('error'=>'Username empty')); exit;
        }elseif (!isset($_POST['pass']) || empty($_POST['pass'])) {
        echo json_encode(array('error'=>'password empty')); exit;
        }else{

            $db = new Database();
            $username = $db->escapeString($_POST['name']);
            $password = md5($db->escapeString($_POST['pass']));

            // $db->sql("(SELECT id,name FROM user WHERE username='$username' AND password='$password') UNION (SELECT id,donor_name FROM donor WHERE email='$username' AND password='$password')");
            if($_POST['user_type'] == 'User'){
                $db->select('user','id,name',null,"username = '$username' AND password = '$password'",null,0);
                $result = $db->getResult();
                if(!empty($result)){
                    if(count($result[0]) > 1){
                        /* Start the session */
                        session_start();
                        /* Set Session variable */
                        foreach($result as $row){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['user_type'] = 'user';
                        }

                        echo json_encode(array('success'=>'Logged In Successfully.')); exit;
                    }else{
                        echo json_encode(array('success'=>'Username and password are not matched.')); exit;
                    }
                }else{
                    echo json_encode(array('error'=>'Username and password are not matched.')); exit;
                }
            }else if($_POST['user_type'] == 'Donor'){
                $db->select('donor','id,donor_name',null,"email = '$username' AND password = '$password'",null,0);
                $result = $db->getResult();
                if(!empty($result)){
                    if(count($result[0]) > 1){
                        /* Start the session */
                        session_start();
                        /* Set Session variable */
                        foreach($result as $row){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['name'] = $row['donor_name'];
                            $_SESSION['user_type'] = 'donor';
                        }

                        echo json_encode(array('success'=>'Logged In Successfully.')); exit;
                    }else{
                        echo json_encode(array('success'=>'Username and password are not matched.')); exit;
                    }
                }else{
                    echo json_encode(array('error'=>'Username and password are not matched.')); exit;
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
        unset($_SESSION['id']);
        unset($_SESSION['name']);

        echo '1'; exit;
    }

    //Modify Password Script
    if(isset($_POST['modify-pass'])){
        if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
            echo json_encode(array('error'=>'Old Password Field is Empty.'));
        }else if(!isset($_POST['new_pass']) || empty($_POST['new_pass'])){
            echo json_encode(array('error'=>'New Password Field is Empty.'));
        }else{
            $db = new Database();

            $old_pass = md5($db->escapeString($_POST['old_pass']));
            $new_pass = md5($db->escapeString($_POST['new_pass']));

            if(!session_id()){ session_start(); }

            if($_SESSION['user_type'] == 'user'){
                $id = $_SESSION['id'];
                $db->select('user','id',null,"id='{$id}' AND password='{$old_pass}'",null,null);
                $exist = $db->getResult();
                if(!empty($exist)){
                    $db->update('user',array('password'=>$new_pass),"id= '{$id}' AND password = '{$old_pass}'");
                    $response = $db->getResult();
                    if(!empty($response)){
                        echo json_encode(array('success'=>$response)); exit;
                    }else{
                        echo json_encode(array('error'=>'Password not changed.')); exit;
                    }
                }else{
                    echo json_encode(array('error'=>'Old Password is not matched.')); exit;
                }
            }else if($_SESSION['user_type'] == 'donor'){
                $id = $_SESSION['id'];
                $db->select('donor','id',null,"id='{$id}' AND password='{$old_pass}'",null,null);
                $exist = $db->getResult();
                if(!empty($exist)){
                    $db->update('donor',array('password'=>$new_pass),"id= '{$id}' AND password = '{$old_pass}'");
                    $response = $db->getResult();
                    if(!empty($response)){
                        echo json_encode(array('success'=>$response)); exit;
                    }else{
                        echo json_encode(array('error'=>'Password not changed.')); exit;
                    }
                }else{
                    echo json_encode(array('error'=>'Old Password is not matched.')); exit;
                }
            }else{
                echo json_encode(array('error'=>'Password is not changed.')); exit;
            }

        }
    }


?>