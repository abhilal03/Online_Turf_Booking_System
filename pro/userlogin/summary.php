<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'summary';
$me = "?page=$source";
$userid = $_SESSION['userid'];
$slotid = $_GET['id'];
$turfid = $_GET['turfid'];
?>



<!DOCTYPE html>
<html>

    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" language="javascript">
            function myscript() {
                console.log("Hello bahi");
                $(document).ready(function () {
                    $("#myModal").modal('show');
                });
            }
        </script>
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 700px;
                margin: auto;
                text-align: center;
                font-family: arial;
            }
            h3 {
                text-transform: uppercase;
                font-weight: 600;
                border-left: 10px solid #fec500;
                padding-left: 10px;
                margin-bottom: 5px
            }
            .price {
                color: grey;
                font-size: 22px;
            }

            .card button {
                border: none;
                outline: 0;
                padding: 12px;
                color: white;
                background-color: #000;
                text-align: center;
                cursor: pointer;
                width: 100%;
                font-size: 18px;
            }

            .card button:hover {
                opacity: 0.7;
            }

            hr.solid {
                border-top: 5px solid black;
                border-radius: 3px;
            }
        </style>
    </head>

    <body>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card-header alert-success">
                            <h3>Booking Summary</h3>
                        </div>
                    </div>

                </div>
            </div>
            <form action="" method="POST">

                <div class="card">

                    <hr class="solid">
                    <?php
                    $conn = connect()->query("SELECT * FROM turf WHERE turfid='$turfid'");
                    while ($fetch = $conn->fetch_assoc()) {
                        $turfid = $fetch['turfid'];
                        $phone = $fetch['phone'];
                        $location = $fetch['location'];
                        $tname = $fetch['turf_name'];
                        $price = $fetch['price'];
                        $tprice= ($price*5)/100;
                        $gprice = $price+$tprice;
                        ?>
                        <div class="float-center"><br>
                            <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>" alt="Denim Jeans" style="width:440px; height: 220px;">
                        </div>

                        <p>
                        <h1><?php echo ($fetch['turf_name']); ?></h1>
                        </p>
                        <hr class="solid">


                        <p class="price">
                        <h5>Price : <?php echo ($fetch['price']); ?> Rs</h5>
                        </p>
                        <?php
                    }

                    $con = connect()->query("SELECT * FROM slot WHERE slotid='$slotid'");
                    while ($fetch = $con->fetch_assoc()) {
                        $turfid = $fetch['turfid'];
                        $starttime = $fetch['starttime'];
                        $closetime = $fetch['closetime'];
                        $starttimes = strtotime($starttime);
                        $closetimes = strtotime($closetime);
                        $input = $fetch['date'];
                        $dates = strtotime($input);
                        ?>

                        <p>
                        <h5>Date : <?php echo date('d M Y', $dates); ?></h5>
                        </p>
                        <p>
                        <h5>Time : <?php echo date('h:i ', $starttimes); ?> - <?php echo date('h:i A', $closetimes); ?></h5>
                        </p>



                        <?php
                    }
                    ?>
                    <p>
                    <h5>Location : <?php echo $location; ?></h5>
                    </p>
                    <p>
                    <h5> Contact No : <?php echo $phone; ?></h5>
                    </p>
                    <hr class="solid">
                    <?php
                    $cons = connect()->query("SELECT * FROM register WHERE userid='$userid'");
                    while ($fetch = $cons->fetch_assoc()) {
                        $userid = $fetch['userid'];
                        $email = $fetch['username'];
                        $uphone = $fetch['phone'];
                        $name = $fetch['name'];
                        $ulocation = $fetch['location'];
                        ?>
                        <p>
                        <h4> <?php echo ($fetch['name']); ?></h4>
                        </p>
                        <p>
                        <h5>Address : <?php echo ($fetch['address']); ?></h5>
                        </p>
                        <p>
                        <h5>Location : <?php echo ($fetch['location']); ?></h5>
                        </p>
                        <p>
                        <h5>Mob No : <?php echo ($fetch['phone']); ?></h5>
                        </p>
                        <p>
                        <h5>Email ID : <?php echo ($fetch['username']); ?></h5>
                        </p>
                        <p>
                            <button type="submit" name="book" >CONFIRM BOOKING</button>
                        </p>
                    </div>
                    <?php
                }
                ?>

            </form>

            <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <div class="icon-box">
                                            <i class="material-icons">&#xE876;</i>
                                    </div>				
                                    <h4 class="modal-title">Awesome!</h4>	
                            </div>
                            <div class="modal-body">
                                    <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
                            </div>
                            <div class="modal-footer">
                                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                            </div>
                    </div>
            </div>
            <!-- Button trigger modal -->
