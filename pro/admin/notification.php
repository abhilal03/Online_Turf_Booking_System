<?php
$conn = connect()->query("SELECT * FROM notify WHERE userid=1 AND status=0");
while ($fetch = $conn->fetch_assoc()) {
    $userid = $fetch['userid'];
    $message = $fetch['message'];
    $noti_id = $fetch['noti_id'];
    echo $message;
    $conn = connect()->query("UPDATE `notify` SET `status`=1 WHERE noti_id = $noti_id");
    die;
}
echo 2;die;
?>

