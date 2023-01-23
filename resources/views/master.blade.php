<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bread Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/card_list.css') }}">
</head>
<style>
    .thumbnail {
        position: relative;
        padding: 0px;
        margin-bottom: 20px;
    }

    .thumbnail img {
        width: 80%;
    }

    .thumbnail .caption {
        margin: 7px;
    }

    .main-section {
        background-color: #F8F8F8;
    }

    .dropdown {
        float: right;
        padding-right: 30px;
    }

    .btn {
        border: 0px;
        margin: 10px 0px;
        box-shadow: none !important;
    }

    .dropdown .dropdown-menu {
        padding: 20px;
        top: 30px !important;
        width: 350px !important;
        left: -110px !important;
        box-shadow: 0px 5px 30px black;
    }

    .total-header-section {
        border-bottom: 1px solid #d2d2d2;
    }

    .total-section p {
        margin-bottom: 20px;
    }

    .cart-detail {
        padding: 15px 0px;
    }

    .cart-detail-img img {
        width: 100%;
        height: 100%;
        padding-left: 15px;
    }

    .cart-detail-product p {
        margin: 0px;
        color: #000;
        font-weight: 500;
    }

    .cart-detail .price {
        font-size: 12px;
        margin-right: 10px;
        font-weight: 500;
    }

    .cart-detail .count {
        color: #C2C2DC;
    }

    .checkout {
        border-top: 1px solid #d2d2d2;
        padding-top: 15px;
    }

    .checkout .btn-primary {
        border-radius: 50px;
        height: 50px;
    }

    .dropdown-menu:before {
        content: " ";
        position: absolute;
        top: -20px;
        right: 50px;
        border: 10px solid transparent;
        border-bottom-color: #fff;
    }
    body{
        background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');
        white-space: nowrap;
        background-size:cover;
    }


</style>
<body>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @yield('style')

        <nav style="margin-bottom: 20px" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('bread.logout')}}">Đăng xuất</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('bread.card')}}" tabindex="-1" aria-disabled="false">
                                @if(!empty(session('card')))
                                    show card: {{count(session('card'))}}
                                @else
                                    show card: 0
                                @endif
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" >
{{--                        action="{{url('bread/searchLikeProduct')}}" method="POST"--}}
{{--                        {{csrf_field()}}--}}
                            <?php
                                if (!empty($_GET['name_product'])){
                                    $nameProduct =  $_GET['name_product'];
                                }else{
                                    $nameProduct = "";
                                }
                            ?>
                            <input class="form-control me-2 search-product" name="name_product"  type="search" placeholder="Search" value="{{$nameProduct}}"
                                   aria-label="Search">
                            <button class="btn btn-outline-success search-product" id="search-product" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div id="product_search"></div>
    <div class="container">
        @yield('content')
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                $('#search-product').click(function () {
                    console.log('here')
                    let name_product = $("input[name='name_product']").val()
                    console.log(name_product)
                    window.location.href = '{{route('list')}}' + '?name_product=' + name_product;
                })
            })
        </script>
@yield('script')

</body>
</html>
