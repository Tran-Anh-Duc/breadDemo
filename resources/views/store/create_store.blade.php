@extends('home')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Thêm mới cửa hàng</h2>
                    <lable>Tên cửa hàng</lable>
                    <input type="text" name="store_name" placeholder="Nhập tên cửa hàng" id="store_name"
                           class="store_name form-control"/>
                    <lable>Địa chỉ cửa hàng</lable>
                    <input type="text" name="store_address" placeholder="Nhập mô tả sản phẩm"
                           class="store_address form-control"
                           id="store_address">
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveStore" class="btn btn-success saveStore">Thêm mới</button>
                        <a href="{{route('store.list_store')}}" class="btn btn-danger close">Hủy</a>
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
            $("#saveStore").click(function (event) {
                event.preventDefault();
                var store_name = $("input[name='store_name']").val();
                var store_address = $("input[name='store_address']").val();
                var formData =  formData = new FormData();
                formData.append('store_name', store_name);
                formData.append('store_address', store_address);
                console.log(store_name, store_address)
                $.ajax({
                    url: '{{route('store.create_store')}}',
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
