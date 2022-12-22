@extends('home')
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
                <div class="pagination d-felx justify-content-right">
                        {{ $resultAll->withQueryString()->render('paginate') }}
{{--                    {{ $resultAll->appends($_GET)->links()}}--}}
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
        });
    </script>
@endsection
