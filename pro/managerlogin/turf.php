<?php
require_once '../conn.php';
require_once '../constants.php';
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'turf';
$me = "?page=$source";
$userid = $_SESSION['userid'];
if (isset($_POST['submit'])) {
    $tname = $_POST['turf_name'];
    $phone = $_POST['phone'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $files = 'timage';
    if (!isset($tname, $phone, $price, $location, $files)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();
        $timage = uploadTurfFiles('timage');
        $ins = $conn->prepare("INSERT INTO turf (userid,turf_name,phone,price,location,turf_image) VALUES (?,?,?,?,?,?)");
        $ins->bind_param("ssssss", $userid, $tname, $phone, $price, $location, $timage);
        $ins->execute();
        alert("Turf Added!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
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
                                <b> My Turf</b></h2>

                            <div class='float-right'>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#add">
                                    Add New Turf 
                                </button></div>
                        </div
                    </div>
                    
                            <div class="card-body">

                            <table id="" style="align-items: stretch;"
                                   class="table table-hover w-100 table-valign-middle"<?php //
?>">

                                <thead>
                                    <tr>
                                        <th>Sl No:</th>
                                         <th>Turf Image</th>
                                        <th>Turf Name</th>
                                        <th>Contact</th>
                                        <th>price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = connect()->query("SELECT * FROM turf WHERE userid='$userid' ORDER BY userid DESC");
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
                                                                                       <td>

                                                <form method="POST">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#edit<?php echo $id ?>">
                                                        Edit
                                                    </button>  

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



                                    <div class="modal fade" id="edit<?php echo $id ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post" enctype="multipart/form-data">

                                                    <div class="col-sm-12">
                                                        <input type="hidden" class="form-control" name="turfid"
                                                               value="<?php echo $turfid ?>" required id="">
                                                        <p>
                                                            <b>  Turf Name</b>
                                                            <?php
                                                            $cons = connect()->query("SELECT * FROM turf WHERE turfid='$id'");
                                                            ?>
                                                            <input type="text" class="form-control" size="15" maxlength="50" name="edit_turf_name" required value="<?php echo $fetch['turf_name'] ?>" ></td>
                                                        </p>

                                                        <p>
                                                            <b>Contact No</b>
                                                            <input type="text" class="form-control" value="<?php echo $fetch['phone'] ?>" name="edit_phone" required>

                                                        </p>
                                                        <p>
                                                            <b> Price</b>
                                                            <input type="text" class="form-control" value="<?php echo $fetch['price'] ?>" name="edit_price" required >
                                                        </p>


                                                        <p>
                                                            <b> Location</b>
                                                            <input type="text" class="form-control" value="<?php echo $fetch['location'] ?>" name="edit_location" required >

                                                        </p>


                                                        <p><b>Turf Image</b>
                                                            <input type="file" class="form-control" value="<?php echo "uploads/" . ($fetch['turf_image']); ?>" name="edit_timage" >

                                                        </p>

                                                        <input type="hidden" class="form-control" name="turfid"
                                                               value="<?php echo $fetch['turfid'] ?>" required id="">
                                                        <p colspan="2">
                                                        <div class="modal-footer justify-content-between">
                                                            <input class="btn btn-info" type="submit" value="Submit"
                                                                   name='edit'>


                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                        </div>
                                                        </p>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
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
</section>
</div>







<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Add New Turf
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <table class="table table-bordered">

                        <tr>
                            <th>Turf Name</th>
                            <td><input type="text" class="form-control" onchange="check(this.value)" name="turf_name" required ></td>
                        </tr>

                        <tr>
                            <th>Contact No</th>
                            <td><input type="text" class="form-control" onchange="check(this.value)" name="phone" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><input type="text" class="form-control" onchange="check(this.value)"name="price" required >
                            </td>
                        </tr>

                        <tr>
                            <th>Location</th>
                            <td><input type="text" class="form-control" onchange="check(this.value)"name="location" required >
                            </td>
                        </tr>

                        <tr>
                            <th>Turf Image</th>
                            <td><input type="file" class="form-control" onchange="check(this.value)"name="timage" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <input class="btn btn-info" type="submit" value="Add Turf" name='submit'>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</div>


<?php
if (isset($_POST['edit'])) {
    $tname = $_POST['edit_turf_name'];
    $phone = $_POST['edit_phone'];
    $price = $_POST['edit_price'];
    $filez = 'edit_timage';
    $id = $_POST['turfid'];
    if (!isset($tname, $phone, $price)) {
        alert("Fill Form Properly!");
    } else {
        $conn = connect();

        $timage = uploadTurfFiles('edit_timage');
        $ins = $conn->prepare("UPDATE turf SET turf_name = ?, phone = ?, price = ?, turf_image = ? WHERE turfid = ?");
        $ins->bind_param("ssssi", $tname, $phone, $price, $timage, $id);
        $ins->execute();
        alert("Turf Modified!");
        load($_SERVER['PHP_SELF'] . "?page=turf");
    }
}

if (isset($_POST['del_turf'])) {
    $con = connect();
    $conn = $con->query("DELETE FROM turf WHERE turfid = '" . $_POST['del_turf'] . "'");
    if ($con->affected_rows == 0) {
        alert("Turf Could Not Be Deleted. This Turf Has Been Tied To Another Data!");
        load($_SERVER['PHP_SELF'] . "?page=turf");
    } else {
        alert("Turf Deleted!");
        load($_SERVER['PHP_SELF'] . "$me");
    }
}
?>


