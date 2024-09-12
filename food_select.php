<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <!-- <title><?php $settings_r['site_title'] ?>- FACILITIES</title> -->
    <title><?php echo $settings_r['site_title']; ?> - FACILITIES</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">
    <style>
        .pop:hover {
            border-top-color: #2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3sec;
        }

        #totalAmountBox {
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">What would you like to have?</h2>
    </div>

    <form action="pay_now.php" method="post" id="foodForm">
        <div class="container">
            <div class="row">
                <?php
                $res = selectAll('menu');
                $path = FACILITIES_IMG_PATH;
                while ($row = mysqli_fetch_assoc($res)) {
                    echo <<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                            <div class="d-flex align-items-center mb-2">
                                <img src="$path$row[icon]" width="80px" alt="">
                                <h5 class="m-0 ms-3">$row[name]</h5>
                            </div>
                            <p>$row[description]</p>
                            <p><b>₹$row[price]</b></p>
                            <label>
                                <input type="checkbox" name="food_packages[]" value="$row[price]" class="food-checkbox">
                                Select
                            </label>
                        </div>
                    </div>
                data;
                }
                ?>
            </div>
        </div>

        <div id="totalAmountBox" class="text-center my-5">
            Total Amount: ₹<span id="totalAmount"><?php echo $_SESSION['transfer_payment']; ?></span>
        </div>
        <input type="hidden" name="totalAmount" id="hiddenTotalAmount" value="<?php echo $_SESSION['transfer_payment']; ?>">

        <div class="text-center my-5">
            <button type="submit" class="btn btn-primary fs-5 fw-bold w-75">Pay Now</button>
        </div>
    </form>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkboxes = document.querySelectorAll('.food-checkbox');
            var totalAmountBox = document.getElementById('totalAmount');
            var foodForm = document.getElementById('foodForm');

            function updateTotalAmount() {
                var totalAmount = parseFloat(totalAmountBox.innerText);
                checkboxes.forEach(function (checkbox) {
                    if (checkbox.checked) {
                        totalAmount += parseFloat(checkbox.value);
                    }
                });
                totalAmountBox.innerText = totalAmount.toFixed(2);
            }

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateTotalAmount();
                });
            });

            foodForm.addEventListener('submit', function () {
                // You can now access the total amount in JavaScript before submitting the form
                var finalTotalAmount = parseFloat(totalAmountBox.innerText);
                console.log('Total Amount:', finalTotalAmount);
            });

            // Initialize total amount on page load
            updateTotalAmount();
        });
    </script> -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.food-checkbox');
        var totalAmountBox = document.getElementById('totalAmount');
        var hiddenTotalAmountInput = document.getElementById('hiddenTotalAmount');
        var foodForm = document.getElementById('foodForm');

        function updateTotalAmount() {
            var totalAmount = parseFloat(hiddenTotalAmountInput.value);
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    totalAmount += parseFloat(checkbox.value);
                }
            });
            hiddenTotalAmountInput.value = totalAmount.toFixed(2);
            totalAmountBox.innerText = totalAmount.toFixed(2);
        }

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateTotalAmount();
            });
        });

        foodForm.addEventListener('submit', function (event) {
    // Prevent the form from submitting immediately
    event.preventDefault();

    // You can now access the total amount in JavaScript before submitting the form
    var finalTotalAmount = parseFloat(hiddenTotalAmountInput.value);

    // Use Ajax to send the total amount to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_total_amount.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Log the response from the server
            console.log(xhr.responseText);
            // Now you can submit the form
            foodForm.submit();
        }
    };
    // Send the total amount to the server
    xhr.send('totalAmount=' + encodeURIComponent(finalTotalAmount));
});


        // Initialize total amount on page load
        updateTotalAmount();
    });
</script>

</body>

</html>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Access customer name, phone number, and address
    $customerName = isset($_POST['name']) ? $_POST['name'] : '';
    $phoneNumber = isset($_POST['phonenum']) ? $_POST['phonenum'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // Now you can use $customerName, $phoneNumber, and $address in your further processing
    // ...

    // For example, you can store them in the session for later use
    $_SESSION['customer_info'] = [
        'name' => $customerName,
        'phonenum' => $phoneNumber,
        'address' => $address,
    ];
}
?>