<!--            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="/playon/pro/userlogin.php?page=turf" type="button"  class="btn btn-primary">Book another</button>
                        </div>
                    </div>
                </div>
            </div>-->
        </section>
    </body>
</html>

<?php
if (isset($_POST['book'])) {

    $status = "Booked";



    $cons = connect();
    $ins = $cons->prepare("UPDATE `slot` SET `status`=?,`bookingid`=?, `name`=?, `phone`=? ,`email`=? ,`location`=? WHERE slotid = ?");
    $ins->bind_param("sissssi", $status, $userid, $name, $phone, $email, $ulocation, $slotid);
    $ins->execute();
    // echo "<h1> hello</h1>";
        echo '<script>  $(document).ready(function(){
           $("#myModal").modal("show");
      });
     </script>';
    echo '<script type="text/javascript">',
   'myscript();',
   '</script>';


    if ($ins->execute()) {


        $getinfo = "SELECT userid from register WHERE phone='$phone'";
        $row = mysqli_fetch_assoc(mysqli_query($cons, $getinfo));
        $userid = $row['userid'];
        $to = $email;
        $subject = 'Turf Booking Successful';
        $body = '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

@media screen and (max-width: 480px) {
    .mobile-hide {
        display: none !important;
    }
    .mobile-center {
        text-align: center !important;
    }
}
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">


<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
For what reason would it be advisable for me to think about business content? That might be little bit risky to have crew member like them. 
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td align="center" valign="top" style="font-size:0; padding: 20px;" bgcolor="#28a745">
               
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                <h4 style="font-size: 30px; font-weight: 800; margin: 0; color: white;">TURF BOOKING SYSTEM</h4>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 700; line-height: 48px;">
                                <table cellspacing="0" cellpadding="0" border="0" align="right">
                                    <tr>
                                        <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                            <p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a href="#" target="_blank" style="color: #ffffff; text-decoration: none;"></a></p>
                                        </td>
                                        
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
              
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                 Your booking is Confirmed!
                            </h2><br>
                            <h4>Booking ID : OTBS0'.$slotid.'
                        </td>
                    </tr>
                    <tr>
                      
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                            
                            <b>   '.$tname.'<br>
                                   
                                  '. date('h:i ', $starttimes).'-'.date('h:i A ', $closetimes).'<br>
                                '.date('d M Y', $dates).', '.$location.'<br></b>

                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        Booking
                                    </td>
                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                      Price
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        Slots (1)
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                      Rs.&nbsp;  '.$price.'.00
                                    </td>
                                </tr>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        Tax (5%)
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                      Rs.&nbsp;  '.$tprice.'.00
                                    </td>
                                </tr>
                               
                               
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        TOTAL
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                       Rs.&nbsp; '.$gprice.'.00
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                </td>
            </tr>
             <tr>
                <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0;">
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                   
                                </table>
                            </div>
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td align="center" style=" padding: 10px; background-color: #28a745;" bgcolor="#28a745">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
                               
                            </h2>
                        </td>
                    </tr>
                   
                </table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
    
</body>
</html>';
        include '../mailer.php';

         alert("Your Turf Booked Sucessfully!, Please check your Email for Confirmation");
         load($_SERVER['PHP_SELF'] . "?page=turf");
    }
}
?>