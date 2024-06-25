<?php
session_start();
require_once '../conn.php';
$file = "admin";

?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
if (isset($_POST['email'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];
    if (!isset($username, $password)) {
        ?>
        <script>
            alert("Ensure you fill the form properly.");
        </script>
        <?php
    } else {

        //Check for login

        $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $role = $row['role'];
            $id = $row['userid'];
            echo $role;
            session_regenerate_id(true);
            $_SESSION['category'] = "super";
            $_SESSION['role'] = $role;
            $_SESSION['userid'] = $id;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $row['username'];
            if($role == "admin"){
                $_SESSION['admin'] = $id;
                header("Location: admin.php");
            } elseif ($role == "manager") {
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $row['username'];
              header("Location: individual.php");
          }elseif ($role == "user") {
            $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $row['username'];
              header("Location: ../../userhome.html");
          } 
      }else {
        ?>
        <script>
            alert("Invalid username or password !");
        </script>
        <?php
    }
    ?>
    <?php

} 
}

?>
<div class="signup-page">
    <div class="form">
        <h2>Admin Sign In</h2>
        <br>
        <form class="login-form" method="post" role="form" id="signup-form" autocomplete="off">
            <!-- json response will be here -->
            <div id="errorDiv"></div>
            <!-- json response will be here -->

            <div class="col-md-12">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" required name="email">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                    <span class="help-block" id="error"></span>
                </div>
            </div>



            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" id="btn-signup">
                        SIGN IN
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