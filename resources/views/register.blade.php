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

    <x-navbar></x-navbar>

    <form action="/register" method="POST">
        @csrf
        <div class="register-container">
            <div class="register-card">
                <div class="register-title">
                    <h2>Registration</h2>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div style="background: red; color:white; padding:5px;">
                            {{$item}}
                        </div>
                    @endforeach
                @endif
                <div class="form-input">
                    <label for="name">Your Name <span class="required">*</span></label>
                    <input  value="{{old('name')}}" type="text" autocomplete="off" autofocus required name="name" id="name">
                </div>
                <div class="form-input">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input value="{{old('email')}}"  type="text" autocomplete="off" autofocus required name="email" id="email">
                </div>
                <div class="form-input">
                    <label for="new_password">Create Password <span class="required">*</span></label>
                    <input type="password" autocomplete="off" autofocus required name="password" id="new_password">
                </div>
                <div class="form-input">
                    <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                    <input type="password" autocomplete="off" autofocus required name="password_confirmation" id="confirm_password">
                </div>
                <div class="submit-btn">
                    <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Register !</button>
                </div>
            </div>
        </div>
    </form>

</body>
</html>
