@extends('home')
<!DOCTYPE html>
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

        .btn-del button {
        width: 100%;
        height: 40px;
        background: #F4CDCD;
        font-weight: 600;
        font-size: 14px;
        line-height: 16px;
        color: #C70404;
        outline: none;
        border: none;
        border-radius: 8px;
        padding: 0px 12px;
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
                    <select name="storeId" id="storeId" class="form-select store_name storeId">
                        <option value="">-- Chọn kho --</option>
                        @foreach($lead_store as $key => $value)
                            <option value="{{$value['id']}}">{{$value['store_name']}}</option>
                        @endforeach
                    </select><br>
                    <div id="public_items" class="content3-div public_items">
                        <div class="row box-title-info rounded block" id="box-public" data-id="0">
                            <div class="col-lg-8 col-md-12 col-xs-12 ">
                                <div class="form-box1 row">
                                    <div class="form-ip col-lg-6 col-md-6 col-xs-12">
                                        <label>Mã sản phẩm <span>*</span></label>
                                        @if(!empty($lead_product))
                                            <select id="name_product" class="form-select name_product" name="name_product">
                                                <option value="">-- Chọn mã sản phẩm --</option>
                                                @foreach($lead_product as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name_product']}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            "không tồn tại sản phẩm nào hết"
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
                                        <button id="removeButton" class="removeButton btn btn-danger" hidden style="margin-left: -30%;margin-top: 60px">Xóa sản
                                            phẩm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row box-title-info rounded hidden" id="appendEl">
                            <div class="col-lg-8 col-md-12 col-xs-12 ">
                                <div class="form-box1 row">
                                    <div class="form-ip col-lg-6 col-md-6 col-xs-12">
                                        <label>Mã sản phẩm <span>*</span></label>
                                        @if(!empty($lead_product))
                                            <select id="name_product" class="form-select name_product" name="name_product">
                                                <option value="">-- Chọn mã sản phẩm --</option>
                                                @foreach($lead_product as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name_product']}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            "không tồn tại sản phẩm nào hết"
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
                                        <button id="removeButton" class="removeButton btn btn-danger" style="margin-left: -30%;margin-top: 60px">Xóa sản phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-more">
                        <button type="button" class="btn btn-outline-success" id="moreButton" style="margin-top: 15px">Thêm sản phẩm</button>
                    </div>
                </div>
            </div>
            <div class="buttons" style="margin-top: 10px; margin-bottom: 15px">
                <div>
                    <button id="saveNews" class="btn btn-success saveNews">Thêm mới</button>
                    <a href="{{route('product_store.list')}}" class="btn btn-danger close">Hủy</a>
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
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Đóng</button>
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
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
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
    const csrf = "{{ csrf_token() }}";
            $(document).ready(function () {
                var countBlock = 1;
                $("#moreButton").on("click", function () {
                    let el = $("#appendEl").clone();
                    el.removeClass("hidden");
                    el.addClass("block");
                    el.attr("id", "block");
                    el.attr("data-id", countBlock++);
                    $("#appendEl").before(el);
                    var countRemo = $('.removeButton').length;
                    console.log(countRemo)
                    if (countRemo >= 2) {
                        $('.removeButton').attr('hidden', false);
                    }
                });

                $('#public_items').on('click', '.removeButton', function (e) {
                    e.preventDefault();
                    var countRemo = $('.removeButton').length;
                    if (countRemo <= 3) {
                        $('.removeButton').attr('hidden', true);
                    }
                    let _el = $(e.target).closest(".block");
                    $(_el).remove();
                })

                $('#saveNews').on('click', function (e) {
                    e.preventDefault();
                    var data = {
                        store_id: $("select[name='storeId']").val(),
                        data: []
                    }
                    var countBlock = 0;
                    $(".block").each(function (key, value) {
                        var block = $(value);
                        block.attr('data-id', countBlock);
                        var name_product = block.find("[name='name_product']").val()
                        var lead_product = {
                            product_id: name_product
                        }
                        data.data[countBlock] = lead_product;
                        countBlock++;
                    })
                    console.log(data)
                    $.ajax({
                        url: '{{route('product_store.create_product_sotre')}}',
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            'x-csrf-token': csrf
                        },
                        type: "POST",
                        data: JSON.stringify(data),
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data.status == 200) {
                                $('#successModal').modal('show');
                                $('.msg_success').text(data.message);
                                window.scrollTo(0, 0);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2500);
                            } else {
                                $('#errorModal').modal('show');
                                $('.msg_error').text(data.message);
                            }
                        },
                        error: function (data) {
                            console.log(data)
                            alert('Có lỗi xảy ra')
                        }
                    })
                })


            })
    </script>
@endsection
