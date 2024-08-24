<?php 
    include "config.php";

    //Add City Script
    if(isset($_POST['create-city'])){
        if(!isset($_POST['city']) || empty($_POST['city'])){
            echo json_encode(array('error'=>'City Name Field is Empty.')); exit;
        }else{
            $db = new Database();
    
            $params = [
                'city_name' => $db->escapeString($_POST['city']),
            ];
    
            $db->select('city','city_name',null,"city_name='{$params['city_name']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'City Name is already exist.')); exit;
            }else{
                $db->insert('city',$params);
                $response = $db->getResult();
                if(!empty($response)){
                    echo json_encode(array('success'=>$response)); exit;
                }else{
                    echo json_encode(array('error'=>'Data not inserted.')); exit;
                }
            }
        }
    }

    //Edit City Script
    if(isset($_POST['edit-city'])){
        if(!isset($_POST['city']) || empty($_POST['city'])){
            echo json_encode(array('error'=>'City Name Field is Empty.')); exit;
        }else{
            $db = new Database();
    
            $params = [
                'id' => $db->escapeString($_POST['id']),
                'city_name' => $db->escapeString($_POST['city']),
            ];
    
            $db->select('city','city_name',null,"city_name='{$params['city_name']}' AND id !='{$params['id']}'",null,null);
            $result = $db->getResult();
            if(!empty($result)){
                echo json_encode(array('error'=>'City Name is already exist.')); exit;
            }else{
                $db->update('city',$params,"id='{$params['id']}'");
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
    if(isset($_POST['city_delete'])){
        $db = new Database();

        $city_id = $db->escapeString($_POST['city_delete']);
        $db->delete('city',"id='{$city_id}'");
        $result = $db->getResult();
        if(!empty($result)){
            echo json_encode(array('success'=>$result)); exit;
        }else{
            echo json_encode(array('error'=>'Data not Deleted.')); exit;
        }
        
    }




?>