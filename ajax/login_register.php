<?php
require('../manager/inc/db_config.php');
require('../manager/inc/essentials.php');
require('../ajax/PHPMailer/Exception.php');
require('../ajax/PHPMailer/PHPMailer.php');
require('../ajax/PHPMailer/SMTP.php');
date_default_timezone_set("Asia/kolkata");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $token, $type){
    if($type == 'email_confirmation'){
        $page = 'email_confirm.php';
        $subject = 'Account Verification Link';
        $content = 'Confirm your email';
    }else{
        $page = 'index.php';
        $subject = 'Account reset Link';
        $content = 'Reset your account';
    }
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = PHPMAILER_EMAIL;
        $mail->Password   = 'wwds wtou gcqw wldo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
    
        //Recipients
        $mail->setFrom(PHPMAILER_EMAIL, PHPMAILER_NAME);
        $mail->addAddress($email);
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Click the link to $content: <br>
        <a href='" . SITE_URL . "$page?$type&email=$email&token=$token" . "'>CLICK ME</a>";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Password and confirm password
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Check if user exists or not
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? 
    OR `phonenum` = ? LIMIT 1", [$data['email'], $data['phonenum']], 'ss');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Upload user image to the server
    $img = uploadUserImage($_FILES['profile']);
    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Check if email exists in the database
    // $email_check = select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", [$data['email']], 's');

    // if (mysqli_num_rows($email_check) != 0) {
    //     echo 'email_already';
    //     exit;
    // }

    // Send a confirmation link to the user's email (using sendgrid)
    $token = bin2hex(random_bytes(16));
    $mailResult = sendMail($data['email'], $token, 'email_confirmation');

    if ($mailResult === true) {
        // Mail sent successfully, proceed with database insertion
        $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

        $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
        $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['pincode'], $data['dob'], $img, $enc_pass, $token];
        
        if (insert($query, $values, 'sssssssss')) {
            echo 1; // Successful registration
        } else {
            echo 'ins_failed';
        }
    } else {
        // Mail sending failed, echo the error message
        echo $mailResult;
    }
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? 
    OR `phonenum` = ? LIMIT 1", [$data['email_mob'], $data['email_mob']], 'ss');

    if (mysqli_num_rows($u_exist) == 0) {
        echo "inv_email_mob";
    }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo "not_verified";
        }elseif($u_fetch['status']==0){
            echo 'inactive';
        }else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
                echo 'invalid_pass';
            }else{
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                echo 1;
            }
        }
    }
}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", [$data['email']], 's');

    if (mysqli_num_rows($u_exist) == 0) {
        echo "inv_email";
    }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo "not_verified";
        }elseif($u_fetch['status']==0){
            echo 'inactive';
        }else{
            //send reset link to email
            $token = bin2hex(random_bytes(16));
            if(!sendMail($data['email'], $token, 'account_recovery')){
                echo 'email_failed';
            }else{
                //account can only be recover on which date the req is made
                $date = date("Y-m-d");
                $query = mysqli_query($con,"UPDATE `user_cred` SET `token`='$token', `t_expire`='$date' WHERE `id`='$u_fetch[id]'");
                if($query){
                    echo 1;
                }else{
                    echo 'upd_failed';
            }
        }
    }
}
}

if (isset($_POST['recover_user'])) {
   $data = filteration($_POST);
   $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
   $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=? 
          WHERE `email`=? AND `token`=?";
            // yaha per hum token and t_expire ko null kardege jise dubara link per click karne pe kuch na ho
    $values = [$enc_pass,null,null,$data['email'],$data['token']];

    if(update($query,$values,'sssss')){
        echo 1;
    }else{
        echo 'failed';
    }
}
?>