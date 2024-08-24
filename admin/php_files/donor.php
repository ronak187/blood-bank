<?php
include "config.php";

//Add Donor Script
if (isset($_POST['create-donor'])) {
    if (!isset($_POST['donor_name']) || empty($_POST['donor_name'])) {
        echo json_encode(array('error' => 'Donor Name Field is Empty.'));
        exit;
    } else if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        echo json_encode(array('error' => 'Gender Field is Empty.'));
        exit;
    } else if (!isset($_POST['email']) || empty($_POST['email'])) {
        echo json_encode(array('error' => 'Email Field is Empty.'));
        exit;
    } else if (!isset($_POST['phone']) || empty($_POST['phone'])) {
        echo json_encode(array('error' => 'Phone Field is Empty.'));
        exit;
    } else if (!isset($_POST['address']) || empty($_POST['address'])) {
        echo json_encode(array('error' => 'Address Field is Empty.'));
        exit;
    } else if (!isset($_POST['pin_code']) || empty($_POST['pin_code'])) {
        echo json_encode(array('error' => 'Pin Code Field is Empty.'));
        exit;
    } else if (!isset($_POST['city']) || empty($_POST['city'])) {
        echo json_encode(array('error' => 'City Field is Empty.'));
        exit;
    } else if (!isset($_POST['state']) || empty($_POST['state'])) {
        echo json_encode(array('error' => 'State Field is Empty.'));
        exit;
    } else if (!isset($_POST['country']) || empty($_POST['country'])) {
        echo json_encode(array('error' => 'Country Field is Empty.'));
        exit;
    } else if (!isset($_POST['blood_group']) || empty($_POST['blood_group'])) {
        echo json_encode(array('error' => 'Blood Group Field is Empty.'));
        exit;
    } else {
        if ($_FILES['donor_image']['name'] != '') {
            $errors = array();
            /* get details of the uploaded file */
            $file_name = $_FILES['donor_image']['name'];
            $file_size = $_FILES['donor_image']['size'];
            $file_tmp = $_FILES['donor_image']['tmp_name'];
            $file_type = $_FILES['donor_image']['type'];
            $file_name = str_replace(array(',', ' '), '', $file_name);
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $extensions = array("jpg", "jpeg", "png");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = '<div class="alert alert-danger">extension not allowed, please choose a JPEG or PNG file.</div>';
            }
            if ($file_size > 2097152) {
                $errors[] = '<div class="alert alert-danger">File size must be exactly 2 MB.</div>';
            }

            if (!empty($errors)) {
                echo json_encode($errors);
                exit;
            }
            $file_name = time() . str_replace(array(' ', '_'), '-', $file_name);
        } else {
            $file_name = '';
        }

        $db = new Database();

        $params = [
            'donor_img' => $db->escapeString($file_name),
            'donor_name' => $db->escapeString($_POST['donor_name']),
            'gender' => $db->escapeString($_POST['gender']),
            'email' => $db->escapeString($_POST['email']),
            'phone' => $db->escapeString($_POST['phone']),
            'address' => $db->escapeString($_POST['address']),
            'pin_code' => $db->escapeString($_POST['pin_code']),
            'city' => $db->escapeString($_POST['city']),
            'state' => $db->escapeString($_POST['state']),
            'country' => $db->escapeString($_POST['country']),
            'blood_group' => $db->escapeString($_POST['blood_group']),
        ];

        $db->select('donor', 'email', null, "email='{$params['email']}'", null, null);
        $result = $db->getResult();
        if (!empty($result)) {
            echo json_encode(array('error' => 'Donor Email is already exist.'));
            exit;
        } else {
            $db->insert('donor', $params);
            $response = $db->getResult();
            if (!empty($response)) {
                if ($_FILES['donor_image']['name'] != '') {
                    move_uploaded_file($file_tmp, "../images/donor/" . $file_name);
                }
                echo json_encode(array('success' => $response));
                exit;
            } else {
                echo json_encode(array('error' => 'Data not inserted.'));
                exit;
            }
        }
    }
}


