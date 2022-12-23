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
@section('script')
    <script>

    </script>
@endsection
