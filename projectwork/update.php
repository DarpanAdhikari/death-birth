<?php
session_start();
include "connection.php";

function generateRandomNumber($minDigits = 6, $maxDigits = 10) {
    $number = mt_rand(pow(10, $minDigits - 1), pow(10, $maxDigits) - 1);
    return $number;
}

function checkNumberInDatabase($number, $con) {
    $query = "SELECT id FROM death_register WHERE registration_no ='$number'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function checkExistsInDatabase($number, $con) {
    $query = "SELECT id FROM birth_register WHERE registration_no='$number'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
if (isset($_POST['update_user'])) {
    $u_id = $_SESSION['logged_In'];
    $select = mysqli_query($con, "SELECT profile_img, citizenship FROM users WHERE id = '$u_id'");
    $select = mysqli_fetch_assoc($select);
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $gender = $_POST['gender'];
    $marriage = $_POST['mariage_status'];
    $birth = $_POST['birth_date'];
    $profile = $_FILES['profile_img']['name'];
    if ($profile !== "") {
        if (file_exists('images/profile/' . $select['profile_img'])) {
            unlink('images/profile/' . $select['profile_img']);
        }
        $tmp_profile = $_FILES['profile_img']['tmp_name'];
        $unique_id = uniqid();
        $image_extension = pathinfo($profile, PATHINFO_EXTENSION);
        $profile = $unique_id . '-drp' . '.' . $image_extension;
        move_uploaded_file($tmp_profile, 'images/profile/' . $profile);
    } else {
        $profile = $select['profile_img'];
    }
    $citizenship = $_FILES['citizenship']['name'];
    if ($citizenship !== "") {
        if (file_exists('images/proof_img/' . $select['citizenship'])) {
            unlink('images/proof_img/' . $select['citizenship']);
        }
        $tmp_citizen = $_FILES['citizenship']['tmp_name'];
        $citizen_unique = uniqid();
        $citizen_extension = pathinfo($citizenship, PATHINFO_EXTENSION);
        $citizenship = $citizen_unique . '-drp' . '.' . $citizen_extension;
        move_uploaded_file($tmp_citizen, 'images/proof_img/' . $citizenship);
    } else {
        $citizenship = $select['citizenship'];
    }

    $update = mysqli_query($con, "UPDATE users SET name = '$name', contact='$phone_no', email='$email',gender='$gender', marriage='$marriage', birth_date='$birth',profile_img='$profile',citizenship='$citizenship' WHERE id = '$u_id'");
    if ($update) {
        $_SESSION['success'] = "Your details has been changed successfully";
        header('location:index.php');
        exit;
    } else {
        $_SESSION['error'] = "Sorry, we encountered some problem try again";
        echo '<script>window.history.back();</script>';
        exit;
    }
}

// birth part
if (isset($_POST['birth_update'])) {
    $user = $_SESSION['logged_In'];
    $u_id = $_POST['user'];
    $select = mysqli_query($con, "SELECT * FROM birth_register WHERE id = '$u_id' AND `user`='$user'");
    if (mysqli_num_rows($select) > 0) {
        $select = mysqli_fetch_assoc($select);
        $name = $_POST['full_name'];
        $gender = $_POST['gender'];
        $father = $_POST['father_name'];
        $mother = $_POST['mother_name'];
        $father_citizenship = $_POST['father_citizenship'];
        $mother_citizenship = $_POST['mother_citizenship'];
        $birth_place = $_POST['birth_place'];
        $birth_date = $_POST['birth_date'];
        $birth_time = $_POST['birth_time'];
        $upload_date = date("Y-m-d");

        $baby_img = $_FILES['baby_img']['name'];
        if ($baby_img !== "") {
            if (file_exists('images/proof_img/' . $select['baby_img'])) {
                unlink('images/proof_img/' . $select['baby_img']);
            }
            $tmp_baby = $_FILES['baby_img']['tmp_name'];
            $baby_img = uniqid() . '-birth' . '.' . pathinfo($baby_img, PATHINFO_EXTENSION);
            move_uploaded_file($tmp_baby, 'images/proof_img/' . $baby_img);
        } else {
            $baby_img = $select['baby_img'];
        }

        $certificate = $_FILES['hospital_certificate']['name'];
        if ($certificate !== "") {
            if (file_exists('images/proof_img/' . $select['certificate'])) {
                unlink('images/proof_img/' . $select['certificate']);
            }
            $tmp_certificate = $_FILES['hospital_certificate']['tmp_name'];
            $certificate = uniqid() . '-birth' . '.' . pathinfo($certificate, PATHINFO_EXTENSION);
            move_uploaded_file($tmp_certificate, 'images/proof_img/' . $certificate);
        } else {
            $certificate = $select['certificate'];
        }

        $parents_marriage = $_FILES['parents_marriage']['name'];
        if ($parents_marriage !== "") {
            if (file_exists('images/proof_img/' . $select['parents_marriage'])) {
                unlink('images/proof_img/' . $select['parents_marriage']);
            }
            $tmp_parents_marriage = $_FILES['parents_marriage']['tmp_name'];
            $parents_marriage = uniqid() . '-birth' . '.' . pathinfo($parents_marriage, PATHINFO_EXTENSION);
            move_uploaded_file($tmp_parents_marriage, 'images/proof_img/' . $parents_marriage);
        } else {
            $parents_marriage = $select['parents_marriage'];
        }

        $sql = mysqli_query($con, "UPDATE `birth_register` SET `name`='$name',`gender`='$gender',`father`='$father',`mother`='$mother',`fa_citizen_no`='$father_citizenship',`mo_citizen_no`='$mother_citizenship',`birth_place`='$birth_place',`birth_date`='$birth_date',`birth_time`='$birth_time',`baby_img`='$baby_img',`certificate`='$certificate',`parents_marriage`='$parents_marriage',`user`='$user' WHERE id='$u_id'");
        if ($sql) {
            $_SESSION['success'] = "Birth registration updated. Now you made some changes on previous data.";
            header('location:index.php');
            exit;
        } else {
            $_SESSION['error'] = "Sorry, we are unable to update, try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    } else {
        $_SESSION['error'] = "There is no registration";
        echo '<script>window.history.back();</script>';
        exit;
    }
}

if(isset($_GET['birth_reject']) && $_GET['birth_reject'] !== ""){
    $id = $_GET['birth_reject'];
    $u_id = $_SESSION['logged_In'];
    $sql = mysqli_query($con,"SELECT id FROM birth_register WHERE id='$id'");
    if(mysqli_num_rows($sql)>0){
        $reject = mysqli_query($con,"UPDATE birth_register SET approved_by = '$u_id', approve_state = '0'");
        if($reject){
            $_SESSION['success'] = "Successfully, Rejected";
            echo '<script>window.history.back();</script>';
            exit;
        }else{
            $_SESSION['error'] = "Something went wrong, unable to reject. Try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }
}
if(isset($_GET['birth_approve']) && $_GET['birth_approve'] !== ""){
    $id = $_GET['birth_approve'];
    $u_id = $_SESSION['logged_In'];
    do {
        $random_number = generateRandomNumber(6, 10);
        $exists = checkExistsInDatabase($random_number, $con);
        
    } while ($exists);
    $sql = mysqli_query($con,"SELECT id, registration_no FROM birth_register WHERE id='$id'");
    
    if(mysqli_num_rows($sql) > 0){
        $issue_date =date('Y-m-d');
        $reject = mysqli_query($con,"UPDATE birth_register SET approved_by = '$u_id', approve_state = '1', registration_no = '$random_number', issue_date='$issue_date' WHERE id='$id'");
        if($reject){
            $_SESSION['success'] = "Successfully approved. Random number generated: $random_number";
            echo '<script>window.history.back();</script>';
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong, unable to approve. Try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }
}
// death part
if (isset($_POST['update_death'])) {
    $user = $_SESSION['logged_In'];
    $p_id = $_POST['user'];
    $select = mysqli_query($con, "SELECT * FROM death_register WHERE id = '$p_id' AND `user`='$user'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $name = $_POST['full_name'];
        $gender = $_POST['gender'];
        $mariage_status = $_POST['mariage_status'];
        $child = $_POST['child'];
        if($mariage_status === "0"){
          $child = null;
        }
        $reason = $_POST['reason'];
        $death_place = $_POST['death_place'];
        $birth_date = $_POST['birth_date'];
        $death_date = $_POST['death_date'];
        $relationship = $_POST['relationship'];
        if ($relationship === "") {
            $_SESSION['error'] = "All field required";
            echo '<script>window.history.back();</script>';
            die;
        }
        $upload_date = date('Y-m-d');
        $year = date('Y-m');

        $dead_photo = $_FILES['dead_photo']['name'];
        if ($dead_photo !== "") {
            if (file_exists('images/proof_img/' . $row['dead_photo'])) {
                unlink('images/proof_img/' . $row['dead_photo']);
            }
            $tmp_dead = $_FILES['dead_photo']['tmp_name'];
            $dead_photo = uniqid() . '-death-' . $year . '.' . pathinfo($dead_photo, PATHINFO_EXTENSION);
            move_uploaded_file($tmp_dead, 'images/proof_img/' . $dead_photo);
        } else {
            $dead_photo = $row['dead_photo'];
        }

        $citizenship = $_FILES['citizenship']['name'];
        if ($citizenship !== "") {
            if (file_exists('images/proof_img/' . $row['citizenship'])) {
                unlink('images/proof_img/' . $row['citizenship']);
            }
            $tmp_citizenship = $_FILES['citizenship']['tmp_name'];
            $citizenship = uniqid() . '-death-' . $year . '.' . pathinfo($citizenship, PATHINFO_EXTENSION);
            move_uploaded_file($tmp_citizenship, 'images/proof_img/' . $citizenship);
        } else {
            $citizenship = $row['citizenship'];
        }

        $sql = mysqli_query($con, "UPDATE `death_register` SET `name`='$name',`gender`='$gender',`mariage_status`='$mariage_status',`child`='$child',`reason`='$reason',`death_place`='$death_place',`birth_date`='$birth_date',`death_date`='$death_date',`relationship`='$relationship',`dead_photo`='$dead_photo',`citizenship`='$citizenship' WHERE id='$p_id'");
        if ($sql) {
            $_SESSION['success'] = "Death registration updated.";
            header('location:index.php');
            exit;
        } else {
            $_SESSION['error'] = "Sorry, we are unable to update, try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    } else {
        $_SESSION['error'] = "There is no registration";
        echo '<script>window.history.back();</script>';
        exit;
    }
}

if(isset($_GET['death_reject']) && $_GET['death_reject'] !== ""){
    $id = $_GET['death_reject'];
    $u_id = $_SESSION['logged_In'];
    $sql = mysqli_query($con,"SELECT id FROM death_register WHERE id='$id'");
    if(mysqli_num_rows($sql)>0){
        $reject = mysqli_query($con,"UPDATE death_register SET approved_by = '$u_id', approve_state = '0'");
        if($reject){
            $_SESSION['success'] = "Successfully, Rejected";
            echo '<script>window.history.back();</script>';
            exit;
        }else{
            $_SESSION['error'] = "Something went wrong, unable to reject. Try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }
}


if(isset($_GET['death_approve']) && $_GET['death_approve'] !== ""){
    $id = $_GET['death_approve'];
    $u_id = $_SESSION['logged_In'];
    
    do {
        $random_number = generateRandomNumber(6, 10);
        $exists = checkNumberInDatabase($random_number, $con);
        
    } while ($exists);

    $sql = mysqli_query($con,"SELECT id, registration_no FROM death_register WHERE id='$id'");
    
    if(mysqli_num_rows($sql) > 0){
        $issue_date =date('Y-m-d');
        $reject = mysqli_query($con,"UPDATE death_register SET approved_by = '$u_id', approve_state = '1', registration_no = '$random_number', issue_date='$issue_date' WHERE id='$id'");
        if($reject){
            $_SESSION['success'] = "Successfully approved. Random number generated: $random_number";
            echo '<script>window.history.back();</script>';
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong, unable to approve. Try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }
}

// role update
if(isset($_POST['role'])){
    $user = $_POST['user'];
    $role = $_POST['role'];
    $check = mysqli_query($con,"SELECT id FROM users WHERE id = '$user'");
    if(mysqli_num_rows($check)>0){
        $update = mysqli_query($con,"UPDATE users SET role = '$role' WHERE id='$user'");
        if($update){
            $_SESSION['success'] = "Successfully, Role changed";
            echo '<script>window.history.back();</script>';
            exit;
        }else{
            $_SESSION['error'] = "Something went wrong, unable to change Role. Try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }
}

echo '<script>window.history.back();</script>';
exit;