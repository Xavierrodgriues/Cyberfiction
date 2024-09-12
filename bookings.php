<?php 
// Include necessary files and start the session
include('connection.php');

// if(session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

date_default_timezone_set("Asia/Calcutta");

// // Check if the user is logged in
// if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
//     redirect('index.php');
// }

// HTML header section
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <title><?php $settings_r['site_title'] ?>- BOOKINGS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">BOOKINGS</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">BOOKINGS</a>
                </div>
            </div>
            <?php
            $query = "SELECT bo.*, bd.*, 
                      bo.starter_name, bo.main_course_name, bo.sweet_dish_name
                      FROM `booking_order` bo
                      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                      WHERE ((bo.booking_status ='booked') 
                      OR (bo.booking_status='cancelled')
                      OR (bo.booking_status='failed'))
                      AND (bo.user_id =?) 
                      ORDER BY bo.booking_id DESC";

            $result = select($query, [$_SESSION['uId']], 'i');

            while ($data = mysqli_fetch_assoc($result)) {
                $date = date("d-m-Y", strtotime($data['datentime'])); 
                $checkin = date("d-m-Y", strtotime($data['check_in'])); 
                $checkout = date("d-m-Y", strtotime($data['check_out']));

                $status_bg = "";
                $btn = "";

                if ($data['booking_status'] == 'booked') {
                    $status_bg = 'bg-success';

                    if ($data['arrival'] == 1) {
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                        Download PDF
                        </a>";
                        if ($data['rate_review'] == 0) {
                            $btn .= "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm ms-2 shadow-none'>
                        Rate & Review
                        </button>
                        ";
                        }
                    } else {
                        $btn = "<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-danger btn-sm  shadow-none'>
                        CANCEL
                        </button>";
                    }
                } else if ($data['booking_status'] == 'cancelled') {
                    $status_bg = "bg-danger";
                    if ($data['refund'] == 0) {
                        $btn = "<span class='badge bg-primary'>Refund in process!</span>";
                    } else {
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                        Download PDF </a>";
                    }
                } else {
                    $status_bg = "bg-warning";
                    $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                        Download PDF
                        </a>
                        ";
                }

                // Create strings for food items
                $starter_string = !empty($data['starter_name']) ? "<b>Starter:</b> {$data['starter_name']}" : "";
                $main_course_string = !empty($data['main_course_name']) ? "<b>Main Course:</b> {$data['main_course_name']}" : "";
                $sweet_dish_string = !empty($data['sweet_dish_name']) ? "<b>Sweet Dish:</b> {$data['sweet_dish_name']}" : "";

                // Display the booking details along with food items
                echo <<<bookings
                <div class='col-md-4 px-6 mb-4 shadow-sm'>
                    <div class='bg-white p-3 rounded shadow-none'>
                    <h5 class='fw-bold'>$data[room_name]</h5>
                    <p>₹$data[price] per day</p>
                    <p>
                        <b>Check in: </b> $checkin  <br>
                        <b>Check out: </b> $checkout
                    </p>
                    <p>
                        <b>Amount: </b>₹$data[trans_amt]  <br>
                        <b>Order Id: </b> $data[order_id] <br>
                        <b>Date: </b> $date
                    </p>
                    <p>$starter_string</p>
                    <p>$main_course_string</p>
                    <p>$sweet_dish_string</p>
                    <p>
                        <span class='badge $status_bg'>
                            $data[booking_status]
                        </span>
                    </p>
                    $btn
                    </div>
                </div>
                bookings;
            }
            ?>
        </div>
    </div>

    <!-- Modal for Rating & Review -->
    <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="review-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i> Rate & Review
                        </h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select class="form-select shadow-none" name="rating">
                                <option value="5">Excellent</option>
                                <option value="4">Good</option>
                                <option value="3">Ok</option>
                                <option value="2">Bas</option>
                                <option value="1">Poor</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Review</label>
                            <textarea type="password" rows="3" class="form-control shadow-none" name="review" required /> </textarea>
                        </div>
                        <input type="hidden" name="booking_id">
                        <input type="hidden" name="room_id">
                        <div class="text-end">
                            <button type="submit" class="btn custom-bg text-white shadow-none">
                                SUBMIT
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Display success messages -->
    <?php
    if (isset($_GET['cancel_status'])) {
        alert('sucess', 'Booking Cancelled!');
    } else if (isset($_GET['review_status'])) {
        alert('sucess', 'Thank you for rating and review!');
    }
    ?>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>

    <!-- JavaScript code for canceling booking and submitting review -->
    <script>
        function cancel_booking(id) {
            if (confirm('Are you sure you want to cancel this booking?')) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/cancel_bookings.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.responseText == 1) {
                        window.location.href = "bookings.php?cancel_status=true";
                    } else {
                        alert('error', "Cancellation failed!");
                    }
                }
                xhr.send('cancel_booking&id=' + id);
            }
        }

        let review_form = document.getElementById('review-form');

        function review_room(bid, rid) {
            review_form.elements['booking_id'].value = bid;
            review_form.elements['room_id'].value = rid;
        }

        review_form.addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData();
            data.append('review_form', '');
            data.append('rating', review_form.elements['rating'].value);
            data.append('review', review_form.elements['review'].value);
            data.append('booking_id', review_form.elements['booking_id'].value);
            data.append('room_id', review_form.elements['room_id'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/review_room.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    console.log(this.responseText);
                    window.location.href = "bookings.php?review_status=true";
                } else {
                    var myModal = document.getElementById('reviewModal');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();
                    alert('error', "Rating and Review failed!");
                }
            }
            xhr.send(data);
        })
    </script>
</body>

</html>
