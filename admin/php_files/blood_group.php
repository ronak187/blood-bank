<?php 
    include "config.php";

    //Add Blood Group Name Script
    if(isset($_POST['create-blood'])){
        if(!isset($_POST['blood_group']) || empty($_POST['blood_group'])){
            echo json_encode(array('error'=>'Blood Group Name Field is Empty.')); exit;
        }else{
            $db = new Database();
    
            $params = [
                'name' => $db->escapeString($_POST['blood_group']),
            ];
    
            $db->select('blood_group','name',null,"name='{$params['name']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'Blood Group Name is already exist.')); exit;
            }else{
                $db->insert('blood_group',$params);
                $response = $db->getResult();
                if(!empty($response)){
                    echo json_encode(array('success'=>$response)); exit;
                }else{
                    echo json_encode(array('error'=>'Data not inserted.')); exit;
                }
            }
        }
    }

    //Edit Blood Group Name Script
    if(isset($_POST['edit-blood'])){
        if(!isset($_POST['blood_group']) || empty($_POST['blood_group'])){
            echo json_encode(array('error'=>'Blood Group Name Field is Empty.')); exit;
        }else{
            $db = new Database();
    
            $params = [
                'id' => $db->escapeString($_POST['id']),
                'name' => $db->escapeString($_POST['blood_group']),
            ];
    
            $db->select('blood_group','name',null,"name='{$params['name']}' AND id !='{$params['id']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'Blood Group Name is already exist.')); exit;
            }else{
                $db->update('blood_group',$params,"id='{$params['id']}'");
                $response = $db->getResult();
                if(!empty($response)){
                    echo json_encode(array('success'=>$response)); exit;
                }else{
                    echo json_encode(array('error'=>'Data not Updated.')); exit;
                }
            }
        }
    }

    //Delete Blood Group Name Script
    if(isset($_POST['blood_delete'])){
        $db = new Database();

        $blood_id = $db->escapeString($_POST['blood_delete']);
        $db->delete('blood_group',"id='{$blood_id}'");
        $result = $db->getResult();
        if(!empty($result)){
            echo json_encode(array('success'=>$result)); exit;
        }else{
            echo json_encode(array('error'=>'Data not Deleted.')); exit;
        }
        
    }




?>