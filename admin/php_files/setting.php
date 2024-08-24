<?php 
    include "config.php";

    if(isset($_POST['edit-setting'])){
        if(!isset($_POST['site_name']) || empty($_POST['site_name'])){
            echo json_encode(array('error'=>'Site Name Field Empty.')); exit;
        }else if(!isset($_POST['username']) || empty($_POST['username'])){
            echo json_encode(array('error'=>'Username Field Empty.')); exit;
        }else if(!isset($_POST['admin_name']) || empty($_POST['admin_name'])){
            echo json_encode(array('error'=>'Admin Name Field Empty.')); exit;
        }else{

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
                if(file_exists('../images/site-logo/'.$_POST{'old_logo'})){
                  unlink('../images/site-logo/'.$_POST{'old_logo'});
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
                'site_name' => $db->escapeString($_POST['site_name']),
                'site_logo' => $db->escapeString($file_name),
                'username' => $db->escapeString($_POST['username']),
                'admin_fullname' => $db->escapeString($_POST['admin_name']),
              ];

              $db->update('admin',$params,"admin_id='{$_POST['admin_id']}'");
              $response = $db->getResult();
              if(!empty($response)){

                    if(!empty($_FILES['new_logo']['name'])){
                         /* directory in which the uploaded file will be moved */
                        move_uploaded_file($file_tmp,"../images/site-logo/".$file_name);
                    }
                    echo json_encode(array('success'=>$response[0])); exit;
              }else{
                    echo json_encode(array('error'=>'Data not updated.')); exit;
              }
        }
    }





?>