<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <title><?php $settings_r['site_title'] ?>- FACILITIES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">
    <style>
        .pop:hover {
            border-top-color: #2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3sec;
        }

        .menu-container {
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Distribute items with equal space between them */
            flex-wrap: wrap;
            /* Allow items to wrap to the next line */
            margin: 0 -10px;
            /* Add some negative margin to counteract padding */
        }

        .menu {
            flex: 0 0 calc(33.33% - 20px);
            /* Each menu item takes 1/3 of the container width with space between them */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 10px;
            /* Add some margin between items */
            margin-bottom: 20px;
            /* Add space at the bottom of each item */
            box-sizing: border-box;
            /* Include padding in the width calculation */
        }

        .menu h2 {
            margin-top: 0;
            /* Remove top margin for h2 */
        }

        .item {
            display: block;
            margin-bottom: 10px;
            /* Add some space between items */
        }

        /* Optional: Hover effect */
        .menu:hover {
            border-top-color: #2ec1ac;
            transform: scale(1.03);
            transition: all 0.3s;
        }

        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            .menu {
                flex-basis: calc(50% - 20px);
                /* Two items per row on smaller screens */
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR Menu</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Explore Tasty Choices: Check Out Our Menu for Delicious
            Meals with Simple Flavors, Perfect for<br> Your Enjoyment and Special Occasions.</p>
    </div>

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
                    echo '<label class="item" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label><br>';
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
                    echo '<label class="item" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label><br>';
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
                    echo '<label class="item" value="' . $row['name'] . ' - ₹' . $row['price'] . '"> ' . $row['name'] . ' - ₹' . $row['price'] . '</label><br>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>


</body>

</html>