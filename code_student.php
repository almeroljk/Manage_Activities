<?php
session_start();

$connection = mysqli_connect("localhost","root","","project_db");

//Added New Student
if (isset($_POST['registerbtn'])){
    $id_num = $_POST['id_num'];
    $last_name= $_POST['last_name'];
    $first_name= $_POST['first_name'];
    $middle_name= $_POST['middle_name'];
    $class = $_POST['class'];

    //Check if the ID number Already used
    $check_id = mysqli_query($connection, "SELECT * FROM student_list WHERE id_num = $id_num");

    if(mysqli_num_rows($check_id)>0){
      $_SESSION['status'] = "ID Number Already Used";
      $_SESSION['status_code'] = "error";
      header('Location: student_list.php');
    }else {

    $query = "INSERT INTO student_list (id_num, last_name, first_name, middle_name, class) VALUES ('$id_num', '$last_name', '$first_name', '$middle_name', '$class')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run){
        $_SESSION['status'] = "New Student Added";
        $_SESSION['status_code'] = "success";
        header('Location: student_list.php');
      }else{
        $_SESSION['status'] = "Student Profile Not Added";
        $_SESSION['status_code'] = "error";
        header('Location: student_list.php');
      }
    }
}

//Update process
if (isset($_POST['updatebtn'])) {

  $id = $_POST['edit_id'];
  $id_num = $_POST['edit_id_num'];
  $last_name= $_POST['edit_last_name'];
  $first_name= $_POST['edit_first_name'];
  $middle_name= $_POST['edit_middle_name'];
  $class = $_POST['edit_class'];

    $query = "UPDATE student_list SET id_num = '$id_num', last_name = '$last_name', first_name = '$first_name', middle_name = '$middle_name', class = '$class' WHERE id= '$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
      $_SESSION['status'] = 'Your Data is Updated';
      $_SESSION['status_code'] = "success";
      header('Location: student_list.php');
    }else {
      $_SESSION['status'] = 'Your Data is Not Updated';
      $_SESSION['status_code'] = "error";
      header('Location: student_list.php');
    }
  
}

//Delete process
if (isset($_POST['delete_btn'])) {
  $id = $_POST['delete_id'];

  $query = "DELETE FROM student_list WHERE id = '$id' ";
  $query_run = mysqli_query($connection, $query);

  if($query_run) {
    $_SESSION['status'] = 'Your Data is Deleted';
    $_SESSION['status_code'] = "success";
    header('Location: student_list.php');
  }else {
    $_SESSION['status'] = 'Your Data is not Deleted';
    $_SESSION['status_code'] = "error";
    header('Location: student_list.php');
  }
}

//delete_btn_set
if (isset($_POST['delete_btn_set'])) {
  $del_id = $_POST['delete_id'];

  $query = "DELETE FROM student_list WHERE id = '$del_id' ";
  $query_run = mysqli_query($connection, $query);
}


// Manage Activities


//Added New Activity
if (isset($_POST['savedata'])){
  $activity = $_POST['activity'];
  $type = $_POST['type'];
  $date_act = date('Y-m-d', strtotime($_POST['date_act']));
  $time_act = $_POST['time_act'];
  $time_act2 = $_POST['time_act2'];

  $query = "INSERT INTO m_activities (activity, type, date, time, time_2) VALUES ('$activity', '$type', '$date_act', '$time_act', '$time_act2')";
  $query_run = mysqli_query($connection, $query);

  if ($query_run){
      $_SESSION['status'] = "New Activity Added";
      $_SESSION['status_code'] = "success";
      header('Location: activities.php');
    }else{
      $_SESSION['status'] = "Activity Not Added";
      $_SESSION['status_code'] = "error";
      header('Location: activities.php');
    }
}


//Update process
if (isset($_POST['updatebtn_1'])) {

  $id = $_POST['edit_id'];
  $activity = $_POST['edit_activity'];
  $type = $_POST['edit_type'];
  $date_act = date('Y-m-d', strtotime($_POST['edit_date_act']));
  $time_act = $_POST['edit_time_act'];
  $time_act2 = $_POST['edit_time_act2'];


    $query = "UPDATE m_activities SET activity = '$activity', type = '$type', date = '$date_act', time = '$time_act', time_2 = '$time_act2'  WHERE id= '$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
      $_SESSION['status'] = 'Your Data is Updated';
      $_SESSION['status_code'] = "success";
      header('Location: activities.php');
    }else {
      $_SESSION['status'] = 'Your Data is Not Updated';
      $_SESSION['status_code'] = "error";
      header('Location: activities.php');
    }

}


//Delete process
if (isset($_POST['delete_btn'])) {
  $id = $_POST['delete_id'];

  $query = "DELETE FROM m_activities WHERE id = '$id' ";
  $query_run = mysqli_query($connection, $query);

  if($query_run) {
    $_SESSION['status'] = 'Your Data is Deleted';
    $_SESSION['status_code'] = "success";
    header('Location: activities.php');
  }else {
    $_SESSION['status'] = 'Your Data is not Deleted';
    $_SESSION['status_code'] = "error";
    header('Location: activities.php');
  }
}

//delete_btn_set
if (isset($_POST['delete_btn_set'])) {
  $del_id = $_POST['delete_id'];

  $query = "DELETE FROM m_activities WHERE id = '$del_id' ";
  $query_run = mysqli_query($connection, $query);
}
?>
