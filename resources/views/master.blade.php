<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Online Book Shop</title>
</head>
<body>
    {{View::make('header')}}
    @yield('content')
    {{View::make('footer')}}  
</body>
<style>
    .custom-login{
        height: 500px;
        padding-top: 100px;
    }
</style>
</html>