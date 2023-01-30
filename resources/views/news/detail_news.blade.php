@extends('home')
@section('title','find one news')
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
                    <input type="text" name="image" id="image" class="form-control" value="{{$category['image']}}">

                    <lable>Ngày tạo sản phẩm</lable>
                    <input type="text" name="created_at" id="created_at" class="form-control" value="{{$category['created_at']}}" disabled>

                    <input type="text"  value="{{$category['id']}}"  name="id_category" hidden
                           class="id_category form-control">
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