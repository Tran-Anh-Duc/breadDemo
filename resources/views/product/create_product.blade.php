@extends('home')
@section('title', 'Thêm mới sản phẩm ')
@section('style')
    <style>
        .invalid{
            border: 1px solid red !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-sm">
        <div class="card">
        <div class="card-body ">
            <div class="tabs">
                <h2>Thêm mới sản phẩm</h2>
                <div>
                    <lable>Tên sản phẩm</lable>
                    <input type="text" name="name_product" placeholder="Nhập tên sản phẩm" id="name_product"
                           class="name_product form-control"/>
                </div>

                <div>
                    <lable>Mô tả sản phẩm</lable>
                    <input type="text" name="product_description" placeholder="Nhập mô tả sản phẩm"
                           class="product_description form-control"
                           id="product_description form-control"/>
                </div>

                <div>
                    <lable>Loại sản phẩm</lable>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">-- chọn loại sản phẩm --</option>
                        @foreach($category as $key => $value)
                            <option value="{{$value['id']}}">{{$value['name_category']}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <lable>Cửa hàng</lable>
                    <select name="store_id" id="store" class="form-control">
                        <option value="">-- chọn cửa hàng --</option>
                        @foreach($store as $key => $value)
                            <option value="{{$value['id']}}">{{$value['store_name']}}</option>
                        @endforeach
                    </select>
                </div>

               <div>
                   <lable>Giá bán sản phẩm</lable>
                   <input type="text" name="price" placeholder="Nhập giá sản phẩm"
                          class="price form-control"
                          id="price"/>
               </div>

                <div>
                    <lable>Số lượng sản phẩm</lable>
                    <input type="text" name="total" placeholder="Nhập sô lượng sản phẩm"
                           class="total form-control"
                           id="total"/>
                </div>


               <div>
                   <lable>upload ảnh</lable>
                   <input type="file" name="image" id="image" class="form-control">
               </div>
                <div class="imageHidden">

                </div>
            </div>
            <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                <div>
                    <button id="saveProduct" class="btn btn-success saveProduct">Thêm mới</button>
                    <a href="{{'list'}}" class="btn btn-danger close">Hủy</a>
                </div>
            </div>
        </div>
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
            $("#saveProduct").click(function (event) {
                event.preventDefault();
                $('.invalid-message').remove();
                $('.invalid').removeClass();
                var name_product = $("input[name='name_product']").val();
                var product_description = $("input[name='product_description']").val();
                var category = $("select[name='category_id']").val();
                var store = $("select[name='store_id']").val();
                var image = $("input[name='image2']").val();
                var price = $("input[name='price']").val();
                var total = $("input[name='total']").val();
                var formData = new FormData();
                formData.append('name_product', name_product);
                formData.append('product_description', product_description);
                formData.append('category_id', category);
                formData.append('store_id', store);
                formData.append('image', image);
                formData.append('price', price);
                formData.append('total', total);
                console.log(name_product, product_description, category, store,price,total)
                $.ajax({
                    url: '{{route('product.create_product')}}',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".theloading").show();
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2500);
                        } else {
                            if (data.message) {
                                console.log(data.message)
                                $(".msg_error").html("");
                                $.each(data.message, function(i) {$('[name=' + i + ']').after("<span class='invalid-message' style='margin-top: 5px;color: red'>" + data.message[i] + "</span>"); $('[name=' + i + ']').addClass("invalid")});
                            }

                        }
                    },
                    error: function (data) {
                        console.log(data);
                        $(".theloading").hide();
                    }
                })
            });

            $('#image').on('change',function () {
                var image = $("input[name='image']")[0].files[0];
                var formData = new FormData();
                formData.append('image',image);
                $.ajax({
                    url: '{{route('product.uploadImage')}}',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function () {
                        $(".theloading").show();
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            // $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            console.log(data.data)
                            $('.imageHidden').append(
                                ' <input type="text"  id="image2" name="image2" class="form-control" value="'+ data.data +'" hidden/>'+
                                '<div><img src="'+ data.data +'" alt="" style="width: 250px; height: 250px"></div>'
                            );
                        } else {
                            $('#errorModal').modal('show');
                            $('.msg_error').text(data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        $(".theloading").hide();
                    }
                })
            })


        });
    </script>
@endsection

