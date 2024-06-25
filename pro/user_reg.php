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
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $file = 'file';
  $address = $_POST['address'];
  $cpassword = $_POST['cpassword'];
  $password = $_POST['password'];
  if (!isset($name, $phone, $email, $file, $address, $password, $cpassword) || ($password != $cpassword)) { ?>
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
        alert("Email/phone No. already exists!");
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
      $image = uploadFile('file');
      if ($image == -1) {
        echo "<script>alert('We could not complete your registration, try again later!')</script>";
        exit;
      }
      $stmt = $conn->prepare("INSERT INTO register (name, phone, username, role, address, password, image, status) VALUES (?,?,?,'user',?,?,?,'1')");
      $stmt->bind_param("ssssss", $name, $phone, $email, $address, $password, $image);

      if ($stmt->execute()) {
        ?>
        <script>
          alert("Congratulations.\nYou are now registered.");
        </script>
        <?php
        $getinfo="SELECT userid from register WHERE phone='$phone'";
        $row=mysqli_fetch_assoc(mysqli_query($conn,$getinfo));
        $userid=$row['userid'];
        $to=$email;
        $subject='Registration Successful';
        $body='<!DOCTYPE html>
        <html lang="en">

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Our Response</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        img {height: auto;}
        .content {width: 100%; max-width: 600px;}
        .header {padding: 40px 30px 20px 30px;}
        .innerpadding {padding: 30px 30px 30px 30px;}
        .borderbottom {border-bottom: 1px solid #f2eeed;}
        .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
        .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}
        .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
        .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
        .bodycopy {font-size: 16px; line-height: 22px;}
        .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
        .button a {color: #ffffff; text-decoration: none;}
        .footer {padding: 20px 30px 15px 30px;}
        .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
        .footercopy a {color: #ffffff; text-decoration: underline;}

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
          body[yahoo] .hide {display: none!important;}
          body[yahoo] .buttonwrapper {background-color: transparent!important;}
          body[yahoo] .button {padding: 0px!important;}
          body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
          body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
        }

        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

          </style>
          </head>

          <body yahoo bgcolor="#f6f8f1">
          <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td>
          <!--[if (gte mso 9)|(IE)]>
          <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td>
          <![endif]-->
          <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td bgcolor="#c7d8a7" class="header">
          <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td height="70" style="padding: 0 20px 20px 0;">
          <img class="fix" src="https://e7.pngegg.com/pngimages/847/1016/png-clipart-logo-crest-graphics-freestyle-football-emblem-logo.png" width="70" height="90" border="0" alt="" />
          </td>
          </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td>
          <![endif]-->
          <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 425px;">
          <tr>
          <td height="70">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td class="h2" style="padding: 0 0 0 3px;">
          TURF BOOKING SYSTEM
          </td>
          </tr>
          <tr>
          <td class="h3" style="padding: 5px 0 0 0;">
          REGISTRATION NOTIFICATION
          </td>
          </tr>
          </table>
          </td>
          </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
          </td>
          </tr>
          <tr>
          <td class="innerpadding borderbottom">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td class="h2">
          CONGRATULATIONS
          </td>
          </tr>
          <tr>
          <td class="bodycopy">
          Your Registration completed Successfully</td>
          </tr>
          </table>
          </td>
          </tr>
          <tr>
          <td class="innerpadding borderbottom">
          <table width="115" align="center" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td height="115" style="padding: 0 20px 20px 0;">
          <img class="fix" src="https://www.pngitem.com/pimgs/m/182-1820352_player-football-silhouette-kick-png-free-photo-clipart.png" width="200" height="150" border="0" alt="" />
          </td>
          </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td>
          <![endif]-->
          <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">
          <tr>
          <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td class="bodycopy" align="justify">

          Dear '.$name.',<br>You have successfully registered on<br> TURF BOOKING SYSTEM.

          <br>
          User ID: '.$userid.' <br>
          Name :   '.$name.' <br>
          Phone:   '.$phone.'<br>
          Email:   '.$email.'<br>
          <tr>
          <td class="innerpadding bodycopy">
          If you would like to reach out to us, talk to us any time via the feedback in your account.<br/>Thank You!
          </td>
          </tr>

          </td>
          </tr>
          <tr>
          <td style="padding: 20px 0 0 0;">
          <table class="buttonwrapper" bgcolor="#e05443" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td class="button" height="45">
          <a href="http://localhost/playon/">Visit Us!</a>
          </td>
          </tr>
          </table>
          </td>
          </tr>
          </table>
          </td>
          </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
          </td>
          </tr>

          
          <tr>
          <td class="footer" bgcolor="#44525f">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td align="center" class="footercopy">
          <br/>

          </td>
          </tr>
          <tr>
          <td align="center" style="padding: 20px 0 0 0;">

          </td>
          </tr>
          </table>
          </td>
          </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
          </td>
          </tr>
          </table>
          </body>
          </html>';
          include '../mailer.php';
          ?>

          <script>
            window.location = 'signin.php';
          </script>
          <?php
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
        <marquee behavior="" scrollamount="2" direction="">You need to create an account to Book/view Turf !
        </marquee>
      </p>
      <form class="login-form" method="post" role="form" enctype="multipart/form-data" id="signup-form"
      autocomplete="off">
      <!-- json response will be here -->
      <div id="errorDiv"></div>
      <!-- json response will be here -->
      <div class="col-md-12">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" required minlength="4" name="name">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" minlength="10" pattern="[0-9]{10}" required name="phone">
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
          <label>Upload Profile Pic</label>
          <input type="file" name='file' required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Location</label>
          <input type='text' name="address" class="form-group" required>
        </select>
        <span class="help-block" id="error"></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
        <span class="help-block" id="error"></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="cpassword" id="cpassword" required>
        <span class="help-block" id="error"></span>
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