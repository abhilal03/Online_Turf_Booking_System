 <?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'invoice';
$me = "?page=$source";
$slotid = $_GET['id'];
$date = getToday();
$date = date('d/m/Y', strtotime($date));
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  
</head>
 <?php
                   

                    $con = connect()->query("SELECT * FROM slot WHERE slotid='$slotid'");
                    while ($fetch = $con->fetch_assoc()) {
                        $turfid = $fetch['turfid'];
                        $starttime = $fetch['starttime'];
                        $closetime = $fetch['closetime'];
                        $userid  = $fetch['bookingid'];
                        $starttimes = strtotime($starttime);
                        $closetimes = strtotime($closetime);
                        $input = $fetch['date'];
                        $dates = strtotime($input);
                         $uemail = $fetch['email'];
                        
                        $uphone = $fetch['phone'];
                        $name = $fetch['name'];
                        $ulocation = $fetch['location'];
                         }
                        ?>
<?php
                    $conn = connect()->query("SELECT * FROM turf WHERE turfid='$turfid'");
                    while ($fetch = $conn->fetch_assoc()) {
                        $turfid = $fetch['turfid'];
                        $phone = $fetch['phone'];
                        $location = $fetch['location'];
                        $tname = $fetch['turf_name'];
                        $price = $fetch['price'];
                        $tprice =($price*5)/100;
                        $gprice= $price+$tprice;
                        
                    }
                        ?>
 
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?php echo $tname; ?>
                    <small class="float-right">Date: <?php echo $date; ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?php echo $tname; ?></strong><br>
                    <?php echo $location; ?><br>
                    
                    Phone: <?php echo $phone; ?><br>
                    Email: <?php echo $email; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $name; ?></strong><br>
                   
                    <?php echo $ulocation; ?><br>
                    Phone: <?php echo $uphone; ?><br>
                    Email: <?php echo $uemail; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 <br> <b>Invoice #<?php echo $slotid; ?></b><br>
                 
                  <b>Booking ID:</b> OTBS0<?php echo $slotid; ?><br>
                 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Time</th>
                     <th>Date</th>
                      <th>No. of Slot</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td><?php echo date('h:i ', $starttimes); ?> - <?php echo date('h:i A', $closetimes); ?></td>
                      <td> <?php echo date('d M Y', $dates); ?></td>
                      <td>1</td>
                      <td><?php echo $price; ?>₹</td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <br> <br>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/american-express.png" alt="American Express">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>₹<?php echo $price; ?>.00</td>
                      </tr>
                      <tr>
                        <th>Tax (5%)</th>
                        <td>₹<?php echo $tprice; ?>.00</td>
                      </tr>
                      <tr>
                        <th>others</th>
                        <td>₹0.00</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>₹<?php echo $gprice; ?>.00</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <button type="button" onclick="window.print()" class="btn btn-success float-right"><i class="fas fa-print"></i> Print
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
         <!-- /.col -->
        <!-- /.row -->
</div>
    
</body>
</html>
