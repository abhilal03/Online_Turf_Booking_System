<?php
if (!isset($file_access))
die("Direct File Access Denied");
$source = 'history';
$me = "?page=$source";
$userid = $_SESSION['userid'];
?>


<!DOCTYPE html>
<html>
<head>
<style>

* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box
}

body {
    background-color: #dadde6;
    font-family: arial
}

.fl-left {
    float: left
}

.fl-right {
    float: right
}

h2 {
    text-transform: uppercase;
    font-weight: 600;
    border-left: 10px solid #fec500;
    padding-left: 10px;
    margin-bottom: 5px
}

.row {
    overflow: hidden
}

.card {
    display: table-row;
    width: 950px;
    height: 142px;
    background-color: #fff;
    color: #444444;
    margin-bottom: 1px;
    margin-top: 1px;
    margin-right: 1px;
    margin-left: 1px;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    position: relative
}

.card+.card {
    margin-left: 10;
}

.date {
    display: table-cell;
    width: 100px;
    position: relative;
    text-align: center;
    border-right: 2px dashed #dadde6
}

.date:before,
.date:after {
    content: "";
    display: block;
    width: 30px;
    height: 30px;
    background-color: #DADDE6;
    position: absolute;
    top: -15px;
    right: -15px;
    z-index: 1;
    border-radius: 50%
}

.date:after {
    top: auto;
    bottom: -15px
}

.date time {
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}

.date time span {
    display: block
}

.date time span:first-child {
    color: #2b2b2b;
    font-weight: 600;
    font-size: 250%
}

.date time span:last-child {
    text-transform: uppercase;
    font-weight: 600;
    margin-top: -10px
}

.card-cont {
    display: table-cell;
    width: 75%;
    font-size: 85%;
    padding: 10px 10px 28px 70px
}

.card-cont h3 {
    color: #3C3C3C;
    font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3 {
    text-decoration: line-through
}

.card-cont>div {
    display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p {
    display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i {
    padding: 5% 5% 0 0
}

.card-cont .even-info p {
    padding: 30px 50px 0 0
}

.card-cont .even-date time span {
    display: block
}

.card-cont a {
    display: block;
    text-decoration: none;
    width: 80px;
    height: 30px;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 10px
}

.row:last-child .card:first-child .card-cont a {
    background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a {
    background-color: #F8504C
}

@media screen and (max-width: 860px) {
    .card {
        display: block;
        float: none;
        width: 100%;
        margin-bottom: 10px
    }
    .card+.card {
        margin-left: 0;
    }
    .card-cont .even-date,
    .card-cont .even-info {
        font-size: 75%
    }
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
                        <h2>Booking History</h2>
                    </div>
                






                    <?php
                    $row = $conn->query("SELECT * FROM slot WHERE status='Booked'AND bookingid='$userid'ORDER BY slotid DESC");

                    if ($row->num_rows < 1)
                        echo "No Records Yet";
                    $sn = 0;
                    while ($fetch = $row->fetch_assoc()) {

                        $id = $fetch['slotid'];
                        $date = $fetch['date'];
                        $starttime = $fetch['starttime'];
                        $closetime = $fetch['closetime'];
                        $input = $fetch['date'];
                        $dates = strtotime($input);
                        $starttimes = strtotime($starttime);
                        $closetimes = strtotime($closetime);
                        ?>




                        <div class="modal-body">
                            <div class="card-body">

                                <section class="container">
                                    <h1></h1>
                                    <div class="row">
                                        <article class="card fl-left">
                                            <section class="date">
                                                <time datetime="date">
                                                    <span><?php echo date('d', $dates); ?></span><span><?php echo date('M', $dates); ?></span><br>
                                                    
                                                </time>
                                            </section>
                                            <section class="card-cont">
                                                <h2> <small><?php echo ($fetch['turfname']); ?></small></h2><br>

                                                <div class="even-date">
                                                    &nbsp; &nbsp; <i class="fa fa-calendar"></i>
                                                    <time>
                                                        <span> &nbsp;<?php echo date(' d M Y', $dates); ?></span>
                                                        <span>&nbsp;<?php echo date('h:i ', $starttimes); ?> to <?php echo date('h:i A', $closetimes); ?></span>
                                                        
                                                    </time>
                                                </div>
                                                 <a href="#">Booked</a>
                                             <?php
                                         // if ($fetch['invoice'] == 'Available') {
                                                ?>
<!--                                                <a href="userlogin.php?page=invoice&id=////<?php //echo $id; ?>">
                                                    <button
                                                        
                                                        type="submit" class="btn btn-dark">
                                                         <i class="fas fa-print"></i>Invoice
                                                    </button></a>-->
                                            <?php// } else { ?>
<!--                                                <a href="">
                                                    <button
                                                        onclick="return confirm('This slot is already booked')"
                                                        type="submit" class="btn btn-danger">
                                                        Booked
                                                    </button></a>-->
                                            <?php //} ?>
                                               
                                            </section>
                                        </article>

                                </section>
                                </body>
                                </html>
                            </div>
                        </div>
                            
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

