<?php
            if (!isset($file_access))
    die("Direct File Access Denied");
?>
<?php
if (isset($_POST['submit2'])) {


 $tname = $_POST['turf_name'];
 $cons = connect()->query("SELECT * FROM turf WHERE turf_name='$tname'");
 $temprow = $cons->fetch_assoc();

 $turfid = $temprow['turfid'];
 $from_date = $_POST['from_date'];
 $to_date = $_POST['to_date'];
 $start_time = $_POST['stime'];
 $close_time = $_POST['ctime'];
}
?>
<!-- Content Header (Page header) -->


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="modal-body">

                    <div class="card">
                        <div class="card-header alert-success">
                            <h5 class="m-0">Bookings History</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <b>Turf :</b> <select class="form-control" name="turf_name" required >
                                        <option value="">Select Turf</option>
                                        <?php
                                        $con = connect()->query("SELECT * FROM turf WHERE userid='$userid'");
                                        while ($row = $con->fetch_assoc()) {
                                            echo "<option value='" . $row['turf_name'] . "'>" . $row['turf_name'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                            </div>


                            <div class="row" colspan="2">
                                <div class="col-sm-6">
                                    <b>  From Date : </b><input class="form-control" onchange="check(this.value)" type="date"
                                                                name="from_date" required>
                                </div>


                            </div>
                            <input type="hidden" class="form-control" name="turfid"
                                   value="<?php echo $turfid ?>" required id="">
                            <hr>
                            <input type="submit" name="submit2" class="btn btn-success" value="Submit"></p>
                        </form>


                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                  
   
</section>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
