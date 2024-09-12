
<style>
    .error-message{
        color: red;
    }
</style>
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Halls</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About us</a>
                </li>
                <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a> -->
                <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
            </ul>
            <!-- Login Code Logic -->
            <div class="d-flex">
                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                <?php
                // define('USERS_IMG_PATH', SITE_URL . 'images/users/');

                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $path = USERS_IMG_PATH;
                    echo <<<data
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[uPic]" style="width:25px; height:25px;" class="rounded-circle me-1">
                            $_SESSION[uName]
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            
                        </ul>
                    </div>
                    data;
                } else {
                    echo <<<data
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3  me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                    <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Core Users
                    </a>

                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="admin/index.php">Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="manager/index.php">Manager</a></li>
                    </ul>
                    </div>
                    data;
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile</label>
                        <input type="text" name="email_mob" class="form-control shadow-none" required />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control shadow-none" name="pass" required />
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">
                            Login
                        </button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#ForgotModal" data-bs-dismiss="modal">
                            Forgot Password?
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User
                        Registeration
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">Note: Your details
                        must match with your ID (Aadhar Card,
                        Passport, Driving License, etc) that will be required during
                        check-in.</span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" required />
                                <div id="error-message" class="error-message"></div>
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadow-none" oninput="validateEmail(this)" required />
                                <p id="emailWarning" style="color: red; display: none;">Please enter a valid email address.</p>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phonenum" type="number" id="mobileNumber" oninput="validateMobileNumber(this)" class="form-control shadow-none" required />
                                <p id="warning" style="color: red; display: none;">Please enter a 10-digit mobile number.</p>
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Picture</label>
                                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" />
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pincode</label>
                                <input name="pincode" type="number" class="form-control shadow-none" required />
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Date of birth</label>
                                <input name="dob" type="date" class="form-control shadow-none" required />
                            </div>
                            <div class="col-md-6 ps-0">
                                <label class="form-label">Password</label>
                                <input name="pass" type="password" oninput="validatePassword(this)" class="form-control shadow-none" required />
                                <p id="passwordWarning" style="color: red; display: none;">Password must be at least 8 characters long.</p>
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Confirm Password</label>
                                <input name="cpass" type="password" oninput="validateConfirmPassword(this)" class="form-control shadow-none" required />
                                <p id="confirmPasswordWarning" style="color: red; display: none;">Passwords do not match.</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none my-2">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Forgot Password -->
<div class="modal fade" id="ForgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                    </h5>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: A link will be sent to your email to reset your password.</span>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required />
                    </div>
                    <div class="mb-2 text-end">
                        <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                            CANCEL
                        </button>
                        <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function validateMobileNumber(input) {
        let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters

        if (value.length === 10) {
            document.getElementById('warning').style.display = 'none'; // Hide warning
        } else {
            document.getElementById('warning').style.display = 'block'; // Show warning
        }
    }

//     function validateMobileNumber(input) {
//     let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters

//     // Regular expression to match Indian mobile numbers starting with '91' followed by 10 digits
//     let regex = /^91[0-9]{10}$/;

//     if (regex.test(value)) {
//         document.getElementById('warning').style.display = 'none'; // Hide warning
//     } else {
//         document.getElementById('warning').style.display = 'block'; // Show warning
//     }
// }


    function validateEmail(input) {
        let email = input.value.trim();

        // Regular expression for basic email validation
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailRegex.test(email)) {
            document.getElementById('emailWarning').style.display = 'none'; // Hide warning
        } else {
            document.getElementById('emailWarning').style.display = 'block'; // Show warning
        }
    }

    function validatePassword(input) {
        let password = input.value.trim();

        if (password.length >= 8) {
            document.getElementById('passwordWarning').style.display = 'none'; // Hide warning
        } else {
            document.getElementById('passwordWarning').style.display = 'block'; // Show warning
        }
    }

    function core_user_btn() {
        let btn = document.getElementById('core_user');
        btn.addEventListener('click', function() {
            window.location.href = 'index.php';
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
            var inputField = document.querySelector('input[name="name"]');
            var errorMessage = document.getElementById('error-message');

            inputField.addEventListener('input', function () {
                var inputValue = inputField.value;

                // Regular expression to check if the input contains numbers or special characters
                var regex = /[0-9`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

                if (regex.test(inputValue)) {
                    errorMessage.textContent = "Numbers and special characters are not allowed.";
                } else {
                    errorMessage.textContent = "";
                }
            });
        });
    // function validateConfirmPassword(input) {
    //    let confirmPassword = input.value.trim();
    //    let password = document.querySelector('input[name="password"]').value.trim();

    //    if (confirmPassword === password) {
    //      document.getElementById('confirmPasswordWarning').style.display = 'none'; // Hide warning
    //    } else {
    //      document.getElementById('confirmPasswordWarning').style.display = 'block'; // Show warning
    //    }
    //  }
</script>