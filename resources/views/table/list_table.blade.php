@extends('home')
@section('title','list table')
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
                        <a href="{{route('table.view_create')}}" class="btn btn-success " style="margin-left: 90%">Thêm bàn mới</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Số bàn</th>
                            <th scope="col" style="text-align: center">Màu sắc</th>
                            <th scope="col" style="text-align: center">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($result) > 0 )
                            @foreach($result as $key => $value)
                                <tr>
                                    <th style="text-align: center">{{++$key}}</th>
                                    <td style="text-align: center">{{$value['number_table']}}</td>
{{--                                    <td style="text-align: center">{{$value['color_table']}}</td>--}}
                                    <td style="text-align: center">
                                        @if($value['color_table'] == 1)
                                            <span class="badge bg-secondary">bàn đang bảo trì</span>
                                        @elseif($value['color_table'] == 2)
                                            <span class="badge bg-success">bàn hoạt động bình thường</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if($value['status'] == 1)
                                            sản phẩm chưa kích hoạt
                                        @elseif($value['status'] == 2)
                                            sản phẩm đã được kích hoạt
                                        @endif
                                    </td>
                                    <td style="text-align: center;padding-top: 13px">
                                        <label for="" class="switch" data-id="{{$value['id']}}" data-url="{{route('table.update_status', ['id' => $value['id']])}}">
                                            <input type="checkbox" name="status_id" id="status_id" class="form-check-input "
                                                   value="2" {{$value['status'] == 2 ? 'checked' : ''}}
                                            />
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
{{--                                    <td><a href="{{url('store/detail_store/'.$value['id'])}}" class="btn btn-warning">Chi tiết</a></td>--}}
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
                    {{$result->appends($_GET)->links()}}
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
            $('.switch').click(function (event) {
                event.preventDefault();
                let id = $(this).attr('data-id');
                let url = $(this).attr('data-url');
                let formData = new FormData();
                formData.append('id', id);
                console.log(id,url)
                if (confirm("Bạn chắc chắn muốn thay đổi?")) {
                    $.ajax({
                        url: url,
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
                            console.log(data.data)
                            $(".theloading").hide();
                            if (data.status == 200) {
                                $('#successModal').modal('show');
                                $('.msg_success').text(data.message);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 500)
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
