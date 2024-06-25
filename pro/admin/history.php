<?php
if (!isset($file_access))
    die("Direct File Access Denied");
$source = 'history';
$me = "?page=$source";
$userid = $_SESSION['userid'];
$turfid = $_GET['id'];
?>
<html>
    <head>
        <style>
            td {
                text-align: center;
            }
             th {
                text-align: center;
            }
            h3 {
               text-transform: uppercase;
               font-weight: 600;
               border-left: 10px solid #fec500;
               padding-left: 10px;
               margin-bottom: 0px;
               margin-top: 0px;
               }

        </style>
    </head>
    <body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="modal-body">
                    <div class="card">
                        <div class="card-header alert-success">
                            <h3>Booking History</h3>
                        </div>
                   
                    <div class="modal-body">

                        <div class="card-body">

                            <table id="example1" style="align-items: stretch;" 
                                   class="table table-hover w-100  table-striped<?php //           ?>">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Turf </th>
                                        <th>Date & Time </th>

                                        <th>Booked person</th>
                                   
                                        <th>Status</th></h3>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row = $conn->query("SELECT * FROM slot WHERE status='Booked'AND turfid='$turfid' ORDER BY slotid DESC ");

                                    if ($row->num_rows < 1)
                                        echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {

                                        $id = $fetch['slotid'];
                                       
                                        ?><tr>
                                            <td><?php echo ++$sn; ?></td>
                                             <td><?php echo ($fetch['turfname']); ?></td>
                                              <td><?php echo  $fetch['date'], "<br>",$fetch['starttime'],"-" ,$fetch['closetime']; ?></td>


                                            
                                            <td> <?php echo $fetch['name'], "<br>",$fetch['phone']; ?></td>


                                            <td>
                                                <?php
                                                if ($fetch['status'] == 'Available') {
                                                    ?>
                                                        <button
                                                           
                                                            type="submit" class="btn btn-success">
                                                            Available
                                                        </button></a>
                                                <?php } else { ?>
                                                    <a href="">
                                                        <button
                                                            type="submit" class="btn btn-danger">
                                                            Booked
                                                        </button></a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>



                                </tbody>



                            </table>

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







