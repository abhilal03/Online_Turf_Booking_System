<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'turf';
$me = "?page=$source";
if (isset($_GET['status'], $_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 0) {
        $status = 0;
    } else {
        $status = 1;
    }
    $conn = connect()->query("UPDATE turf SET status = '$status' WHERE turfid = '$id'");
    echo "<script>alert('Action completed!');window.location='admin.php$me';</script>";
}
?>

<script src="plugins/jquery/jquery.min.js"></script>
<script>
    setTimeout(function () {
        get_notification();
    }, 5000);

    function get_notification() {
        $.ajax({
            url: "admin.php?page=notification",
            success: function (data) {
                if (data != 2) {
                    var notification = new Notification('New Notification', {
                        icon: 'https://www.freepnglogos.com/uploads/football-png/football-aitc-sports-football-logo-22.png',
                        body: data,
                        sound : '',
                    });
                    
                     notification.onclick = function() {
   window.open('http://localhost/playon/pro/admin.php?page=feedback');
  };
                }
                setTimeout(function () {
                    get_notification();
                }, 5000);
            }
        });
    }

//
//    var feedback = $.ajax({
//        type: "POST",
//        url: "admin.php?page=notification",
//        async: false
//    }).success(function () {
////            setTimeout(function () {
////                get_fb();
////            }, 10000);
//    }).responseText;
//    alert(feedback)

</script>
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
        <div class="content">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 >
                                            Turf</h3>


                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table style="width: 100%;" id="example1" style="align-items: stretch;"
                                               class="table table-hover table-valign-middle ">

                                            <thead>
                                                <tr>
                                                    <th>Sl No:</th>
                                                    <th>Turf Image</th>
                                                    <th>Turf Name</th>
                                                    <th>Contact</th>
                                                    <th>price</th>
                                                    <th>Booking History</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = connect()->query("SELECT * FROM turf  ORDER BY turfid DESC");
                                                if ($row->num_rows < 1)
                                                    echo "No Records Yet";
                                                $sn = 0;
                                                while ($fetch = $row->fetch_assoc()) {
                                                    $id = $fetch['turfid'];
                                                    ?><tr>
                                                        <td><?php echo ++$sn; ?></td>
                                                        <td>
                                                            <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>"
                                                                 class="img img-rounded" width="180" height="100" /></td>
                                                        <td><?php echo ($fetch['turf_name']); ?></td>
                                                        <td><?php echo ($fetch['phone']); ?></td>
                                                        <td><?php echo ($fetch['price']); ?></td>
                                                        <td> <a href="admin.php?page=history&id=<?php echo $id; ?>">
                                                                <button  type="submit" class="btn btn-success">
                                                                    View  <i class="fa fa-book"></i>
                                                                </button></a></td>
                                                        <td>
                                                            <?php
                                                            if ($fetch['status'] == 0) {
                                                                ?>
                                                                <a href="admin.php?page=turf&status=1&id=<?php echo $id; ?>">
                                                                    <button
                                                                        onclick="return confirm('You are about allowing this Turf be able to book.')"
                                                                        type="submit" class="btn btn-success">
                                                                        Enable Account
                                                                    </button></a>
                                                            <?php } else { ?>
                                                                <a href="admin.php?page=turf&status=0&id=<?php echo $id; ?>">
                                                                    <button
                                                                        onclick="return confirm('You are about denying this user access to  his/her account.')"
                                                                        type="submit" class="btn btn-danger">
                                                                        Disable Account
                                                                    </button></a>
                                                            <?php } ?>
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
        </div>
    </body>
</html>