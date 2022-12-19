@extends('home')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <div class="tables">
                    <a href="{{'create_product'}}" class="btn btn-success" style="margin-left: 88%">Thêm sản phẩm</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Tên sản phẩm</th>
                            <th scope="col" style="text-align: center">Mô tả sản phẩm</th>
                            <th scope="col" style="text-align: center">Trạng thái sản phẩm</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($resultAll) > 0 )
                            @foreach($resultAll as $key => $value)
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
                                    <td><a href="{{url('product/detail_product/'.$value['id'])}}" class="btn btn-warning">Chi tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                            'Không có dữ liệu '
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
