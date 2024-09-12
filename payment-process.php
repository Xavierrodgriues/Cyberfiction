<?php 
include('connection.php');
session_start();
date_default_timezone_set("Asia/Calcutta");

$paymentid = $_POST['payment_id'];
$productid = $_POST['product_id'];
$uId = $_SESSION['uId'];
$roomid = $_SESSION['room']['id'];
$phonenum = $_SESSION['phonenum'];
$totalAmount = $_POST['totalAmount'];
$checkin = $_SESSION['checkin']->format('Y-m-d');
$checkout = $_SESSION['checkout']->format('Y-m-d');
$randomNumber = mt_rand(11111, 9999999);
$orderId = "ORD" . $_SESSION['uId'] . $randomNumber;

// Extract selected food items
$selectedStarter = isset($_POST['selectedStarter']) ? $_POST['selectedStarter'] : [];
$selectedMainCourse = isset($_POST['selectedMainCourse']) ? $_POST['selectedMainCourse'] : [];
$selectedSweetDish = isset($_POST['selectedSweetDish']) ? $_POST['selectedSweetDish'] : [];

// Convert arrays to comma-separated strings
$starterNames = implode(', ', $selectedStarter);
$mainCourseNames = implode(', ', $selectedMainCourse);
$sweetDishNames = implode(', ', $selectedSweetDish);

// Insert booking details along with selected food items
$query1 = "INSERT INTO `booking_order` (`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `starter_name`, `main_course_name`, `sweet_dish_name`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_mesg`, `booking_status`) 
           VALUES ('$uId', '$roomid', '$checkin', '$checkout', '$orderId', '$starterNames', '$mainCourseNames', '$sweetDishNames', '$paymentid', '$totalAmount', 'success', 'Payment Successful', 'booked')";

$result1 = mysqli_query($conn, $query1);

if ($result1) {
    $booking_id = mysqli_insert_id($conn);
    $room_name = $_SESSION['room']['name'];
    $room_price = $_SESSION['room']['price'];
    $user_name = $_SESSION['name'];
    $address = $_SESSION['address']; 

    $query2 = "INSERT INTO `booking_details` (`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) 
               VALUES ('$booking_id', '$room_name', '$room_price', '$totalAmount', '$user_name', '$phonenum', '$address')";
    $result2 = mysqli_query($conn, $query2);

    if ($result2) {
        $_SESSION['paymentid'] = $paymentid;
        echo "done";
    } else {
        echo "Error inserting booking details: " . mysqli_error($conn);
    }
} else {
    echo "Error inserting booking order: " . mysqli_error($conn);
}
?>
