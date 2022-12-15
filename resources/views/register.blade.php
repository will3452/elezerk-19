<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body {
        background: url(img/announcement1.jpg);
    }
</style>
<body>

    <div class="header-container">
        <ul>
            <a href="/" class="menu-btn"><li>HOME</li></a>
            <a href="/about" class="menu-btn"><li>ABOUT</li></a>
            <a href="/announcment" class="menu-btn"><li>ANNOUNCEMENTS</li></a>
            <a href="/bac-schedules" class="menu-btn"><li>BAC SCHEDULES</li></a>
            <a href="/app" class="menu-btn"><li>LOGIN</li></a>
            <a href="#" class="active"><li>REGISTER</li></a>
        </ul>
    </div>

    <form action="#" method="POST">
        <div class="register-container">
            <div class="register-card">
                <div class="register-title">
                    <h2>Registration</h2>
                </div>
                <div class="form-input">
                    <label for="name">Your Name <span class="required">*</span></label>
                    <input type="text" autocomplete="off" autofocus required name="name" id="name">
                </div>
                <div class="form-input">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="text" autocomplete="off" autofocus required name="email" id="email">
                </div>
                <div class="form-input">
                    <label for="username">Username <span class="required">*</span></label>
                    <input type="text" autocomplete="off" autofocus required name="username" id="username">
                </div>
                <div class="form-input">
                    <label for="new_password">Create Password <span class="required">*</span></label>
                    <input type="text" autocomplete="off" autofocus required name="new_password" id="new_password">
                </div>
                <div class="form-input">
                    <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                    <input type="text" autocomplete="off" autofocus required name="confirm_password" id="confirm_password">
                </div>
                <div class="terms">
                    <input required type="checkbox" name="terms" id="terms">
                    <label for="terms">I agree to the <a href="#">Terms</a> and <a href="#">Conditions</a></label>
                </div>
                <div class="submit-btn">
                    <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Register</button>
                </div>
            </div>
        </div>
    </form>

</body>
</html>
