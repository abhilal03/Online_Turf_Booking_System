<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'users';
$me = "?page=$source";
if (isset($_GET['status'], $_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 0) {
        $status = 0;
    } else {
        $status = 1;
    }
    $conn = connect()->query("UPDATE register SET status = '$status' WHERE userid = '$id'");
    echo "<script>alert('Action completed!');window.location='admin.php$me';</script>";
}
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
        <div class="content">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3>
                                        Registered Users</h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table style="width: 100%;" id="example1" style="align-items: stretch; "
                                               class="table table-hover table-valign-middle">

                                            <thead>
                                                <tr>
                                                    <th>Sl No:</th>
                                                    <th> Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = connect()->query("SELECT * FROM register WHERE role='user' ORDER BY userid DESC");
                                                if ($row->num_rows < 1)
                                                    echo "No Records Yet";
                                                $sn = 0;
                                                while ($fetch = $row->fetch_assoc()) {
                                                    $id = $fetch['userid'];
                                                    ?><tr>
                                                        <td><?php echo ++$sn; ?></td>
                                                        <td><?php echo ($fetch['name']); ?></td>
                                                        <td><?php echo ($fetch['username']); ?></td>
                                                        <td><?php echo ($fetch['phone']); ?></td>
                                                        <td><img src="<?php echo "uploads/" . ($fetch['image']); ?>"
                                                                 class="img img-rounded" width="80" height="80" /></td>


                                                        <td>
    <?php
    if ($fetch['status'] == 0) {
        ?>
                                                                <a href="admin.php?page=users&status=1&id=<?php echo $id; ?>">
                                                                    <button
                                                                        onclick="return confirm('You are about allowing this user be able to login his/her account.')"
                                                                        type="submit" class="btn btn-success">
                                                                        Enable Account
                                                                    </button></a>
    <?php } else { ?>
                                                                <a href="admin.php?page=users&status=0&id=<?php echo $id; ?>">
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


