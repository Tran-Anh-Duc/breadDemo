@extends('home')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Thêm mới sản phẩm</h2>
                    <lable>Tên sản phẩm</lable>
                    <input type="text" name="category_name" placeholder="Nhập tên sản phẩm" id="category_name"
                           class="name_product form-control"/>

                    <lable>Mô tả sản phẩm</lable>
                    <input type="text" name="category_description" placeholder="Nhập mô tả sản phẩm"
                           class="category_description form-control"
                           id="category_description form-control">

                    <lable>upload ảnh</lable>
                    <input type="text" name="category_image" id="category_image" class="form-control">
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
                {{--            <a id="redirect-url" class="btn btn-success">Xem</a>--}}
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
            $("#saveCategory").click(function (event) {
                event.preventDefault();
                console.log('here')
                var category_name = $("input[name='category_name']").val();
                var category_description = $("input[name='category_description']").val();
                var formData =  formData = new FormData();
                formData.append('name_category', category_name);
                formData.append('category_description', category_description);
                console.log(category_name, category_description)
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
                            $('#errorModal').modal('show');
                            $('.msg_error').text(data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        $(".theloading").hide();
                    }
                })
            });

        });
    </script>
@endsection
