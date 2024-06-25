<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'booking';
$me = "?page=$source";
$userid = $_SESSION['userid'];
$slotid = $_GET['id'];
?>

<?php
$row = $conn->query("SELECT * FROM slot WHERE slotid='$slotid'");

while ($fetch = $row->fetch_assoc()) {
    $id = $fetch['slotid'];
    $name = $fetch['name'];
    $phone = $fetch['phone'];
    $status = $fetch['status'];
    ?>



    <div class="content">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-center">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Booking</h3>

                                </div>

                                <div class="card-body">

                                    <table id="example1" style="align-items: center;"
                                           class="table table-hover w-100 table-bordered table-striped<?php //     ?>">
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" class="form-control" name="slotid"
                                                       value="<?php echo $id ?>" required >
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <b> Name :</b> <input class="form-control" type="text"
                                                                                  value="" name="name"
                                                                                  required id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <b> Location :</b> <input class="form-control" type="text"
                                                                                      value="" name="location" required="">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <b> Mobile No :</b> <input class="form-control" type="text"
                                                                                       value="" name="phone"
                                                                                       required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <b> Email :</b> <input class="form-control" type="email"
                                                                                   value="" name="email">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <b>  Turf Name :</b> <input class="form-control" type="text"
                                                                                        value="<?php echo $fetch['turfname'] ?>" name="turfname"
                                                                                        readonly="readonly" required id="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <b>  Date :</b>
                                                            <input type="date" class="form-control"
                                                                   onchange="check(this.value)" id="date"
                                                                   placeholder="Date" name="date" required readonly="readonly"
                                                                   value="<?php echo (date('Y-m-d', strtotime($fetch["date"]))) ?>">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <b>  Starting Time :</b> <input class="form-control" type="time"
                                                                                            value="<?php echo $fetch['starttime'] ?>" name="start_time"
                                                                                            required id="" readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <b>End Time : </b><input class="form-control" type="time"
                                                                                         value="<?php echo $fetch['closetime'] ?>" name="close_time"
                                                                                         required id="" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="form-control" type="hidden"
                                                       value="<?php echo $fetch['status'] ?>" name="status"
                                                       required id="" >
                                                <div class="form-inline">
                                                    <div class="float-right">
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            <input type="submit" name="book"
                                                                   class="btn btn-success" align="center" value="Book">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        <?php
    }
    ?>



    <?php
    if (isset($_POST['book'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $turfname = $_POST['turfname'];
        $date = $_POST['date'];
        $date = formatDate($date);
        $stime = $_POST['start_time'];
        $ctime = $_POST['close_time'];
        $status = "Booked";
        $id = $_POST['slotid'];

        if (!isset($name, $phone, $turfname, $date, $stime, $ctime)) {
            alert("Fill Form Properly!");
        } else {

            $conn = connect();
            $ins = $conn->prepare("UPDATE `slot` SET `bookingid`=?,`turfname`=?,`date`=?,`starttime`=?,`closetime`=?, `status`=?, `name`=?, `phone`=?, `email`=?,`location`=? WHERE slotid = ?");
            $ins->bind_param("isssssssssi", $userid, $turfname, $date, $stime, $ctime, $status, $name, $phone,$email, $location, $id);
            $ins->execute();
//$msg = "Having considered user's satisfactions and every other things, we the management are so sorry to let inform you that there has been a change in the date and time of your trip. <hr/> New Date : $date. <br/> New Time : " . formatTime($ctime) . " <hr/> Kindly disregard if the date/time still stays the same.";
// $e = $conn->query("SELECT * FROM schedule WHERE userid='$userid'  ORDER BY scheduleid DESC");
// while ($getter = $e->fetch_assoc()) {
// @sendMail($getter['username'], "Change In Trip Date/Time", $msg);
//}
            alert("Your Turf Booked Sucessfully!");
            load($_SERVER['PHP_SELF'] . "?page=book");
        }
    }
    ?>