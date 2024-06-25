<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'history';
$me = "?page=$source";
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body{margin-top:0px;
                 background-color:#f2f6fc;
                 color:#69707a;
            }
            .img-account-profile {
                height: 10rem;
            }
            .rounded-circle {
                border-radius: 50% !important;
            }
            .card {
                box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
            }
            .card .card-header {
                font-weight: 500;
            }
            .card-header:first-child {
                border-radius: 0.35rem 0.35rem 0 0;
            }
            h2 {
                text-transform: uppercase;
                font-weight: 500px;
                border-left: 10px solid #fec500;
                padding-left: 10px;
                margin-bottom: 0px
            }

            .form-control, .dataTable-input {
                display: block;
                width: 100%;
                padding: 0.875rem 1.125rem;
                font-size: 0.875rem;
                font-weight: 400;
                line-height: 1;
                color: #69707a;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #c5ccd6;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border-radius: 0.35rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .nav-borders .nav-link.active {
                color: #0061f2;
                border-bottom-color: #0061f2;
            }
            .nav-borders .nav-link {
                color: #69707a;
                border-bottom-width: 0.125rem;
                border-bottom-style: solid;
                border-bottom-color: transparent;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                padding-left: 0;
                padding-right: 0;
                margin-left: 1rem;
                margin-right: 1rem;
            }
        </style>
    </head>
    <body>
        <?php
        $cons = connect()->query("SELECT * FROM register WHERE userid='$userid'");
        while ($fetch = $cons->fetch_assoc()) {
            $userid = $fetch['userid'];
            $email = $fetch['username'];
            $phone = $fetch['phone'];
            $name = $fetch['name'];
            $password = $fetch['password'];
            $location = $fetch['location'];
            ?>
            <div class="row">
                <div class="col-12">

                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header alert-success">
                                <h2> Profile</h2>
                            </div>
                            <div class="card-body">
                                <hr class="mt-0 mb-4">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <!-- Profile picture card-->
                                        <div class="card mb-4 mb-xl-0">
                                            <div class="card-header">Profile Picture</div>
                                            <div class="card-body text-center">

                                                <!-- Profile picture image-->

                                                <img class="img-account-profile rounded-circle mb-2"  src="<?php
                                                echo getImage($_SESSION['userid'], $conn);
                                                ?>" alt="">

                                                <!-- Profile picture help block-->
                                                <!-- Profile picture upload button-->
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" class="form-control" name="userid"
                                                           value="<?php echo $userid ?>" required id="">

                                                    <div class="float-center">
                                                        <input type="file" class="form-control" name="edit_image" value="" required >
                                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                                                    </div>
                                                    <button class="btn btn-primary" name="edit2" type="submit">Upload new image</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <!-- Account details card-->
                                        <div class="card mb-4">
                                            <div class="card-header">Account Details</div>
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    <input type="hidden" class="form-control" name="userid"
                                                           value="<?php echo $userid ?>" required id="">
                                                    <!-- Form Group (username)-->
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputUsername">Name </label>
                                                        <input class="form-control"  name="ename" type="text" placeholder="Enter your Name" value="<?php echo $name; ?>" required>
                                                    </div>
                                                    <!-- Form Row-->

                                                    <!-- Form Row        -->
                                                    <div class="row gx-3 mb-3">
                                                        <!-- Form Group (organization name)-->
                                                        <div class="col-md-6">
                                                            <label class="small mb-1" for="inputLocation">Location</label>
                                                            <input class="form-control"  name="elocation"type="text" placeholder="Enter your location" value="<?php echo $location; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="small mb-1" for="inputPhone">Phone number</label>
                                                            <input class="form-control"  type="tel" name="ephone" placeholder="Enter your phone number" value="<?php echo $phone; ?>" required pattern="[789][0-9]{9}">
                                                        </div>


                                                    </div>
                                                    <!-- Form Group (email address)-->
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                        <input class="form-control"  type="email" name="eemail" placeholder="Enter your email address" value="<?php echo $email; ?>" required>
                                                    </div>
                                                    <!-- Form Row-->

                                                    <!-- Save changes button-->
                                                    <button class="btn btn-primary" type="submit" name="edit">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <!-- Account details card-->
                                        <div class="card mb-4">
                                            <div class="card-header">Password Reset</div>
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    <!-- Form Group (username)-->
                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-4">
                                                            <label class="small mb-1" for="inputUsername">Current Password </label>
                                                            <input class="form-control" name="password" type="password" placeholder="" value="" required>
                                                        </div>

                                                        <!-- Form Group (organization name)-->
                                                        <div class="col-md-4">
                                                            <label class="small mb-1" for="inputPhone">New Password</label>
                                                            <input class="form-control"  type="password" name="newpassword" placeholder="" value="" required>
                                                        </div>
                                                        <!-- Form Group (location)-->
                                                        <div class="col-md-4">
                                                            <label class="small mb-1" for="inputLocation">Confirm New Password</label>
                                                            <input class="form-control" id="inputLocation" name="confirmnewpassword" type="password" placeholder="" value="" required>
                                                        </div>

                                                    </div>
                                                    <button class="btn btn-primary" type="submit" name="edit3" >Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>



    </body>
</html>

<?php
if (isset($_POST['edit'])) {
    $ename = $_POST['ename'];
    $elocation = $_POST['elocation'];
    $ephone = $_POST['ephone'];
    $eemail = $_POST['eemail'];



    if (!isset($ename, $elocation, $ephone, $eemail)) {
        alert("Fill Form Properly!");
    }  else {
        //Check if email exists
        $check_email = $conn->prepare("SELECT * FROM register WHERE (userid <> ?) AND (username = ? OR phone = ?) ");
        $check_email->bind_param("iss",$userid, $eemail, $ephone);
        $check_email->execute();
        $res = $check_email->store_result();
        $res = $check_email->num_rows();
        if ($res) {
        ?>
<script>
alert("Email already exists!");
</script>
<?php
}  else {
        $cons = connect();
        $ins = $cons->prepare("UPDATE register SET name = ?, location = ?, phone = ?, username = ? WHERE userid = ?");
        $ins->bind_param("ssssi", $ename, $elocation, $ephone, $eemail, $userid);
        $ins->execute();
        alert("Profile Updated!");
        load($_SERVER['PHP_SELF'] . "?page=profile");
    }
}
}

if (isset($_POST['edit2'])) {

    $file = 'edit_image';

    $conn = connect();
    $image = uploadFile('edit_image');
    $ins = $conn->prepare("UPDATE register SET image = ? WHERE userid = ?");
    $ins->bind_param("si", $image, $userid);
    $ins->execute();
    alert("Profile Picture Updated!");
    load($_SERVER['PHP_SELF'] . "?page=profile");
}

if (isset($_POST['edit3'])) {
    $tpassword = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $confirmnewpassword = md5($_POST['confirmnewpassword']);
    if (!isset($tpassword, $newpassword, $confirmnewpassword))
        alert("Fill ");
    else {

        if ($password != $tpassword) {
            alert("Wrong Password!");
        } else if ($password == $tpassword) {

            if ($newpassword != $confirmnewpassword) {
                alert("New Password does not match!");
            } else {

                $cons = connect();
                $ins = $cons->prepare("UPDATE register SET password = ? WHERE userid = ?");
                $ins->bind_param("si", $newpassword, $userid);
                $ins->execute();
                alert("Password Updated Sucessfully!");
                load($_SERVER['PHP_SELF'] . "?page=profile");
            }
        }
    }
}
?>