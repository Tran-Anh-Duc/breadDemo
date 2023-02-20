{{--<title>card</title>--}}
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
@extends('master')
@section('title','list table')
@section('style')
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 170px;
        /*max-height: 400px;*/
        margin-left: 100px;
        margin-right: 50px;
        margin-top: 80px !important;
        text-align: center;
        font-family: arial;
        background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkBug2sEZ0iwRD8jknr0xpYgdP4LwYxUXB1Mp-cdhdiQ&s');
        height: 190px;
        white-space: nowrap;
        background-size: cover;
        margin-bottom: 30px !important;
        /*filter: brightness(40%);*/
    }

    .keyTable {
        margin-bottom: -18px
    }

    .cardTable {
        margin-left: 46px;
    }
</style>
@endsection
@section('content')
<body style="background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');white-space: nowrap;background-size:cover;">

    <div class="flex-container row" style="margin-left: 20%;max-width:800px;background-color: rgba(115,153,173);margin-top: 80px;">
        <h3 style="color: #0d6efd;text-align: center;margin-top: 15px;margin-bottom: -45px">Danh sách bàn </h3>
        @if(count($resultTable) > 0)
            @foreach($resultTable as $key => $value)
                <div class="card col-md-3 cardTable">
                    <p style="height: 100%; font-size: 15px;text-align:center;font-weight: 500;color: #ac6e6e !important;">
                    Bàn số: {{$value['number_table']}} : <span style="color: #0c4128"><i class="fa fa-circle-o onTable" id="onTable"
                    @if($value['status_order'] == 2) style="color: red" @else style="color: #0f5132"  @endif  aria-hidden="true"></i>
                    <span>@if($value['status_order'] == 2) on @else off @endif</span>
                    </span></p>
                    <p>
                        @if($value['status_order'] == 2)
                             <a href="{{route('bread.findOneTable',['id' =>$value['id']])}}" type="button" class="btn btn-primary keyTable"
                             style="width: 100px;height: 33px;size: 10px;margin-bottom: -41px">Xem</a>
                        @else
                              <a href="{{route('bread.findOneTable',['id' =>$value['id']])}}" type="button" class="btn btn-primary keyTable"
                              style="width: 100px;height: 33px;size: 10px;display: none">Xem</a>
                        @endif

                    </p>
                    <p>
                        @if($value['status_order'] == 1)
                         <a href="#" type="button" class="btn btn-info openTable" id="openTable"
                        data-url="{{route('bread.updateStatusOrder',['id' =>$value['id']])}}" data-detailId="{{route('bread.findOneTable',['id' => $value['id']])}}"
                        style="width: 100px;height: 33px;font-size: 15px !important;margin-bottom: -15px">Mở bàn</a>
                        @else
                         <a href="#" type="button" class="btn btn-info openTable" id="openTable"
                        data-url="{{route('bread.updateStatusOrder',['id' =>$value['id']])}}" data-detailId="{{route('bread.findOneTable',['id' => $value['id']])}}"
                        style="width: 100px;height: 33px;font-size: 15px !important;margin-bottom: -15px;display: none">Mở bàn</a>
                        @endif

                    </p>
                </div>
            @endforeach
        @else
           <span style="color: red;font-size: 30px;margin-left: 30%">'không có dữ liệu'</span>
        @endif
    </div>
</body>
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
            $('.openTable').on('click', function (e) {
                e.preventDefault();
                var url = $(this).data('url');
                var detailId = $(this).attr('data-detailId');
                console.log(detailId)
                if (confirm('bạn chắc chắn muốn mở bàn')) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            console.log(data)
                            if (data.status == 200) {
                                alert('mở bàn thành công');
                                $('#onTable').css('color', 'red')
                                window.scrollTo(0, 0);
                                setTimeout(function () {
                                    window.location.href = detailId;
                                }, 500);
                            }
                        },
                        error: function (data) {
                            console.log(data)
                            alert('them san pham that bai')
                        }
                    });
                }
            })
        })

    </script>
@endsection
