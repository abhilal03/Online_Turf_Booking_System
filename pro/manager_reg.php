<?php
session_start();
require_once '../conn.php';
require_once '../constants.php';
$class = "reg";
?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
include 'includes/inc-nav.php';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $tname = $_POST['tname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $files = 'proof';
    $filez = 'profilePhoto';
    $address = $_POST['address'];
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if (!isset($name, $tname, $phone, $email, $location, $files, $filez, $address, $password, $cpassword) || ($password != $cpassword)) { ?>
<script>
alert("Ensure you fill the form properly.");
</script>
<?php
    } else {
        //Check if email exists
        $check_email = $conn->prepare("SELECT * FROM register WHERE username = ? OR phone = ?");
        $check_email->bind_param("ss", $email, $phone);
        $check_email->execute();
        $res = $check_email->store_result();
        $res = $check_email->num_rows();
        if ($res) {
        ?>
<script>
alert("Email already exists!");
</script>
<?php

        } elseif ($cpassword != $password) { ?>
<script>
alert("Password does not match.");
</script>
<?php
        } else {
            //Insert
            $password = md5($password);
            $can = 1;
            $proof = uploadFiles('proof');
            if ($proof == -1) {
                echo "<script>alert('Updated Certificate is not in correct format!')</script>";
                exit;
            }
            $profilePhoto = uploadProfilePhoto('profilePhoto');
            if ($profilePhoto == -1) {
                echo "<script>alert('Updated profile Photo is not in correct format!')</script>";
                exit;
            }
            $stmt = $conn->prepare("INSERT INTO register (name, turf_name, phone, address, location, username, password, proof, image) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssss", $name, $tname, $phone, $address, $location, $email, $password, $proof, $profilePhoto);
           
            $smt = $conn->prepare("INSERT INTO notify (userid,message,status) VALUES (1,'Manager Registered','true')");
             $smt->execute();
            if ($stmt->execute()) {
            ?>
<script>
alert("Congratulations.\nYou are now registered.");
window.location = 'signin.php';
</script>
<?php
$sql="UPDATE register Set role = 'manager'Where username = '$email'";
            mysqli_query($conn,$sql);
            } else {
            ?>
<script>
alert("We could not register you!.");
</script>
<?php
            }
        }
    }
}
?>
<div class="signup-page">
    <div class="form">
        <h2>Create Account </h2>
        <br>
        <p class="alert alert-info">
            <marquee behavior="" scrollamount="2" direction="">You need to create an account to Add/view truf!
            </marquee>
        </p>
        <form class="login-form" method="post" role="form" enctype="multipart/form-data" id="signup-form"
            autocomplete="off">
            <!-- json response will be here -->
            <div id="errorDiv"></div>
            <!-- json response will be here -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Manager/Owner Full Name</label>
                    <input type="text" required minlength="4" name="name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Turf Name</label>
                    <input type="text" required minlength="5" name="tname">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" minlength="10" pattern="[789][0-9]{9}" required name="phone">
                </div>
            </div>
        

            <div class="col-md-12">
                <div class="form-group">
                    <label>Address</label>
                    <input type='text' name="address" class="form-group" required>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>Location</label>
                    <input type='text' name="location" class="form-group" required>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" required name="email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" id="password">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword">
                    <span class="help-block" id="error"></span>
                </div>
            </div>

             <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Turf Certificate</label>
                    <input type="file" name='proof' required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Upload Profile Picture</label>
                    <input type="file" name='profilePhoto' required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" id="btn-signup">
                        CREATE ACCOUNT
                    </button>
                </div>
            </div>
            <p class="message">
                <a href="#">.</a><br>
            </p>
        </form>
    </div>
</div>
</div>
<script src="assets/js/jquery-1.12.4-jquery.min.js"></script>

</body>

</html>