@extends('home')
@section('style')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
{{--<link href="--}}
{{--https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css--}}
{{--" rel="stylesheet">--}}
    <style>

    </style>
@endsection
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Chi tiết sản phẩm</h2>
                    <lable>Tên sản phẩm</lable>
                    <input type="text" name="name_category" placeholder="Nhập tên loại sản phẩm" id="name_category"
                           value="{{$category['name_category']}}"
                           class="name_category  form-control"/>

                    <lable>Mô tả sản phẩm</lable>
                    <input type="text" name="category_description" placeholder="Nhập mô loại tả sản phẩm"
                           value="{{$category['category_description']}}"
                           class="category_description form-control"
                           id="category_description form-control">

                    <lable>upload ảnh</lable>
                    <br>
                    <div class="imageShow" style="display: flex;" id="gallery">
                    @if(!empty($image_category))
                        @foreach($image_category as $value)
                           <div style="display: grid;margin: 10px" >
                               <span>Tên ảnh: {{$value->name}}</span>
                               <a data-fancybox="gallery" href="{{$value->path}}" class="fancybox"   data-caption="Optional caption,&lt;br /&gt;that can contain &lt;em&gt;HTML&lt;/em&gt; code"
                                  rel="gallery"><img src="{{$value->path}}" alt="" style="width: 250px; height: 250px;"></a>
                           </div>
                        @endforeach
                    @endif
                    </div>
                    <br>
                    <lable>Ngày tạo sản phẩm</lable>
                    <input type="text" name="created_at" id="created_at" class="form-control" value="{{$category['created_at']}}" disabled />

                    <input type="text"  value="{{$category['id']}}"  name="id_category" hidden
                           class="id_category form-control" />
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveDetailCategory" data-id="{{$category['id']}}" class="btn btn-success ">Chỉnh sửa</button>
                        <a href="{{url('category/list')}}" class="btn btn-danger close">Hủy</a>
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

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>--}}
{{--<script src="--}}
{{--https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js--}}
{{--"></script>--}}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
        $("#saveDetailCategory").click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var name_category = $("input[name='name_category']").val()
            var category_description = $("input[name='category_description']").val()
            var formData = new FormData();
            formData.append('id', id)
            formData.append('name_category', name_category)
            formData.append('category_description', category_description)
            console.log(name_category,category_description)
            if (confirm("Bạn chắc chắn muốn cập nhật loại sản phẩm?")) {
                $.ajax({
                    url: '{{url('category/update_category/' . $id)}}',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".theloading").show();
                    },
                    success: function (data) {
                        console.log(data.data)
                        $(".theloading").hide();
                        if (data.status == 200) {
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            $('#errorModal').modal('show');
                            $('.msg_error').text(data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        $(".theloading").hide();
                    }
                });
            }
        })

            Fancybox
                .bind('#gallery a', {
                    groupAll: true,
                    padding: 0, // default 15
                    margin: 0,   // default 20
                    width: 860,  // default 800
                    height: 640, // default 600
                    opacity: true, // default false
                    openEffect: 'elastic',
                    closeEffect: 'elastic',
                });





        });

    </script>
@endsection
