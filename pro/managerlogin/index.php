<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$userid = $_SESSION['userid'];
$date = getToday();
$date = date('d-m-Y', strtotime($date));
?>
<div class="content">
    <h5 class="mt-4 mb-2">Hi, <?php echo $fullname ?></h5>
    <div class="row">

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-dark">
                <span class="info-box-icon"><i class="fa fa-route"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>TURF</b></span>
                    <span class="info-box-number"><?php
                        echo $comp = $conn->query("SELECT * FROM turf Where userid='$userid'")->num_rows;
                        ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-secondary">
                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>SCHEDULED</b></span>
                    <span
                        class="info-box-number"><?php echo connect()->query("SELECT * FROM schedule Where userid='$userid' AND date_from = '$date' ")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <!-- /.col-md-6 -->

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>BOOKED</b></span>
                    <span class="info-box-number"><?php
                        echo $reg = $conn->query("SELECT * FROM slot WHERE userid='$userid' AND date='$date' AND status='Booked'")->num_rows;
                        ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <?php //readonly  
                    ?>
                </div>
                <!-- /.info-box-content -->

            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>AVAILABLE</b></span>
                    <span class="info-box-number"> <?php
                        echo $reg = $conn->query("SELECT * FROM slot WHERE userid='$userid' AND date='$date' AND status='Available'")->num_rows;
                        ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fa fa-book nav-icon"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>TOTAL SLOTS</b></span>
                    <span class="info-box-number"><?php echo connect()->query("SELECT * FROM slot WHERE userid='$userid' AND date='$date'")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fa fa-comment-dots"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>FEEDBACK</b></span>
                    <span class="info-box-number"><?php echo connect()->query("SELECT * FROM feedback WHERE userid='$userid'")->num_rows ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!-- /.content -->
<!-- /.col -->

<!-- /.row -->