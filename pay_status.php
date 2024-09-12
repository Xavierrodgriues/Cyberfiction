<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <title><?php $settings_r['site_title'] ?> BOOKING STATUS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">

</head>

<body class="bg-light">
    <?php require('inc/header.php');
    // define('ROOMS_IMG_PATH', SITE_URL . 'images/rooms/');
    // session_start();
    ?>
    
    <?php
    /*
    Check room id from url is present or not
    Shut down mode is active or not
    user is logged in or not
    */
    // if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    //     redirect('index.php');
    // }

    // // filter and get room and user data
    // $data = filteration($_GET);
    // $room_res = select("SELECT * FROM `rooms` where `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    // if (mysqli_num_rows($room_res) == 0) {
    //     redirect('rooms.php');
    // }
    // $room_data = mysqli_fetch_assoc($room_res);

    // $_SESSION['room'] = [
    //     "id" => $room_data['id'],
    //     "name" => $room_data['name'],
    //     "price" => $room_data['price'],
    //     "payment" => null,
    //     "available" => false
    // ];

    // $user_res =  select(
    //     "SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1",
    //     [$_SESSION['uId']],
    //     'i'
    // );
    // $user_data = mysqli_fetch_assoc($user_res);
    // $_SESSION['uemail'] = $user_data['email'];
    // ?>


    <div class="container">
        <div class="row">
            <div class="col-12 my-5 MB-3 px-4">
                <h2 class="fw-bold">PAYMENT STATUS</h2>
            </div>
            <?php
            $frm_data = filteration($_GET);
            // if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            //     redirect('index.php');
            // }

            $booking_q = "SELECT bo.*,bd.* FROM `booking_order` bo 
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                WHERE bo.order_id=? AND bo.user_id=? AND bo.booking_status!=?";

            $booking_res = select($booking_q,[$frm_data['order'],$_SESSION['uId'],'pending'],'sis');

            // if(mysqli_num_rows($booking_res)==0){
            //     redirect('index.php');
            // }

            $booking_fetch = mysqli_fetch_assoc($booking_res);

            if($booking_fetch['trans_status']=='success'){
                echo<<<data
                <div class="col-12 px-4">
                 <p class="fw-bold alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    Payment done! Booking successfull.
                    <br><br>
                    <a href="bookings.php">Go to Bookings</a>
                 </p>
                </div>
                data;
            }else{
                echo<<<data
                <div class="col-12 px-4">
                 <p class="fw-bold alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Payment Failed. $booking_fetch[trans_resp_mesg]
                    <br><br>
                    <a href="bookings.php">Go to Bookings</a>
                 </p>
                </div>
                data;
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>

</body>

</html>