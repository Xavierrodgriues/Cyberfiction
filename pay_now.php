<?php
require('./manager/inc/db_config.php');
require('./manager/inc/essentials.php');

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require('./Payment/config.php');
require('./Payment/razorpay-php/Razorpay.php');
session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
// $price = $_POST['price'];
// $_SESSION['price'] = $price;
// $customername = $_POST['customername'];
// $email = $_POST['email'];
// $_SESSION['email'] = $email;
// $contactno = $_POST['contactno'];
// $frm_data = $_POST;
$customername = $_SESSION['name'];
$_SESSION['name'] = $customername;
$contactno = $_SESSION['phonenum'];
$_SESSION['phonenum'] = $contactno;
$_SESSION['address'] = $_SESSION['address'];
// $customername = $frm_data['email'];
$price = $_SESSION['room']['payment'];
// $totalFoodAmount =  $_SESSION['totalAmount'];
// $_SESSION['totalAmount'] = $totalFoodAmount;
$totalAmount = $_POST['total_amount'];
$_SESSION['totalAmount'] = $totalAmount;
$orderData = [
    'receipt'         => 3456,
    'amount'          => $totalAmount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Airlift",
    "description"       => "Fly High Fly Safe",
    "image"             => "",
    "prefill"           => [
    "name"              => $customername,
    "email"             => $_SESSION['uemail'],
    "contact"           => $contactno,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "17102003",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
$checkin = $_SESSION['checkin']->format('Y-m-d');
    $checkout = $_SESSION['checkout']->format('Y-m-d');
$query = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) VALUES (?,?,?,?,?)";
insert($query,[$_SESSION['uId'],$_SESSION['room']['id'],$checkin,$checkout,$data['order_id']],'issss');

$booking_id = mysqli_insert_id($con);
$query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,`user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],$totalAmount,$_SESSION['uName'],$_SESSION['uPhone'],$_SESSION['address']],'issssss');
?>


<form action="Payment/verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="3456">
</form>