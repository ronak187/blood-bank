<?php 
    include "config.php";

    //Blood Group Report Script
    if(isset($_GET['blood_group'])){
        $db = new Database();

         $blood_group = $db->escapeString($_GET['blood_group']);
       // $blood_group = 'all';
        if($blood_group != 'all'){
            $db->select('donor','donor.id as donor_id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                    donor.city,donor.blood_group,blood_group.name,city.city_name',"blood_group ON donor.blood_group = blood_group.id LEFT JOIN city ON donor.city = city.id",
                    "donor.blood_group='{$blood_group}'",null,null);
        }else{
            $db->select('donor','donor.id as donor_id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                    donor.city,donor.blood_group,blood_group.name,city.city_name',"blood_group ON donor.blood_group = blood_group.id LEFT JOIN city ON donor.city = city.id",
                    null,null,null);
        }
        $result = $db->getResult();
        $rows = array();
        if(!empty($result)){
            $i=0;
            foreach($result as $row){
                $i++;
                $data = array();
                $data[] = $i;
                if($row['donor_img'] != ''){
                    $data[] = '<img src="../images/donor/'.$row['donor_img'].'" width="60px">';
                }else{
                    $data[] = '<img src="../images/donor/user.jpg" width="60px">';
                }
                $data[] = $row['donor_name'];
                $data[] = $row['email'];
                $data[] = $row['phone'];
                $data[] = $row['city_name'];
                $data[] = $row['name'];
                 
                $rows[] = $data;
            }
        }
        $dataset = array(
            "totalrecords" => count($rows),
            "totaldisplayrecords" => count($rows),
            "data" => $rows
        );

        echo json_encode($dataset); exit;
    }










?>