@extends('home')
@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 45px;
            height: 20px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            top: 2px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(16px);
            -ms-transform: translateX(16px);
            transform: translateX(16px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <div class="tables ">
                    <div style="right: 100%">
                        <a href="{{route('product.create_product_view')}}" class="btn btn-success " style="margin-left: 82%">Thêm sản phẩm</a>
                        <a type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal1">Tìm kiếm </a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Tên sản phẩm</th>
                            <th scope="col" style="text-align: center">Mô tả sản phẩm</th>
                            <th scope="col" style="text-align: center">Trạng thái sản phẩm</th>
                            <th scope="col" style="text-align: center">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($all_product) > 0 )
                            @foreach($all_product as $key => $value)
                                <tr>
                                    <th style="text-align: center">{{++$key}}</th>
                                    <td style="text-align: center">{{$value['name_product']}}</td>
                                    <td style="text-align: center">{{$value['product_description']}}</td>
                                    <td style="text-align: center">
                                        @if($value['status'] == 1)
                                            sản phẩm chưa kích hoạt
                                        @elseif($value['status'] == 2)
                                            sản phẩm đã được kích hoạt
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <label for="" class="switch" data-id="{{$value['id']}}">
                                            <input value="{{$value['id']}}" type="checkbox" name="status_id" id="status_id" class="form-check-input "
                                            <?php $value['status'] == 2 ? 'checked' : '' ?>
                                            />
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td><a href="{{url('product/detail_product/'.$value['id'])}}" class="btn btn-warning">Chi tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                             <div>
                                 <p style="color: red">Không có dữ liệu</p>
                             </div>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-felx justify-content-right">
                        {{ $all_product->withQueryString()->render('paginate') }}
                </div>
            </div>
        </div>
    </div>
    // modal search
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center">Tìm kiếm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('product/list')}}" method="get" target="_self">
                   <lable>Tên sản phẩm</lable>
                    <input type="text" placeholder="Nhập sản phẩm" name="name_product" id="name_product" class="form-control">

                    <lable>Trạng thái</lable>
                    <select name="status"  id="status" class="form-control">
                        <option value="">-- tất cả --</option>
                        <option value="2">Đã kích hoạt</option>
                        <option value="1">Chưa kích hoạt</option>
                    </select>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit"  value="Submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
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
            $('#searchData').click(function () {
                console.log('here')
                let name_product = $("input[name='name_product']").val()
                let status = $("select[name='status']").val()
                console.log(name_product, status)
                window.location.href = '{{route('product.list_product')}}' + '?name_product=' + name_product + '&status=' + status;
            })

            $('.switch').click(function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                // let status = $(this).prop('checked') == 2 ? 'Đã kích hoạt' : 'Chưa kích hoạt';
                let formData = new FormData();
                formData.append('id', id);
                // formData.append('status', status);
                if (confirm("Bạn chắc chắn muốn thay đổi?")) {
                    $.ajax({
                        url: '<?= $updateStatusUrl ?>',
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $(".theloading").show();
                        },
                        success: function (data) {
                            $(".theloading").hide();
                            if (data.data.status == 200) {
                                $('#successModal').modal('show');
                                $('.msg_success').text(data.message);
                                // setTimeout(function () {
                                //     window.location.reload();
                                // }, 500)
                            } else {
                                $('#errorModal').modal('show');
                                $('.msg_error').text(data.data.message);
                            }
                        },
                        error: function () {
                            $(".theloading").hide();
                            $('#errorModal').modal('show');
                        }
                    })
                }
            });

        });
    </script>
@endsection
