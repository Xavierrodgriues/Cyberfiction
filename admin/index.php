<?php
require('inc/db_config.php');
require('inc/essentials.php');
session_start();

if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN PANEL</title>
    <?php require('inc/links.php'); ?>

    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded shadow bg-white overflow-hidden">
        <form method="post">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center" pattern="[A-Za-z]+" title="Only letters are allowed" placeholder="Admin Name" />
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password" />
                </div>
                <button name="login" type="submit" class="btn custom-bg text-white shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        
        // Validate username (only letters allowed)
        if (!preg_match("/^[A-Za-z]+$/", $frm_data['admin_name'])) {
            alert('error', 'Invalid username - only letters are allowed!');
        } else {
            // Validate password match
            $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
            $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
            $res = select($query, $values, "ss");

            if ($res->num_rows == 1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['sr_no'];
                redirect('dashboard.php');
            } else {
                alert('error', 'Login failed - invalid credentials!');
            }
        }
    }
    ?>

    <?php require('inc/script.php'); ?>
</body>

</html>
