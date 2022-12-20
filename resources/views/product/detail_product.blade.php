@extends('home')
@section('title', 'Chi mới sản phẩm ')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Chi tiết sản phẩm</h2>
                    <lable>Tên sản phẩm</lable>
                    <input type="text" name="name_product" placeholder="Nhập tên sản phẩm" id="name_product"
                           value="{{$detail['name_product']}}"
                           class="name_product  form-control"/>

                    <lable>Mô tả sản phẩm</lable>
                    <input type="text" name="product_description" placeholder="Nhập mô tả sản phẩm"
                           value="{{$detail['product_description']}}"
                           class="product_description form-control"
                           id="product_description form-control">

                    <lable>Loại sản phẩm</lable>
                    <select name="category" id="category" class="form-control">
                        @foreach($category as $k => $i)
                            <option
                                value="{{$i['id']}}" {{ ($detail['category_id'] == $i['id']) ? 'selected' : '' }}>{{$i['name_category']}}</option>
                        @endforeach
                    </select>

                    <lable>Cửa hàng</lable>
                    <select name="store" id="store" class="form-control">
                        @foreach($store as $k => $v)
                            <option
                                value="{{$v['id']}}" {{($detail['store_id'] == $v['id']) ? 'selected' : '' }}>{{$v['store_name']}}</option>
                        @endforeach
                    </select>

                    <lable>upload ảnh</lable>
                    <input type="text" name="image" id="image" class="form-control" value="{{$detail['image']}}">
                    <input type="text" hidden value="{{$detail['id']}}"  name="id_product"
                           class="id_product form-control">
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveDetailProduct" data-id="{{$detail['id']}}" class="btn btn-success ">Chỉnh sửa</button>
                        <a href="{{url('product/list')}}" class="btn btn-danger close">Hủy</a>
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
            $('#saveDetailProduct').click(function (e) {
                e.preventDefault()
                var id = $(this).attr('data-id');
                var name_product = $("input[name='name_product']").val()
                var product_description = $("input[name='product_description']").val()
                var category = $("select[name='category']").val()
                var store = $("select[name='store']").val()
                var image = $("input[name='image']").val()
                var formData = new FormData();
                formData.append('name_product', name_product)
                formData.append('product_description', product_description)
                formData.append('category_id', category)
                formData.append('store_id', store)
                formData.append('image', image)
                console.log(id,name_product, product_description, category, store)
                if (confirm("Bạn chắc chắn muốn cập nhật hợp đồng?")) {
                    $.ajax({
                        // url: 'http://127.0.0.1:8000/product/update_product/' + id,
                        {{--url: '{{url('product/update_product/' . $id)}}',--}}
                        url: '{{route('product.update_product' , ['id' => $id])}}',
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $(".theloading").show();
                        },
                        success: function (data) {
                            $(".theloading").hide();
                            if (data.status == 200) {
                                $('#successModal').modal('show');
                                $('.msg_success').text(data.message);
                                // window.scrollTo(0, 0);
                                // setTimeout(function () {
                                //     window.location.reload();
                                // }, 500);
                            } else {
                                $('#errorModal').modal('show');
                                $('.msg_success').text(data.message);
                                // window.scrollTo(0, 0);
                                // setTimeout(function () {
                                //     window.location.reload();
                                // }, 500);
                            }
                        },
                        error: function (data) {
                            console.log(data);
                            $(".theloading").hide();
                        }
                    });
                }
            });
        });

    </script>
@endsection
