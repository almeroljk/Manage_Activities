<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  </head>
  <body>

<?php
session_start();

include('include/header.php');
include('include/navbar.php');
include('include/scripts.php');
?>

<!-- MODAL -->
<div class="modal fade" id="activities" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code_student.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Activity </label>
                <input type="text" name="activity" class="form-control" placeholder="Enter Activity">
            </div>
            <div class="form-group">
                <label> Type </label>
                <select name="type" class="form-control">
                  <option value=" AM Time-in">AM Time-in</option>
                  <option value=" AM Time-out">AM Time-out</option>
                  <option value=" PM Time-in">PM Time-in</option>
                  <option value=" PM Time-out">PM Time-out</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date_act" class="form-control">
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" name="time_act" class="form-control">

                <label>End Time</label>
                <input type="time" name="time_act2" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="savedata" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Upcoming Activities
            <button type="button" class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-toggle="modal" data-target="#activities">
              <i class="fa fa-plus"></i> New Activity
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

    <?php
      $connection = mysqli_connect("localhost","root","","project_db");

      $query = "SELECT * FROM m_activities";
      @$query_run = mysqli_query($connection, $query);
    ?>

      <table id="datatableid" class="table-sm table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th >Activities</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th class="text-center">Action</th>

          </tr>
        </thead>
        <tbody>

        <?php
          if(mysqli_num_rows($query_run) > 0){
            while($row = mysqli_fetch_assoc($query_run)){
              ?>
          <tr>
            <td>
              <p><?php echo $row['activity']; echo $row['type']; ?></p>
            </td>
            <td>
              <p><?php echo $row['date']; ?></p>
            </td>
            <td>
              <p><?php echo $row['time']; ?></p>
            </td>
            <td>
            <p><?php echo $row['time_2']; ?></p>
            </td>

            <td class="text-center">
              <form action="edit_activities.php" class="btn btn-sm" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
              </form>

              <form action="code_student.php" class="btn btn-sm" method="post">
                <a href="javascript:void(0)"></a>
                <input type="hidden" class="delete_id_value" name="delete_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="delete_btn" class="delete_btn_ajax btn btn-danger"> DELETE</button>
              </form>
            </td>


          </tr>
          <?php
        }
      }else{
        echo "No Record Found";
      }
    ?>


        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


<script>
$(document).ready(function() {

$('#datatableid').DataTable({
  "pagingType": "full_numbers",
  "lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "ALL"]
  ],
  responsive: true,
  language: {
    search: "_INPUT_",
    searchPlaceholder: "Search Records",
  }
});

} );


</script>

</body>
</html>
