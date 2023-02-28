@extends('home')
@section('title','danh sách phiếu thanh toán')

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
                        <a href="{{route('product_store.view_product_store')}}" class="btn btn-success " style="margin-left: 79%" hidden>Thêm mới sản phẩm vào kho</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Mã phiếu thanh toán</th>
                            <th scope="col" style="text-align: center">Tên mã phiếu giảm giá</th>
                            <th scope="col" style="text-align: center">Tên khách hàng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($resultList) > 0 )
                            @foreach($resultList as $key => $value)
                                <tr>
                                    <th style="text-align: center">{{++$key}}</th>
                                    <td style="text-align: center">{{$value['user']}}</td>
                                    <td style="text-align: center">{{$value['coupon']}}</td>
                                    <td style="text-align: center">{{$value['created_by']}}</td>
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
{{--                <div class="pagination d-felx justify-content-right">--}}
{{--                    {{$product_store->appends($_GET)->links()}}--}}
{{--                </div>--}}
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
    <script>

    </script>
@endsection

