<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?>- FACILITIES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">
    <style>
        /* Your CSS styles here */
        .pop:hover {
            border-top-color: #2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3sec;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 0 -10px;
        }

        .menu {
            flex: 1;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 10px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .menu h2 {
            margin-top: 0;
        }

        .item {
            display: inline-block;
            margin-bottom: 5px;
            margin-right: 10px;
            vertical-align: middle;
            /* Align checkboxes vertically */
            margin-top: 3px;
            /* Adjust the margin-top as needed */
        }

        label {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        .total {
            text-align: center;
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        /* Optional: Hover effect */
        .menu:hover {
            border-top-color: #2ec1ac;
            transform: scale(1.03);
            transition: all 0.3s;
        }

        .container {
            margin-top: 4rem;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container">
        <div class="menu-container">
            <?php
            // Fetch starter items
            $starterQuery = "SELECT * FROM starter_item";
            $starterResult = mysqli_query($con, $starterQuery);

            // Display starter items
            if (mysqli_num_rows($starterResult) > 0) {
                echo '<div class="menu bg-white rounded shadow border-top border-4 border-dark pop">
                    <h2>Starter Items</h2>';
                while ($row = mysqli_fetch_assoc($starterResult)) {
                    echo '<label><input type="checkbox" class="item" name="starter[]" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label>';
                }
                echo '</div>';
            }

            // Fetch main course items
            $mainCourseQuery = "SELECT * FROM main_course_item";
            $mainCourseResult = mysqli_query($con, $mainCourseQuery);

            // Display main course items
            if (mysqli_num_rows($mainCourseResult) > 0) {
                echo '<div class="menu bg-white rounded shadow border-top border-4 border-dark pop">
                    <h2>Main Course Items</h2>';
                while ($row = mysqli_fetch_assoc($mainCourseResult)) {
                    echo '<label><input type="checkbox" class="item" name="main_course[]" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label>';
                }
                echo '</div>';
            }

            // Fetch sweet items
            $sweetQuery = "SELECT * FROM sweet_item";
            $sweetResult = mysqli_query($con, $sweetQuery);

            // Display sweet items
            if (mysqli_num_rows($sweetResult) > 0) {
                echo '<div class="menu bg-white rounded shadow border-top border-4 border-dark pop">
                    <h2>Sweet Items</h2>';
                while ($row = mysqli_fetch_assoc($sweetResult)) {
                    echo '<label><input type="checkbox" class="item" name="sweet_dish[]" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="total">
        No. of People: <input type="number" name="total_people" id="totalPeople" value="1"><br>
        Total Amount: ₹<span id="totalAmount"><?php echo $_SESSION['room']['payment']; ?></span>
    </div>
    <div class="text-center my-5">
        <button type="button" class="buynow btn btn-primary fs-5 fw-bold w-75">Next</button>
    </div>

    <?php require('inc/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            var hallAmount = <?php echo $_SESSION['room']['payment']; ?>;
            var foodAmount = 0;
            var totalPeople = 1; // default value for number of people

            // Initial display of total amount
            updateTotalAmount();

            // Event handlers for item and input changes
            $('.item').change(function() {
                updateTotalAmount();
            });

            $('#totalPeople').change(function() {
                totalPeople = parseInt($(this).val()) || 1; // Use 1 if no valid number is entered
                updateTotalAmount();
            });

            // Razorpay integration
            $(".buynow").click(function(e) {
                var productid = 1312;
                var productname = "sdsd";

                // Extract selected food items
                var selectedStarter = $("input[name='starter[]']:checked").map(function() {
                    return $(this).val();
                }).get();

                var selectedMainCourse = $("input[name='main_course[]']:checked").map(function() {
                    return $(this).val();
                }).get();

                var selectedSweetDish = $("input[name='sweet_dish[]']:checked").map(function() {
                    return $(this).val();
                }).get();

                var totalAmount = hallAmount + (foodAmount * totalPeople);

                var options = {
                    "key": "rzp_test_5uogv0tNZPtSNY",
                    "amount": totalAmount * 100,
                    "name": "iFoodMate:)",
                    "description": productname,
                    "image": "",
                    "handler": function(response) {
                        var paymentid = response.razorpay_payment_id;

                        $.ajax({
                            url: "payment-process.php",
                            type: "POST",
                            data: {
                                product_id: productid,
                                payment_id: paymentid,
                                totalAmount: totalAmount,
                                selectedStarter: selectedStarter,
                                selectedMainCourse: selectedMainCourse,
                                selectedSweetDish: selectedSweetDish,
                                totalPeople: totalPeople
                            },
                            success: function(finalresponse) {
                                if (finalresponse == 'done') {
                                    window.location.href = "http://localhost/hbwebsite/success.php";
                                } else {
                                    alert('Payment processing failed. Please try again later.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('An error occurred while processing your payment. Please try again later.');
                            }
                        });

                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();
            });

            // Function to update total amount
            function updateTotalAmount() {
                foodAmount = 0;
                $('.item:checked').each(function() {
                    var price = parseFloat($(this).val().split('₹')[1]) || 0; // Use 0 if no valid price is found
                    foodAmount += price;
                });
                var totalAmount = hallAmount + (foodAmount * totalPeople);
                $('#totalAmount').text(totalAmount.toFixed(2));
            }
        });
    </script>
</body>

</html>