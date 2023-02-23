@extends('home')
@section('title','Thêm mới')
@section('style')
    <style>
        .hidden {
            display: none !important;
        }

        .store_name {
            width: 32%;
        }

        .btn-more {
            display: flex;
            justify-content: flex-end;
        }

    </style>
@endsection
@section('content')
    <div class="container-sm">
        <div class="card">
            <div class="card-body ">
                <div class="tabs">
                    <h2>Thêm mới sản phẩm vào kho</h2>
                    <lable>Tên kho</lable>
                    <select name="" id="" class="form-select store_name">
                        <option value="">-- Chọn kho --</option>
                        @foreach($lead_store as $key => $value)
                            <option value="{{$value['id']}}">{{$value['store_name']}}</option>
                        @endforeach
                    </select><br>
                    <div id="public-items" class="content3-div public-items">
                        <div class="row box-title-info rounded block" id="box-public" data-id="0">
                            <div class="col-lg-8 col-md-12 col-xs-12 ">
                                <div class="form-box1 row">
                                    <div class="form-ip col-lg-6 col-md-6 col-xs-12">
                                        <label>Mã ấn phẩm <span>*</span></label>
                                        @if(!empty($lead_product))
                                            <select id="item_id" class="form-select" name="item_id">
                                                <option value="">-- Chọn mã ấn phẩm --</option>
                                                @foreach($lead_product as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name_product']}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            "không tồn tại ấn phẩm nào hết"
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-xs-12" style="padding-top: 12px;">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 btn-del"
                                         style="display: flex; align-items: flex-end; height: 300;">
                                        <button id="removeButton" class="removeButton btn btn-danger" hidden>Xóa ấn phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row box-title-info rounded hidden" id="appendEl">
                            <div class="col-lg-8 col-md-12 col-xs-12 ">
                                <div class="form-box1 row">
                                    <div class="form-ip col-lg-6 col-md-6 col-xs-12">
                                        <label>Mã ấn phẩm <span>*</span></label>
                                        @if(!empty($lead_product))
                                            <select id="item_id" class="form-select" name="item_id">
                                                <option value="">-- Chọn mã ấn phẩm --</option>
                                                @foreach($lead_product as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name_product']}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            "không tồn tại ấn phẩm nào hết"
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-xs-12" style="padding-top: 12px;">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 btn-del"
                                         style="display: flex; align-items: flex-end; height: 300;">
                                        <button id="removeButton" class="removeButton btn btn-danger" >Xóa ấn phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-more">
                        <button type="button" class="btn btn-outline-success" id="moreButton">Thêm ấn phẩm</button>
                    </div>
                    </div>
                </div>
                <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                    <div>
                        <button id="saveNews" class="btn btn-success saveNews">Thêm mới</button>
                        <a href="{{route('news.list_news')}}" class="btn btn-danger close">Hủy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
