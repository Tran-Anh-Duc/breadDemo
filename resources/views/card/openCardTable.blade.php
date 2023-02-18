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
                    <p style="height: 100%; font-size: 15px;text-align:center;font-weight: 500;color: #ac6e6e !important;">Bàn số: {{$value['number_table']}}</p>
                    <p>
                        <a href="{{route('bread.findOneTable',['id' =>$value['id']])}}" type="button" class="btn btn-primary keyTable" style="width: 100px;height: 33px;size: 10px">chi tiết</a>
                    </p>
                </div>
            @endforeach
        @else
           <span style="color: red;font-size: 30px;margin-left: 30%">'không có dữ liệu'</span>
        @endif
    </div>


</body>
@endsection
