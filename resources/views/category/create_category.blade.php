@extends('home')
@section('title', 'Thêm mới loại sản phẩm ')
@section('style')
    <style>
        .invalid {
            font-size: 13px;
            color: red;
            font-weight: 500;
        }
        .border-red {
            border-color: red !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Thêm mới sản phẩm</h2>
                    <lable>Tên sản phẩm</lable>
                    <input type="text" name="name_category" placeholder="Nhập tên sản phẩm" id="name_category"
                           class="name_category form-control"/>
                    <br>
                    <lable>Mô tả sản phẩm</lable>
                    <input type="text" name="category_description" placeholder="Nhập mô tả sản phẩm"
                           class="category_description form-control"
                           id="category_description form-control">
                    <br>

                    <lable>upload ảnh</lable>
{{--                    <input type="text" name="category_image" id="category_image" class="form-control">--}}
                    <input type="file" name="image[]" class="image form-control" id="image" multiple>
                    <br>
                    <div class="imageHidden">

                    </div>
                    <div>
                        <div class="imageShow" style="display: flex">

                        </div>
                    </div>
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveCategory" class="btn btn-success saveCategory">Thêm mới</button>
                        <a href="{{route('category.list_category')}}" class="btn btn-danger close">Hủy</a>
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
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Đóng</button>
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
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
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
            $("#saveCategory").click(function (event) {
                event.preventDefault();
                $('.invalid').remove();
                $('.border-red').removeClass('border-red');
                var category_name = $("input[name='name_category']").val();
                var category_description = $("input[name='category_description']").val();
                var image = $("input[name='image2']").val();
                // var arr = Array.from(image.split(","));
                var formData = new FormData();
                formData.append('name_category', category_name);
                formData.append('category_description', category_description);
                formData.append('image', image);
                $.ajax({
                    url: '{{route('category.create_category')}}',
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
                                $.each(data.message, function (key, value) {
                                    let splitKey = key.split(".");
                                    let el = $("[name='" + splitKey[0] + "']");
                                    if (el.attr('name') == 'name_category' || el.attr('name') == 'category_description'
                                    ) {
                                        el.addClass('border-red');
                                        el.after('<span class="invalid">' + value[0] + '</span>');
                                    } else {
                                        el.addClass('border-red');
                                        el.after('<span class="invalid">' + value[0] + '</span>');
                                    }
                                })
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
                var totalImage = document.getElementById('image').files.length;
                var formData = new FormData();
                for (var i = 0 ; i < totalImage ; i++){
                    formData.append("image[]",document.getElementById('image').files[i]);
                }
                $.ajax({
                    url: '{{route('category.uploadImage')}}',
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function () {
                        $(".theloading").show();
                    },
                    success:function (data) {
                        var arrJson = JSON.stringify(data.data)
                        console.log(arrJson)
                            $('.imageHidden').append(
                                ' <input type="text"  id="image2" name="image2" class="form-control"  hidden/>'
                            );
                        document.getElementById('image2').value = arrJson;
                        for (var i = 0; i < data.data.length; i++) {
                            var imageOne = data.data[i].path;
                            $('.imageShow').append(
                                '<div><img src="' + imageOne + '" alt="" style="width: 250px; height: 250px"></div>'
                            );
                        }
                    },
                    error: function (data) {
                        alert('errors')
                    }
                })
            })


        });
    </script>
@endsection
