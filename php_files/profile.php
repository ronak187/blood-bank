<?php 
    include '../admin/php_files/config.php';

    session_start();

    if(isset($_POST['update-profile'])){
        if(!isset($_POST['name']) || empty($_POST['name'])){
            echo json_encode(array('error'=>'Name Field Empty.')); exit;
        }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
            echo json_encode(array('error'=>'Phone Field Empty.')); exit;
        }else{

            if($_SESSION['user_type'] == 'user'){
              if(!empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])){
                $file_name = $_POST['old_logo'];
              }else if(!empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                $errors = array();
                /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size = $_FILES['new_logo']['size'];
                $file_tmp = $_FILES['new_logo']['tmp_name'];
                $file_type = $_FILES['new_logo']['type'];
                $file_name = str_replace(array(',',' '),'',$file_name);
                $file_ext = explode('.',$file_name);
                $file_ext = strtolower(end($file_ext));
                $extensions = array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions) === false){
                  $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
                }
                if($file_size > 2097152){
                  $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
                }
                if(file_exists('../images/'.$_POST{'old_logo'})){
                  unlink('../images/'.$_POST{'old_logo'});
                }
                $file_name = time().str_replace(array(' ','_'),'-',$file_name);
      
              }else if(empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                $errors = array();
                /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size = $_FILES['new_logo']['size'];
                $file_tmp = $_FILES['new_logo']['tmp_name'];
                $file_type = $_FILES['new_logo']['type'];
                $file_name = str_replace(array(',',' '),'',$file_name);
                $file_ext = explode('.',$file_name);
                $file_ext = strtolower(end($file_ext));
                $extensions = array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions) === false){
                  $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
                }
                if($file_size > 2097152){
                  $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
                }
                if(!empty($errors)){
                  echo json_encode($errors); exit;
                }
                $file_name = time().str_replace(array(' ','_'),'-',$file_name);
              }else{
                  $file_name = '';
              }

              $db = new Database();

              $params = [
                'name' => $db->escapeString($_POST['name']),
                'gender' => $db->escapeString($_POST['gender']),
                'phone' => $db->escapeString($_POST['phone']),
                'user_img' => $db->escapeString($file_name),
                'user_city' => $db->escapeString($_POST['city'])
              ];

              $db->update('user',$params,"id='{$_POST['user_id']}'");
              $response = $db->getResult();
              if(!empty($response)){

                    if(!empty($_FILES['new_logo']['name'])){
                         /* directory in which the uploaded file will be moved */
                        move_uploaded_file($file_tmp,"../images/".$file_name);
                    }
                    echo json_encode(array('success'=>$response[0])); exit;
              }else{
                    echo json_encode(array('error'=>'Data not updated.')); exit;
              }
            }else if($_SESSION['user_type'] == 'donor'){
              if(!empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])){
                $file_name = $_POST['old_logo'];
              }else if(!empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                $errors = array();
                /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size = $_FILES['new_logo']['size'];
                $file_tmp = $_FILES['new_logo']['tmp_name'];
                $file_type = $_FILES['new_logo']['type'];
                $file_name = str_replace(array(',',' '),'',$file_name);
                $file_ext = explode('.',$file_name);
                $file_ext = strtolower(end($file_ext));
                $extensions = array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions) === false){
                  $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
                }
                if($file_size > 2097152){
                  $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
                }
                if(file_exists('../admin/images/donor/'.$_POST{'old_logo'})){
                  unlink('../admin/images/donor/'.$_POST{'old_logo'});
                }
                $file_name = time().str_replace(array(' ','_'),'-',$file_name);
      
              }else if(empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                $errors = array();
                /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size = $_FILES['new_logo']['size'];
                $file_tmp = $_FILES['new_logo']['tmp_name'];
                $file_type = $_FILES['new_logo']['type'];
                $file_name = str_replace(array(',',' '),'',$file_name);
                $file_ext = explode('.',$file_name);
                $file_ext = strtolower(end($file_ext));
                $extensions = array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions) === false){
                  $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
                }
                if($file_size > 2097152){
                  $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
                }
                if(!empty($errors)){
                  echo json_encode($errors); exit;
                }
                $file_name = time().str_replace(array(' ','_'),'-',$file_name);
              }else{
                  $file_name = '';
              }

              $db = new Database();

              $params = [
                'donor_img' => $db->escapeString($file_name),
                'donor_name' => $db->escapeString($_POST['name']),
                'gender' => $db->escapeString($_POST['gender']),
                'phone' => $db->escapeString($_POST['phone']),
                'address' => $db->escapeString($_POST['address']),
                'pin_code' => $db->escapeString($_POST['pin_code']),
                'city' => $db->escapeString($_POST['city']),
                'state' => $db->escapeString($_POST['state']),
                'country' => $db->escapeString($_POST['country']),
                'blood_group' => $db->escapeString($_POST['blood_group']),
                'last_donate' => $db->escapeString($_POST['last_donate']),
                'next_donate' => $db->escapeString($_POST['next_donate']),
              ];

              $db->update('donor',$params,"id='{$_POST['donor_id']}'");
              $response = $db->getResult();
              if(!empty($response)){

                    if(!empty($_FILES['new_logo']['name'])){
                         /* directory in which the uploaded file will be moved */
                        move_uploaded_file($file_tmp,"../admin/images/donor/".$file_name);
                    }
                    echo json_encode(array('success'=>$response[0])); exit;
              }else{
                    echo json_encode(array('error'=>'Data not updated.')); exit;
              }
            }else{
                echo json_encode(array('error'=>'Data not updated error.')); exit;
            }


        }
    }







?>