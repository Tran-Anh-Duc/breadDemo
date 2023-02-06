@extends('home')
@section('title','create news')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Thêm mới sản phẩm</h2>
                    <lable>Tên bài viết</lable>
                    <input type="text" name="news_name" placeholder="Nhập tên bài viết" id="news_name"
                           class="name_product form-control"/>

                    <lable>Nội dung bài viết</lable>
                    <textarea type="text" name="news_description" placeholder="Nội dung bài viết"
                           class="news_description form-control"
                              id="news_description form-control"></textarea>

                    <lable>upload ảnh</lable>
                    <input type="file"
                           name="image"
                           id="image"
                           class="form-control">
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveNews" class="btn btn-success saveNews">Thêm mới</button>
                        <a href="{{route('news.list_news')}}" class="btn btn-danger close">Hủy</a>
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
            $("#saveNews").click(function (e) {
                e.preventDefault();
                var news_name = $("input[name='news_name']").val();
                var news_description = $("textarea[name='news_description']").val();
                var image = $("input[name='image']").val();
                var formData = new FormData();
                formData.append('news_name',news_name);
                formData.append('news_description',news_description);
                formData.append('image',image);
                console.log(image,news_name,news_description)
                $.ajax({
                    url: '{{route('news.create_news')}}',
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
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            // window.scrollTo(0, 0);
                            // setTimeout(function () {
                            //     window.location.reload();
                            // }, 2500);
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
        })

    </script>
@endsection
