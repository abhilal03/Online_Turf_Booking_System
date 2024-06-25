<?php
if (!isset($file_access))
    die("Direct File Access Denied");
?>

<style>

    .card1 {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        width: 320px;
        height: 420px;

        text-align: center;
        font-family: arial;
        margin-bottom: 5px;
        margin-top: 5px;
        margin-right: 5px;
        margin-left: 5px;


    }
    .name{
        text-align: center;
        font-family: arial;
    }
    .count{
        column-count: 3;

    }
    .price {
        color: dimgrey;
        font-size: 22px;
    }

    .card1 button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: purple;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .card1 button:hover {
        opacity: 0.8;
    }

</style>


<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

        <!-- Content Header (Page header) -->
<div class="content">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                Search</h3>
                            <div class='float-right'>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#add">
                                    New Search
                                </button>
                            </div>
                        </div>
                        
                        <section class="content">

                                    <div class="card-body">
                                        <div class="container-fluid">

                                            <div class="row">
                            <?php
                            if (isset($_POST['submit'])) {
                                $search = $_POST['search'];
                                $conn = connect();
                                //Check if train exists
                                $check = $conn->query("SELECT * FROM turf WHERE location = '$search' OR turf_name= '$search'");
                                if ($check->num_rows != 1) {
                                    alert("Invalid Ticket Number Provided");
                                } else {
                                   
                                        $row = connect()->query("SELECT * FROM turf WHERE location = '$search' OR turf_name= '$search'");
                                                if ($row->num_rows < 1)
                                                    echo "No Records Yet";
                                                $i = 0;
                                                while ($fetch = $row->fetch_assoc()) {
                                                    $id = $fetch['turfid'];
                                                    $turfname = $fetch['turf_name'];
                                                    ?>

                                                    <div class=" col-md-4">
                                                        <div class="card1">
                                                            <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>" alt="Denim Jeans" style="width:320px; height: 220px;">

                                                            <h2><?php echo "<b>", $fetch['turf_name'] . '</b>' ?></h2>
                                                            <!--<h2><?php // echo "<b>" . $i++ . '</b>'      ?></h2>-->
                                                            <p><?php echo "<b>", $fetch['location'] . '</b>' ?></p>
                                                            <p class="price"><b>₹ </b><?php echo '<b>', $fetch['price'] . '</b>' ?></p>
                                                            <p> <a href="userlogin.php?page=turfdetails&id=<?php echo $id; ?>&turfname=<?php echo $turfname; ?>">
                                                                    <button>Book</button></a></p>
                                                        </div>

                                                    </div>


                                                    <?php
                                                }
                                               
                            }
                            }
                            
                           
                            ?>
                      
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    </body>
</html>  
                        
                        
                        
                        
                        
                        

                                <section class="content">

                                    <div class="card-body">
                                        <div class="container-fluid">

                                            <div class="row">


                                                <?php
                                                $row = connect()->query("SELECT * FROM turf  WHERE status=1 ORDER BY turfid DESC");
                                                if ($row->num_rows < 1)
                                                    echo "No Records Yet";
                                                $i = 0;
                                                while ($fetch = $row->fetch_assoc()) {
                                                    $id = $fetch['turfid'];
                                                    $turfname = $fetch['turf_name'];
                                                    ?>

                                                    <div class=" col-md-4">
                                                        <div class="card1">
                                                            <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>" alt="Denim Jeans" style="width:320px; height: 220px;">

                                                            <h2><?php echo "<b>", $fetch['turf_name'] . '</b>' ?></h2>
                                                            <!--<h2><?php // echo "<b>" . $i++ . '</b>'      ?></h2>-->
                                                            <p><?php echo "<b>", $fetch['location'] . '</b>' ?></p>
                                                            <p class="price"><b>₹ </b><?php echo '<b>', $fetch['price'] . '</b>' ?></p>
                                                            <p> <a href="userlogin.php?page=turfdetails&id=<?php echo $id; ?>&turfname=<?php echo $turfname; ?>">
                                                                    <button>Book</button></a></p>
                                                        </div>

                                                    </div>


                                                    <?php
                                                }
                                                ?>    

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    </body>
</html>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" align="center">
            <div class="modal-header">
                <h4 class="modal-title">Search Commuter With Ticket ID
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Enter Turf Name / Location</th>
                            <td><input type="text" class="form-control" name="search" required minlength="2" ></td>
                        </tr>
                        <td colspan="2">

                            <input class="btn btn-info" type="submit" value="Search" name='submit'>
                        </td>
                        </tr>
                    </table>
                </form>



            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>