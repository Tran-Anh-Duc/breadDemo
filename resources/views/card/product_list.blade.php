@extends('master')
@section('css')
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            max-height: 500px;
            margin-left:100px;
            margin-right: 50px;
            margin-top: 20px;
            text-align: center;
            font-family: arial;
        }

        .price {
            color: grey;
            font-size: 22px;
        }

        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .card button:hover {
            opacity: 0.7;
        }
    </style>
@endsection
@section('slide')
    @parent
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/pfeiffer-beach-sunset-big-sur-ca-royalty-free-image-1590086887.jpg?crop=1.00xw:0.753xh;0,0&resize=980:*" class="d-block" alt="..." style="width:1100px;margin-left: 23%;height: 500px">
            </div>
            @foreach($news as $key => $value)
            <div class="carousel-item">
                <input type="text" value="{{$value['name_product']}}" hidden>
                <img src="{{$value['image']}}" class="d-block " alt="..." style="width:1100px;margin-left: 20%;height: 500px">
            </div>
            @endforeach
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
@endsection
@section('content')
            <h4 style="text-align: center;color: #2196F3;margin-top:20px">Những sản phẩm được quan tâm nhất</h4>
    <div class="card flex-container row" style="width: 977px;height: 400px;background-color:#c1de957a;margin-left: 200px;top: 10px;margin-bottom: 10px">
        @foreach($resultClick as $key => $value)
            <div class="card col-md-3" style="margin-left: 45px;margin-top: 45px">
                    <img
                        src="{{$value['image']}} "
                        alt="Denim Jeans" style="width:200px;height: 107px;margin-left: 10px">
                    <p style="height: 100%; font-size: 20px;text-align:center;font-weight: 1000">{{$value['name_product']}}</p>
                    <p class="price" style="text-align: center">Giá bán: {{number_format($value['price'])}} VND</p>
                    <p style="text-align: center;text-overflow: ellipsis;"  >Mô ta ngắn: {!!Str::limit($value['product_description'], 10) !!}</p>
                    <p>
                        <a href="#"
                           class="btn btn-info addCard"
                           type="button"
                           data-url="{{route('bread.add_to_card',['id' =>$value['id']])}}" style="margin-left: -14px"
                        >Thêm giỏ hàng</a>
                        <a href="{{route('bread.detailProduct',['id' =>$value['id']])}}" type="button" class="btn btn-primary">Xem chi tiết</a>
                    </p>
            </div>
        @endforeach
    </div>
    <div class="flex-container row" style="margin-left: 20%;max-width:100% ">
        @if(count($all_product) > 0)
            @foreach($all_product as $key => $value)
                <div class="card col-md-3" style="margin: 10px;">
                    <img
                        src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                        alt="Denim Jeans" style="width:100%">
                    <p style="height: 100%; font-size: 20px;text-align:center;font-weight: 1000">{{$value['name_product']}}</p>
                    <p class="price" style="text-align: center">Giá bán: {{number_format($value['price'])}} VND</p>
                    <p style="text-align: center;text-overflow: ellipsis;"  >Mô ta ngắn: {!!Str::limit($value['product_description'], 10) !!}</p>
                    <p>
                        <a href="#"
                           class="btn btn-info addCard"
                           type="button"
                           data-url="{{route('bread.add_to_card',['id' =>$value['id']])}}"
                        >Thêm giỏ hàng</a>
                        <a href="{{route('bread.detailProduct',['id' =>$value['id']])}}" type="button" class="btn btn-primary">Xem chi tiết</a>
                    </p>
                </div>
            @endforeach
        @else
           <span style="color: red;font-size: 30px;margin-left: 30%">'không có dữ liệu'</span>
        @endif
        <div class="pagination d-felx justify-content-right" style="display: flex !important;justify-content: flex-end !important;">
            {{ $all_product->withQueryString()->render('paginate') }}
        </div>
    </div>
@endsection
    <!-- modal success -->
        <div class="modal fade" id="successModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="staticBackdropLabel">Thành công</h5>
                    </div>
                    <div class="modal-body">
                        <p class="msg_success text-primary"></p>
                    </div>
                    <div class="modal-footer">
                        {{--            <a id="redirect-url" class="btn btn-success">Xem</a>--}}
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal error -->
        <div class="modal fade" id="errorModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="staticBackdropLabel">Có lỗi xảy ra</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="msg_error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $(".addCard").on('click',function (e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                   type:"GET",
                   url: url,
                    success:function (data) {
                        console.log(data)
                        if(data.status == 200){
                            alert('thêm sản phẩm thành công');
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        }
                    },
                    error:function (data) {
                        console.log(data)
                            alert('Thêm mới sản phẩm thất bại(bạn cần đăng nhập trước)')
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.href = "{{ route('bread.viewLogin') }}";
                        }, 500);
                    }
                });
            })
        });

     </script>
@endsection
