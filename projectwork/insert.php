<?php
session_start();
include "connection.php";

// register user
if(isset($_POST['register_form'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['phone_no'];
    $password = $_POST['password'];
    $c_pass = $_POST['c_pass'];
    if(empty($name) || empty($email) || empty($contact) || empty($password) || empty($c_pass)) {
        $emptyFields = array();
        if(empty($name)) {
            $emptyFields[] = "Name";
        }
        if(empty($email)) {
            $emptyFields[] = "Email";
        }
        if(empty($contact)) {
            $emptyFields[] = "Phone Number";
        }
        if(empty($password)) {
            $emptyFields[] = "Password";
        }
        if(empty($c_pass)) {
            $emptyFields[] = "Confirm Password";
        }
        $_SESSION['error'] = "Please fill in the field: " . implode(", ", $emptyFields);
        echo '<script>window.history.back();</script>';
        exit;
    }
    if($c_pass !== $password){
      $_SESSION['error'] = "Your confirmation password did not match";
      echo '<script>window.history.back();</script>';
      exit;
    }
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $check = $_POST['agree'];
    $User = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");
    if(mysqli_num_rows($User)<1){
        if(isset($_POST['agree'])){
            $stmt = $con->prepare("INSERT INTO `users`(`name`, `contact`, `email`, `password`) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssss", $name, $contact, $email, $passwordHashed);
                if ($stmt->execute()) {
                    $checkUser = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");
                    $user = mysqli_fetch_assoc($checkUser);
                    if ($user) {
                        $_SESSION['logged_In'] = $user['id'];
                        header('location:index.php');
                        exit;
                    }
                }
            }
        } else {
            $_SESSION['error'] = "You must agree to the terms and conditions.";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }else{
        $_SESSION['error'] = "This Email already has an account";
        echo '<script>window.history.back();</script>';
       exit;
    }
}

// log in user
if(isset($_POST['login_form'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = mysqli_query($con,"SELECT id,password,role FROM users WHERE email = '$email'");
    if(mysqli_num_rows($check) === 1){
        $user =  mysqli_fetch_assoc($check);
        if(password_verify($password,$user['password']))
        {
            if($user['role']==='1'){
                header('location:dash.php');
            }else{
                header('location:index.php');
            }
            $_SESSION['logged_In'] = $user['id'];
                    exit;
        }else{
            $_SESSION['error'] = "Wrong password please try again";
            echo '<script>window.history.back();</script>';
            exit;
        }
    }else{
        $_SESSION['error'] = "We don't have this email yet";
        echo '<script>window.history.back();</script>';
        exit;
    }
}

// register birth
if(isset($_POST['birth_form'])){
    $user = $_SESSION['logged_In'];
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
    $tmp_baby = $_FILES['baby_img']['tmp_name'];
    $baby_img = uniqid() . '-birth' . '.' . pathinfo($baby_img, PATHINFO_EXTENSION);
    move_uploaded_file($tmp_baby, 'images/proof_img/'. $baby_img);

    $certificate = $_FILES['hospital_certificate']['name'];
    $tmp_certificate = $_FILES['hospital_certificate']['tmp_name'];
    $certificate = uniqid() . '-birth' . '.' . pathinfo($certificate, PATHINFO_EXTENSION);
    move_uploaded_file($tmp_certificate, 'images/proof_img/'. $certificate);

    $parents_marriage = $_FILES['parents_marriage']['name'];
    $tmp_parents_marriage = $_FILES['parents_marriage']['tmp_name'];
    $parents_marriage = uniqid() . '-birth' . '.' . pathinfo($parents_marriage, PATHINFO_EXTENSION);
    move_uploaded_file($tmp_parents_marriage, 'images/proof_img/'. $parents_marriage);

    $sql = mysqli_query($con,"INSERT INTO `birth_register`( `name`, `gender`, `father`, `mother`, `fa_citizen_no`, `mo_citizen_no`, `birth_place`, `birth_date`, `birth_time`, `baby_img`, `certificate`, `parents_marriage`, `upload_date`,`user`) VALUES ('$name','$gender','$father','$mother','$father_citizenship','$mother_citizenship','$birth_place','$birth_date','$birth_time','$baby_img','$certificate','$parents_marriage','$upload_date', '$user')");
    if($sql){
        $_SESSION['success'] = "Congrats birth certificate is registred";
        header('location:index.php');
        exit;
    }else{
        $_SESSION['error'] = "Something went wrong";
        echo '<script>window.history.back();</script>';
        exit;
    }
}

if(isset($_POST['death_form'])){
  $user = $_SESSION['logged_In'];
  $name = $_POST['full_name'];
  $gender = $_POST['gender'];
  $mariage_status = $_POST['mariage_status'];
  $child = $_POST['child'];
  $reason = $_POST['reason'];
  $death_place = $_POST['death_place'];
  $birth_date = $_POST['birth_date'];
  $death_date = $_POST['death_date'];
  $relationship = $_POST['relationship'];
  if($relationship === ""){
    $_SESSION['error'] = "All field required";
    echo '<script>window.history.back();</script>';
    die;
  }
  $upload_date = date('Y-m-d');
  $year = date('Y-m');

  $dead_photo = $_FILES['dead_photo']['name'];
  if($dead_photo !==""){
      $tmp_dead = $_FILES['dead_photo']['tmp_name'];
      $dead_photo = uniqid() . '-death-'.$year. '.' . pathinfo($dead_photo, PATHINFO_EXTENSION);
      move_uploaded_file($tmp_dead, 'images/proof_img/'. $dead_photo);
  }

  $citizenship = $_FILES['citizenship']['name']; 
  if($citizenship !== ""){
      $tmp_citizenship = $_FILES['citizenship']['tmp_name'];
      $citizenship = uniqid() . '-death-'.$year. '.' . pathinfo($citizenship, PATHINFO_EXTENSION);
      move_uploaded_file($tmp_citizenship, 'images/proof_img/'. $citizenship);
  }

  $sql = mysqli_query($con,"INSERT INTO `death_register`(`name`, `gender`, `mariage_status`, `child`, `reason`, `death_place`, `birth_date`, `death_date`, `relationship`, `dead_photo`, `citizenship`, `upload_date`,`user`) VALUES ('$name','$gender','$mariage_status','$child','$reason','$death_place','$birth_date','$death_date','$relationship','$dead_photo','$citizenship','$upload_date','$user')");
  if($sql){
    $_SESSION['success'] = "Congrats death certificate is registred";
    header('location:index.php');
    exit;
}else{
    $_SESSION['error'] = "Something went wrong";
    echo '<script>window.history.back();</script>';
    exit;
}
}