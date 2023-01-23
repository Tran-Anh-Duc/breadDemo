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
@section('content')
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
        <div class="pagination d-felx justify-content-right" style="margin-top: 20px;margin-left: 80%">
            {{ $all_product->withQueryString()->render('paginate') }}
        </div>

    </div>

@endsection
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
                            alert('them san pham that bai')
                    }
                });
            })
        });

     </script>
@endsection
