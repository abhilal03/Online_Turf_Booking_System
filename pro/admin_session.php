 <?php
  @session_start();
  if (!isset($_SESSION['role'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  if (($_SESSION['category']) != 'admin' && $_SESSION['category'] != 'super') {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  $user_id = $_SESSION['role'];
  if (!isset($conn)) require '../conn.php';

  ?>