<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <script>
        let password = prompt('Please enter your password to continue.');

        if (! password || password.length == 0) {
            window.location.href='/';
        } else {
            window.location.href='/verify-validate/{{$file}}?password='+password;
        }
    </script>
</body>
</html>
