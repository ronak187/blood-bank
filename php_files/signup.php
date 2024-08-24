<?php 
    include '../admin/php_files/config.php';

    //Add User Sign Up Script
    if(isset($_POST['sign-up'])){
        // print_r($_POST); exit;
        if(!isset($_POST['name']) || empty($_POST['name'])){
            echo json_encode(array('error'=>'Name Field is Empty.')); exit;
        }else if(!isset($_POST['gender']) || empty($_POST['gender'])){
            echo json_encode(array('error'=>'Gender Field is Empty.')); exit;
        }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
            echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
        }else if(!isset($_POST['city']) || empty($_POST['city'])){
            echo json_encode(array('error'=>'City Field is Empty.')); exit;
        }else if(!isset($_POST['email']) || empty($_POST['email'])){
            echo json_encode(array('error'=>'Email Field is Empty.')); exit;
        }else if(!isset($_POST['password']) || empty($_POST['password'])){
            echo json_encode(array('error'=>'Password Field is Empty.')); exit;
        }else{
            $db = new Database();

            if(isset($_POST['myCheckbox'])){
               // echo '1'; exit;
                $params = [
                    'donor_name' => $db->escapeString($_POST['name']),
                    'gender' => $db->escapeString($_POST['gender']),
                    'phone' => $db->escapeString($_POST['phone']),
                    'city' => $db->escapeString($_POST['city']),
                    'blood_group' => $db->escapeString($_POST['blood_group']),
                    'email' => $db->escapeString($_POST['email']),
                    'password' => md5($db->escapeString($_POST['password'])),
                ];
            }else{
               // echo '2'; exit;
                $params = [
                    'name' => $db->escapeString($_POST['name']),
                    'gender' => $db->escapeString($_POST['gender']),
                    'phone' => $db->escapeString($_POST['phone']),
                    'user_city' => $db->escapeString($_POST['city']),
                    'username' => $db->escapeString($_POST['email']),
                    'password' => md5($db->escapeString($_POST['password'])),
                ];
            }
            

            if(isset($_POST['myCheckbox'])){
                //echo '1'; exit;
                $db->select('donor','email',null,"email='{$params['email']}'",null,null);
                $result = $db->getResult();
            }else{
               // echo '2'; exit;
                $db->select('user','username',null,"username='{$params['username']}'",null,null);
                $result = $db->getResult();
            }
            if(!empty($result)){
               // echo '1'; exit;
                if(isset($_POST['myCheckbox'])){
                    echo json_encode(array('error'=>'Donor Email is already exist.')); exit;
                }else{ 
                  //  echo '2'; exit;
                    echo json_encode(array('error'=>'User Email is already exist.')); exit;
                }
            }else{
                if(isset($_POST['myCheckbox'])){
                    $db->insert('donor',$params);
                    $response = $db->getResult();
                    if(!empty($response)){
                        echo json_encode(array('success'=>$response)); exit;
                    }else{
                        echo json_encode(array('error'=>'Data not inserted.')); exit;
                    }
                }else{
                    $db->insert('user',$params);
                    $response = $db->getResult();
                    if(!empty($response)){
                        echo json_encode(array('success'=>$response)); exit;
                    }else{
                        echo json_encode(array('error'=>'Data not inserted.')); exit;
                    }
                }
            }
        }
    }



?>