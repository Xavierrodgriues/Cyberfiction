    <?php
    session_start();
    require('manager/inc/db_config.php');

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php $settings_r['site_title'] ?>- FACILITIES</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="css/common.css">


        <style>
            body,
            html {
                height: 100%;
                margin: 0;
                font-family: Arial, sans-serif;
            }

            .container {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                height: 100%;
            }

            .menu {
                border: 1px solid #ccc;
                padding: 20px;
                margin: 10px;
                width: 300px;
            }

            .total {
                margin-top: 20px;
                font-weight: bold;
            }

            h2 {
                background-color: #2ec1ac;
            }
        </style>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" /> -->

    </head>

    <body>

        <form action="pay_now.php" method="post">


            <div class="container">
                <?php
                // Database con
                // require('inc/db_config.php');

                // Fetch starter items
                $starterQuery = "SELECT * FROM starter_item";
                $starterResult = mysqli_query($con, $starterQuery);

                // Display starter items
                if (mysqli_num_rows($starterResult) > 0) {
                    echo '<div class="menu">
                        <h2>Starter Items</h2>';
                    while ($row = mysqli_fetch_assoc($starterResult)) {
                        echo '<label><input type="checkbox" class="item" value="' . $row['name'] . ' - $' . $row['price'] . '"> ' . $row['name'] . ' - $' . $row['price'] . '</label><br>';
                    }
                    echo '</div>';
                }

                // Fetch main course items
                $mainCourseQuery = "SELECT * FROM main_course_item";
                $mainCourseResult = mysqli_query($con, $mainCourseQuery);

                // Display main course items
                if (mysqli_num_rows($mainCourseResult) > 0) {
                    echo '<div class="menu">
                        <h2>Main Course Items</h2>';
                    while ($row = mysqli_fetch_assoc($mainCourseResult)) {
                        echo '<label><input type="checkbox" class="item" value="' . $row['name'] . ' - $' . $row['price'] . '"> ' . $row['name'] . ' - $' . $row['price'] . '</label><br>';
                    }
                    echo '</div>';
                }

                // Fetch sweet items
                $sweetQuery = "SELECT * FROM sweet_item";
                $sweetResult = mysqli_query($con, $sweetQuery);

                // Display sweet items
                if (mysqli_num_rows($sweetResult) > 0) {
                    echo '<div class="menu bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <h2>Sweet Items</h2>';
                    while ($row = mysqli_fetch_assoc($sweetResult)) {
                        echo '<label><input type="checkbox" class="item" value="' . $row['name'] . ' - $' . $row['price'] . '"> ' . $row['name'] . ' - $' . $row['price'] . '</label><br>';
                    }
                    echo '</div>';
                }

                // Close database con
                mysqli_close($con);
                ?>
                <input type="hidden" name="total_amount" id="totalAmountInput" value="<?php echo $_SESSION['room']['payment']; ?>">

                <div class="total">Total Amount: $<span id="totalAmount"><?php echo $_SESSION['room']['payment']; ?></span></div>
                <div class="text-center my-5">
                    <button type="submit" class="btn btn-primary fs-5 fw-bold w-75">Next</button>
                </div>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var checkboxes = document.querySelectorAll('.item');
                var totalAmount = document.getElementById('totalAmount');
                var totalAmountInput = document.getElementById('totalAmountInput');
                var currentTotal = <?php echo $_SESSION['room']['payment']; ?>;

                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        var price = parseFloat(checkbox.value.split('$')[1]);

                        if (checkbox.checked) {
                            currentTotal += price;
                        } else {
                            currentTotal -= price;
                        }

                        totalAmount.textContent = currentTotal.toFixed(2);
                        totalAmountInput.value = currentTotal.toFixed(2); // Update the hidden input field
                    });
                });
            });
        </script>

    </body>

    </html>