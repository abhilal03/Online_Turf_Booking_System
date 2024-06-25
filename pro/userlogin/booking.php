<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'booking';
$me = "?page=$source";
$userid = $_SESSION['userid'];
$turfid = $_GET['id'];
$turfname = $_GET['turfname'];
$date = getToday();
$date = date('m/d/Y', strtotime($date));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            /* Style the buttons */
            .bnn {
                border: none;
                outline: none;
                padding: 12px 40px;
                background-color: palegreen;
                cursor: pointer;
                font-size: 15px;
                text-align: center;
            }
            
            .rrr{
                margin-bottom: 20px;
                margin-left: 5px;
                margin-top: 5px;
                margin-right: 5px;
            }
            .fl-right {
                float: right
            }
            .nnn {
                border: white;
                outline: white;
                padding: 12px 40px;
                background-color: tomato;
                cursor: pointer;
                font-size: 15px;
                text-align: center;
            }
            .column                {
                column-count: 5;
                align-content: center;
            }


            /* Style the active class, and buttons on mouse-over */
            .active, .bnn:hover {
                background-color: green;
                color: white;
            }
            .ul_top_hypers li {
                display: inline;
            }
            h2 {
                text-transform: uppercase;
                font-weight: 600;
                border-left: 10px solid #fec500;
                padding-left: 10px;
                margin-bottom: 5px
            }
            h4 {
                align-content: center;
                font-weight: 400;
                border-left: 10px ;
                padding-left: 10px;
                margin-bottom: 5px
            }

        </style>
    </head>
    <body>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card-header alert-success">

                            <div class="col-md-12">

                                <form action="" method="POST" class="form-inline" >

                                    <h2> <?php echo $turfname ?></h2>

                                    <div class="col-sm-3"> 
               
                                        <input type="date" class="form-control" placeholder="DD/MM/YY" name="date" id="bookingdate"
                                               value="<?php
                                               echo isset($_POST['date']) ? $_POST['date'] : date('Y-m-d')
//                                   if (isset($_POST['date'])) {
//                                       echo $_POST['date'];
//                                   }
                                               ?>"> 
                                        <script>
                                            bookingdate.min = new Date().toISOString().split("T")[0];
                                        </script>
                                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>



        <section class="content">

            <div class="card-body">
                <div class="container-fluid">

                    <div class="row">

                        <?php
//        if (isset($_POST['submit'])) {

                        $turfid = $_GET['id'];
                        $date = isset($_POST['date']) ? $_POST['date'] : date('d-m-Y');
                        $date = date('d-m-Y', strtotime($date));
                        $row = $conn->query("SELECT * FROM slot WHERE turfid='$turfid' AND date='$date' ");
                        if ($row->num_rows < 1) {
                            ?>
                            <h4> <?php echo "No Slot Available"; ?>  </h4><?php
                        } else {
                           
                            while ($fetch = $row->fetch_assoc()) {

                                $id = $fetch['slotid'];
                                $turfid = $fetch['turfid'];
                                $turfname = $fetch['turfname'];
                                $starttime = $fetch['starttime'];
                                $closetime = $fetch['closetime'];
                                $starttimes = strtotime($starttime);
                                $closetimes = strtotime($closetime);
                                ?>
                            <div class=" col-md-2">
                                    <div id="myDIV">
                                        <div class="rrr">
                                            <?php
                                            if ($fetch['status'] == 'Available') {
                                                ?><a href="userlogin.php?page=summary&id=<?php echo $id; ?>&turfid=<?php echo $turfid; ?>">
                                                    <button class="bnn" onclick="" ><?php echo date('h:i A', $starttimes); ?></button></a>
                                            <?php } else { ?>
                                                <button class="nnn" ><?php echo date('h:i A', $starttimes); ?></button>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                                
                                  <?php             
                            }
                            ?>

                            <?php
                        }
//        }
                        ?>
                    </div>

                </div>




                <script>

                    // Add active class to the current button (highlight it)
                    var header = document.getElementById("myDIV");
                    var btns = header.getElementsByClassName("btn");
                    for (var i = 0; i < btns.length; i++) {
                        btns[i].addEventListener("click", function () {
                            var current = document.getElementsByClassName("active");
                            current[0].className = current[0].className.replace(" active", "");
                            this.className += " active";
                        });
                    }
                </script>
            </div>
        </section>

    </body>
</html>


