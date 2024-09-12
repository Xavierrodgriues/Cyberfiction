<?php require('inc/db_config.php');
session_start();
if((isset($_SESSION['managerLogin']) && $_SESSION['managerLogin']==true)){
    redirect('dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Venue Manager LOGIN PANEL</title>
    <?php require('inc/links.php'); ?>
    <?php require('inc/essentials.php'); ?>
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
            <h4 class="bg-dark text-white py-3">Venue Manager LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="manager_name" required type="text" pattern="[A-Za-z]+" title="Only letters are allowed" class="form-control shadow-none text-center" placeholder="Manager Name" />
                </div>
                <div class="mb-4">
                    <input name="manager_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password" />
                </div>
                <button name="login" type="submit" class="btn custom-bg text-white shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        $query = "SELECT * FROM `manager_cred` WHERE `manager_name`=? AND `manager_pass`=?";
        $values = [$frm_data['manager_name'], $frm_data['manager_pass']];
        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['managerLogin'] = true;
            $_SESSION['managerId'] = $row['sr_no'];
            redirect('dashboard.php');
        } else {
            alert('error', 'Login failed - invalid credentials!');
        }
    }
    ?>

    <?php require('inc/script.php'); ?>
</body>

</html>