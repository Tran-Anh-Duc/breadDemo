@extends('home')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <div class="tables ">
                    <div style="right: 100%">
                        <a href="{{route('store.view_store')}}" class="btn btn-success " style="margin-left: 82%">Thêm sản phẩm</a>
                        <a type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal1">Tìm kiếm </a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Tên cửa hàng</th>
                            <th scope="col" style="text-align: center">Địa chỉ của cửa hàng</th>
                            <th scope="col" style="text-align: center">Trạng thái cửa hàng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($store) > 0 )
                            @foreach($store as $key => $value)
                                <tr>
                                    <th style="text-align: center">{{++$key}}</th>
                                    <td style="text-align: center">{{$value['store_name']}}</td>
                                    <td style="text-align: center">{{$value['store_address']}}</td>
                                    <td style="text-align: center">
                                        @if($value['status_store'] == 1)
                                            sản phẩm chưa kích hoạt
                                        @elseif($value['status_store'] == 2)
                                            sản phẩm đã được kích hoạt
                                        @endif
                                    </td>
                                    <td><a href="{{url('store/detail_store/'.$value['id'])}}" class="btn btn-warning">Chi tiết</a></td>
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
                    {{ $store->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
