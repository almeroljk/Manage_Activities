<?php
session_start();

include('include/header.php');
include('include/navbar.php');
include('include/scripts.php');
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Activity </h6>
  </div>
  <div class="modal-body">
  
    <?php
    $connection = mysqli_connect("localhost","root","","project_db");

    //"RETRIVE"
    if (isset($_POST['edit_btn'])) { 
      $id = $_POST['edit_id'];

      $query = "SELECT * FROM m_activities WHERE id = '$id' ";
      $query_run = mysqli_query($connection, $query);

      foreach ($query_run as $row) {
        ?>

            <form action="code_student.php" method="post">
              <input type="hidden" name="edit_id" value="<?php echo isset($id) ? $id : '' ?>">
              <div class="form-group">
                  <label> Activity </label>
                  <input type="text" name="edit_activity" value="<?php echo $row['activity'];?>" class="form-control" placeholder="Enter Activity">
              </div>
              <div class="form-group">
                <label> Type </label>
                <select name="edit_type" value="<?php echo $row['type'];?>" class="form-control">
                  <option value=" AM Time-in">AM Time-in</option>
                  <option value=" AM Time-out">AM Time-out</option>
                  <option value=" PM Time-in">PM Time-in</option>
                  <option value=" PM Time-out">PM Time-out</option>
                </select>
            </div>
              <div class="form-group">
                  <label>Date</label>
                  <input type="date" name="edit_date_act" value="<?php echo $row['date'];?>" class="form-control">
              </div>
              <div class="form-group">
                  <label>Start Time</label>
                  <input type="time" name="edit_time_act" value="<?php echo $row['time'];?>" class="form-control">

                  <label>End Time</label>
                  <input type="time" name="edit_time_act2" value="<?php echo $row['time_2'];?>" class="form-control">
              </div>

              <a href="activities.php" class="btn btn-danger"> Cancel</a>
              <button type="submit" name="updatebtn_1" class="btn btn-primary"> Update </button>
              <!--class="btn btn-primary btn-block btn-sm col-sm-2 float-right"-->

            </form>
          <?php
        }
      }
      ?>

  </div>



    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
