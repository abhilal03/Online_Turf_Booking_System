<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'schedule';
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
            h2 {
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
        <div class="content">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <b> All Dynamic Schedules</b></h2>
                                    <div class='float-right'>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#add2">
                                            Add New Schedule
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <table id="example1" style="align-items: stretch;"
                                           class="table table-hover w-100 table-valign-middle table-striped<?php //
?>">
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
                                            $row = $conn->query("SELECT * FROM schedule WHERE userid='$userid'  ORDER BY scheduleid DESC");

                                            if ($row->num_rows < 1)
                                                echo "No Records Yet";
                                            $sn = 0;
                                            while ($fetch = $row->fetch_assoc()) {
                                                $id = $fetch['scheduleid'];
                                                $starttime = $fetch['start_time'];
                                                $closetime = $fetch['close_time'];
                                                $starttimes = strtotime($starttime);
                                                $closetimes = strtotime($closetime);
                                                $input = $fetch['date_from'];
                                                $dates = strtotime($input);
                                                ?><tr>
                                                    <td><?php echo ++$sn; ?></td>
                                                    <td><?php echo ($fetch['turf_name']); ?></td>

                                                    <td> <?php echo date('d M Y', $dates); ?></td>

                                                    <td> <?php echo date('h:i A', $starttimes), "-", date('h:i A', $closetimes); ?></td>



                                                    <td>
                                                        <form method="POST">


                                                            <input type="hidden" class="form-control" name="del_turf"
                                                                   value="<?php echo $id ?>" required id="">
                                                            <button type="submit"
                                                                    onclick="return confirm('Are you sure about this?')"
                                                                    class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>




        <div class="modal fade" id="add2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" align="center">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Schedule
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                
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


                                <div class="col-sm-6">
                                    <b>   Date : </b><input class="form-control" onchange="check(this.value)" type="date" id="bookingdate"
                                                            name="from_date" required>
                                    <script>
                                        bookingdate.min = new Date().toISOString().split("T")[0];
                                    </script>
                                </div>

                            </div>

                            <br>
                            <div class="row">
                                <div class="col-sm-6">

                                    <b>   Starting Time :</b> <input class="form-control" type="time" name="stime" required id="">
                                </div>


                                <div class="col-sm-6">

                                    <b>  Closing   Time : </b><input class="form-control" type="time" name="ctime" required id="">
                                </div>
                            </div>
                            <br>

                            <input type="hidden" class="form-control" name="turfid"
                                   value="<?php echo $turfid ?>" required id="">
                            <hr>
                            <input type="submit" name="submit2" class="btn btn-success" value="Add Schedule"></p>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<?php
if (isset($_POST['submit2'])) {


    $tname = $_POST['turf_name'];
    $cons = connect()->query("SELECT * FROM turf WHERE turf_name='$tname'");
    $temprow = $cons->fetch_assoc();

    $turfid = $temprow['turfid'];
    $from_date = $_POST['from_date'];
    $start_time = $_POST['stime'];
    $close_time = $_POST['ctime'];

    if (!isset($tname, $from_date, $start_time, $close_time)) {
        alert("Fill Form Properly!");
    } else {
        $from_date = formatDate($from_date);
        $startDate = $from_date;
        //Check if email exists
        $check_date = $conn->prepare("SELECT * FROM schedule WHERE turfid = ? AND date_from = ?");
        $check_date->bind_param("is", $turfid, $startDate);
        $check_date->execute();
        $res = $check_date->store_result();
        $res = $check_date->num_rows();

        if ($res) {
            ?>
            <script>
                alert("This date is already Scheduled!");
            </script>
            <?php
        } else {


            $from_date = formatDate($from_date);
            $startDate = $from_date;
            $start_time = $_POST['stime'];
            $close_time = $_POST['ctime'];
            $turfname = $_POST['turf_name'];
            $conn = connect();

            $ins = $conn->prepare("INSERT INTO `schedule`(`userid`, `turfid`, `turf_name`, `date_from`, `start_time`, `close_time`) VALUES (?,?,?,?,?,?)");
            $ins->bind_param("iissss", $userid, $turfid, $tname, $from_date, $start_time, $close_time);
            $ins->execute();
            getTimeSlot($start_time, $close_time, $turfid, $userid, $turfname, $startDate, $conn);

            alert("Schedules Added!");
            load($_SERVER['PHP_SELF'] . "$me");
        }
    }
}
if (isset($_POST['edit'])) {

    $turfname = $_POST['eturfname'];
    $fdate = $_POST['edate_from'];
    $fdate = formatDate($fdate);
    $tdate = $_POST['edate_to'];
    $tdate = formatDate($tdate);
    $stime = $_POST['estart_time'];
    $ctime = $_POST['eclose_time'];
    $id = $_POST['scheduleid'];
    if (!isset($turfname, $fdate, $tdate, $stime, $ctime)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $ins = $conn->prepare("UPDATE `schedule` SET `turf_name`=?,`date_from`=?,`date_to`=?,`start_time`=?,`close_time`=? WHERE scheduleid = ?");
        $ins->bind_param("sssssi", $turfname, $fdate, $tdate, $stime, $ctime, $id);
        $ins->execute();
        //$msg = "Having considered user's satisfactions and every other things, we the management are so sorry to let inform you that there has been a change in the date and time of your trip. <hr/> New Date : $date. <br/> New Time : " . formatTime($ctime) . " <hr/> Kindly disregard if the date/time still stays the same.";
        // $e = $conn->query("SELECT * FROM schedule WHERE userid='$userid'  ORDER BY scheduleid DESC");
        // while ($getter = $e->fetch_assoc()) {
        // @sendMail($getter['username'], "Change In Trip Date/Time", $msg);
        //}
        alert("Schedule Modified!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}

if (isset($_POST['del_turf'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM schedule WHERE scheduleid = '" . $_POST['del_turf'] . "'");
    if ($con->affected_rows < 1) {
        alert("Schedule Could Not Be Deleted. This Turf Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "$me");
    } else {
        alert("Schedule Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>