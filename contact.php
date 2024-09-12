<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']?>- CONTACT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="css/common.css">

</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Get in Touch: Connect with Us Easily! Reach Out for Questions, 
            Assistance, or Just to Say Hello – <br> We're Here for You!</p>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" src="<?php echo $contact_r['iframe'] ?>" height="320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
                    </a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +91 <?php echo $contact_r['pn1'] ?></a>
                    <br />
                    <?php
                    if ($contact_r['pn2'] != '') {
                        echo <<< data
                        <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +91 $contact_r[pn2]</a>
                        data;
                    }
                    ?>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email'] ?>" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
                    </a>
                    <h5 class="mt-4">Follow us</h5>
                    <?php
                    if ($contact_r['tw'] != '') {
                        echo <<< data
                        <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter me-1"></i>
                        </a>
                        data;
                    }
                    ?>

                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" required class="form-control shadow-none mt-3" style="font-weight: 500;">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" required class="form-control shadow-none mt-3" style="font-weight: 500;">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Subject</label>
                            <input type="text" name="subject" required class="form-control shadow-none mt-3" style="font-weight: 500;">
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Message</label>
                            <textarea rows="5" name="message" required class="form-control shadow-none" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['send'])){
        $frm_data = filteration($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
        $res = insert($q,$values,'ssss');
        if($res==1){
            alert('sucess','Mail sent!');
        }else{
            alert('error','server down try again later');
        }
    }
    ?>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>


</body>

</html>