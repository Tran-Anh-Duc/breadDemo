<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<style>
    body{
        background-image: url('https://images01.nicepagecdn.com/page/67/56/website-template-preview-67567.jpg');
        white-space: nowrap;
        background-size:cover;
    }
</style>
<body>
<div class="menu-nav" style="margin-top: 10px;margin-bottom: 15px" >
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{'list'}}">Danh sách sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="test">Danh sách loại sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Danh sách cửa hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Lịch sử</a>
        </li>
    </ul>
</div>
@yield("content")
@yield('script')
</body>
</html>
