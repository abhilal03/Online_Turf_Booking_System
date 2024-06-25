<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'book';
$me = "?page=$source";
$userid = $_SESSION['userid'];
?>
<html>
    <head>
        <style>
            td {
                text-align: center;
            }
             th {
                text-align: center;
            }
            h3 {
               text-transform: uppercase;
               font-weight: 600;
               border-left: 10px solid #fec500;
               padding-left: 10px;
               margin-bottom: 0px;
               margin-top: 0px;
               }

        </style>
    </head>
    <body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="modal-body">

                    <div class="card">
                        <div class="card-header alert-success">
                            <h3 class="card-title"><b>Booking</b></h3>
                        </div>

                        <div class="modal-body">

                            <form action="" method="post" >
                                <div class="float-center">
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <b> Date : </b><input class="form-control" onchange="check(this.value)" type="date"
                                                                  name="from_date"  id="bookingdate" required value="<?php if (isset($_POST['from_date'])) {
                                    echo $_POST['from_date'];}?>"> <script>
                                        bookingdate.min = new Date().toISOString().split("T")[0];
                                    </script>
                                        </div>


                                    </div>

                                    <hr>
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit"></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  
<?php
if (isset($_POST['submit'])) {
    $tname = $_POST['turf_name'];
    $cons = connect()->query("SELECT * FROM slot WHERE turfname='$tname'");
    $temprow = $cons->fetch_assoc();
    $turfid = $temprow['turfid'];
    $from_date = $_POST['from_date'];
    $date = date('d-m-Y', strtotime($from_date));



    if (!isset($tname, $from_date)) {
        alert("Fill Form Properly!");
    } else {
        ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-success">
                    <h3 class="card-title"><b><?php echo $tname;?> Slots</b></h3>
                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <table id="example1" style="align-items: stretch;"
                               class="table table-hover w-100  table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Turf Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = $conn->query("SELECT * FROM slot WHERE turfname='$tname' AND date='$date'");

                                if ($row->num_rows < 1)
                                    echo "No Records Yet";
                                $sn = 0;
                                while ($fetch = $row->fetch_assoc()) {

                                    $id = $fetch['slotid'];
                                     $starttime = $fetch['starttime'];
                                     $closetime = $fetch['closetime'];
                                     $starttimes = strtotime($starttime);
                                     $closetimes = strtotime($closetime);
                                    ?><tr>
                                        <td><?php echo ++$sn; ?></td>
                                        <td><?php echo ($fetch['turfname']); ?></td>

                                        <td> <?php echo ($fetch['date']); ?></td>
                                        <td> <?php echo date('h:i ', $starttimes); ?> - 
                                       <?php echo date('h:i A', $closetimes); ?></td>


                                        <td>
                                            <?php
                                            if ($fetch['status'] == 'Available') {
                                                ?>
                                                <a href="managerlogin.php?page=booking&status='Available'&id=<?php echo $id; ?>">
                                                    <button
                                                        onclick="return confirm('Are you want to Book this Slot')"
                                                        type="submit" class="btn btn-success">
                                                        Available
                                                    </button></a>
                                            <?php } else { ?>
                                                <a href="">
                                                    <button
                                                        onclick="return confirm('This slot is already booked')"
                                                        type="submit" class="btn btn-danger">
                                                        Booked
                                                    </button></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                        ?>



                    </tbody>



                </table>

            </div>
        </div>
    </div>
        </div>
    </div>
</section>
  </body>
</html>







