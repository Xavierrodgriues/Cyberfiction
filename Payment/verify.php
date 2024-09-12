<?php
require('../manager/inc/db_config.php');
require('../manager/inc/essentials.php');
require('config.php');
session_start();
function regenrate_session($uid)
{
    $user_q = select("SELECT * FROM  `user_cred` WHERE `id` =? LIMIT 1", [$uid], 'i');
    $user_fetch  = mysqli_fetch_assoc($user_q);

    $_SESSION['login'] = true;
    $_SESSION['uId'] = $user_fetch['id'];
    $_SESSION['uName'] = $user_fetch['name'];
    $_SESSION['uPic'] = $user_fetch['profile'];
    $_SESSION['uPhone'] = $user_fetch['phonenum'];
}
//db connection
$conn = mysqli_connect($host, $username, $password, $dbname);

require('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $email = $_SESSION['uemail'];
    $price = $_SESSION['room']['payment'];
    

    // $sql = "INSERT INTO `orders` (`order_id`, `razorpay_payment_id`, `status`, `email`, `price`) VALUES ('$razorpay_order_id', '$razorpay_payment_id', 'success', '$email', '$price')";

    // Insert data
    $slct_query = "SELECT `booking_id`, `user_id` FROM `booking_order` WHERE `order_id`='$razorpay_order_id'";
    $slct_res = mysqli_query($con, $slct_query);


    if (mysqli_num_rows($slct_res) == 0) {
        // echo "payment details inserted to db";
        redirect('index.php');
    }
    $slct_fetch = mysqli_fetch_assoc($slct_res);
 
    // if the session destriyed unintentionally then do this
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        //regenerate session
        regenrate_session($slct_fetch['user_id']);
    }
                                                                                                            //trans_amt = $price tha idhar
    $upd_query = "UPDATE `booking_order` SET `booking_status`='booked', `trans_id`='$razorpay_payment_id', `trans_amt`='$_SESSION[totalAmount]', `trans_status`='success', `trans_resp_mesg`='Payment Successful' WHERE `booking_id`='$slct_fetch[booking_id]'";
    mysqli_query($con, $upd_query);
    

    // $html = "<p>Your payment was successful</p>
    //          <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";

    redirect('../pay_status.php?order='.$razorpay_order_id);

} else {
    $upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',`trans_id`='$razorpay_payment_id',`trans_amt`='$_POST[amount]',`trans_status`='$error',`trans_resp_mesg`='Payment Unsuccessfull WHERE `booking_id`='$slct_fetch[booking_id]'";
    mysqli_query($con, $upd_query);

    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

// echo $html;