//Edit Donor Script
if (isset($_POST['edit-donor'])) {
    if (!isset($_POST['donor_name']) || empty($_POST['donor_name'])) {
        echo json_encode(array('error' => 'Donor Name Field is Empty.'));
        exit;
    } else if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        echo json_encode(array('error' => 'Gender Field is Empty.'));
        exit;
    } else if (!isset($_POST['email']) || empty($_POST['email'])) {
        echo json_encode(array('error' => 'Email Field is Empty.'));
        exit;
    } else if (!isset($_POST['phone']) || empty($_POST['phone'])) {
        echo json_encode(array('error' => 'Phone Field is Empty.'));
        exit;
    } else if (!isset($_POST['address']) || empty($_POST['address'])) {
        echo json_encode(array('error' => 'Address Field is Empty.'));
        exit;
    } else if (!isset($_POST['pin_code']) || empty($_POST['pin_code'])) {
        echo json_encode(array('error' => 'Pin Code Field is Empty.'));
        exit;
    } else if (!isset($_POST['city']) || empty($_POST['city'])) {
        echo json_encode(array('error' => 'City Field is Empty.'));
        exit;
    } else if (!isset($_POST['state']) || empty($_POST['state'])) {
        echo json_encode(array('error' => 'State Field is Empty.'));
        exit;
    } else if (!isset($_POST['country']) || empty($_POST['country'])) {
        echo json_encode(array('error' => 'Country Field is Empty.'));
        exit;
    } else if (!isset($_POST['blood_group']) || empty($_POST['blood_group'])) {
        echo json_encode(array('error' => 'Blood Group Field is Empty.'));
        exit;
    } else {

        if (!empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])) {
            $file_name = $_POST['old_logo'];
        } else if (!empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])) {
            $errors = array();
            /* get details of the uploaded file */
            $file_name = $_FILES['new_logo']['name'];
            $file_size = $_FILES['new_logo']['size'];
            $file_tmp = $_FILES['new_logo']['tmp_name'];
            $file_type = $_FILES['new_logo']['type'];
            $file_name = str_replace(array(',', ' '), '', $file_name);
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $extensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
            }
            if ($file_size > 2097152) {
                $errors[] = "<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
            }

            if (file_exists('../images/donor/' . $_POST['old_logo'])) {
                unlink('../images/donor/' . $_POST['old_logo']);
            }
            $file_name = time() . str_replace(array(' ', '_'), '-', $file_name);
        } else if (empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])) {
            $errors = array();
            /* get details of the uploaded file */
            $file_name = $_FILES['new_logo']['name'];
            $file_size = $_FILES['new_logo']['size'];
            $file_tmp = $_FILES['new_logo']['tmp_name'];
            $file_type = $_FILES['new_logo']['type'];
            $file_name = str_replace(array(',', ' '), '', $file_name);
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $extensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
            }
            if ($file_size > 2097152) {
                $errors[] = "<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
            }
            if (!empty($errors)) {
                echo json_encode($errors);
                exit;
            }
            $file_name = time() . str_replace(array(' ', '_'), '-', $file_name);
        } else {
            $file_name = '';
        }

        $db = new Database();

        $params = [
            'id' => $db->escapeString($_POST['id']),
            'donor_img' => $db->escapeString($file_name),
            'donor_name' => $db->escapeString($_POST['donor_name']),
            'gender' => $db->escapeString($_POST['gender']),
            'email' => $db->escapeString($_POST['email']),
            'phone' => $db->escapeString($_POST['phone']),
            'address' => $db->escapeString($_POST['address']),
            'pin_code' => $db->escapeString($_POST['pin_code']),
            'city' => $db->escapeString($_POST['city']),
            'state' => $db->escapeString($_POST['state']),
            'country' => $db->escapeString($_POST['country']),
            'blood_group' => $db->escapeString($_POST['blood_group']),
        ];

        $db->select('donor', 'email', null, "email='{$params['email']}' AND id !='{$params['id']}'", null, null);
        $result = $db->getResult();
        if (!empty($result)) {
            echo json_encode(array('error' => 'Donor Email is already exist.'));
            exit;
        } else {
            $db->update('donor', $params, "id='{$params['id']}'");
            $response = $db->getResult();
            if (!empty($response)) {

                if (!empty($_FILES['new_logo']['name'])) {
                    /* directory in which the uploaded file will be moved */
                    move_uploaded_file($file_tmp, "../images/donor/" . $file_name);
                }
                echo json_encode(array('success' => $response));
                exit;
            } else {
                echo json_encode(array('error' => 'Data not Updated.'));
                exit;
            }
        }
    }
}

//Delete Donor Script
if (isset($_POST['donor_delete'])) {
    $db = new Database();

    $donor_id = $db->escapeString($_POST['donor_delete']);
    $db->delete('donor', "id='{$donor_id}'");
    $result = $db->getResult();
    if (!empty($result)) {
        echo json_encode(array('success' => $result));
        exit;
    } else {
        echo json_encode(array('error' => 'Data not Deleted.'));
        exit;
    }
}
