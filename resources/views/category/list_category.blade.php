@extends('home')
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <div class="tables ">
                    <div style="right: 100%">
                        <a href="{{route('category.create_category_view')}}" class="btn btn-success " style="margin-left: 82%">Thêm sản phẩm</a>
                        <a type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal1">Tìm kiếm </a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center">STT</th>
                            <th scope="col" style="text-align: center">Tên loại sản phẩm</th>
                            <th scope="col" style="text-align: center">Mô tả loại sản phẩm</th>
                            <th scope="col" style="text-align: center">Trạng thái loại sản phẩm</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($category) > 0 )
                            @foreach($category as $key => $value)
                                <tr>
                                    <th style="text-align: center">{{++$key}}</th>
                                    <td style="text-align: center">{{$value['name_category']}}</td>
                                    <td style="text-align: center">{{$value['category_description']}}</td>
                                    <td style="text-align: center">
                                        @if($value['status'] == 1)
                                            sản phẩm chưa kích hoạt
                                        @elseif($value['status'] == 2)
                                            sản phẩm đã được kích hoạt
                                        @endif
                                    </td>
                                    <td><a href="#" class="btn btn-warning">Chi tiết</a></td>
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
                 {{ $category->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">

    </script>
@endsection
