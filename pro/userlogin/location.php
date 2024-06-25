<?php
include 'paid.php';
if (!isset($file_access)) die("Direct File Access Denied");
?>
<?php

if (isset($_GET['now'])) {
    echo "<script>alert('Your payment was successful');window.location='userlogin.php?page=location';</script>";
    exit;
}
                if (isset($_POST['submit'])) {
                            $location = $_POST['location'];
                            $cons = connect()->query("SELECT * FROM turf WHERE location='$location'");
                           


                            if (!isset($location)) {
                                alert("Fill Form Properly!");
                            } else {
                                ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
               


                <div class="card">
                    <div class="card-header alert-success">
                        <h5 class="m-0"> </h5>
                   
                     <div class='float-right'>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal">
                                     Your Location
                                </button>
                            </div>
                    </div>
                    <div class="card-body">
                        <table class="" id='example1'>
                          
                          
                            
                            <?php
                                    $row = connect()->query("SELECT * FROM turf  WHERE location='$location'");
                                    if ($row->num_rows < 1)
                                        echo "No Records Yet";
                                    $sn = 0;
                                    while ($fetch = $row->fetch_assoc()) {
                                        $id = $fetch['turfid'];
                                        ?>
                            <tr valign="middle" style="border-spacing:22">
                                            <td width="400" style="text-align: center; vertical-align: middle;">
                                            
                                                <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>"
                                                     class="img img-rounded" width="400" height="280" /> </td>
                                            <td width="300" style="text-align: center; vertical-align: middle;" <?php echo "<b>",$fetch['turf_name'] ,"</b>","<br><br>",$fetch['location'],"<br><br>Price : ",$fetch['price']," Rs" ?>
                                          
                            
                                            </td>
                                            <td width="300" style="text-align: center; vertical-align: middle;"> <form method="POST">
                                                    <button type="button" class="btn btn-primary" align="center" data-toggle="modal"
                                                            data-target="#edit<?php echo $id ?>">
                                                           Book   
                                                    </button>  
                                                </form>
                                            </tr>
                                        
                                        
                     
                      
                    
                    
                
            
                    
   
     <?php 
                                    
                                    }
                            }
                        }
                        
                                    
           ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









 <tr valign="middle" style="border-spacing:22">
                                    <td width="400" style="text-align: center; vertical-align: middle;">

                                        <img src="<?php echo "uploads/" . ($fetch['turf_image']); ?>"
                                             class="img img-rounded" width="400" height="280" /> </td>
                                    <td width="300" style="text-align: center; vertical-align: middle;" <?php echo "<b>", $fetch['turf_name'], "</b>", "<br><br>", $fetch['location'], "<br><br>Price : ", $fetch['price'], " Rs" ?>


                                </td>
                                <td width="300" style="text-align: center; vertical-align: middle;"> <form method="POST">
                                        <button type="button" class="btn btn-primary" align="center" data-toggle="modal"
                                                data-target="#edit<?php echo $id ?>">
                                            Book   
                                        </button>  
                                    </form>
                            </tr>