<title>table</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>

  *{
      margin: 0;
      padding: 0;
  }

  .box1{
    width: 50%;
    height: 800px;
    background-color: #685353;
  }
  .box2{
    width: 50%;
    height: 800px;
    background-color: #4e4e99;
  }


  #boxChil{
      width: 50%;
      overflow: hidden;
      padding: 100px;
  }

  .card{
      margin: 20px;
      /*width: 150px;*/
      /*height: 100px;*/
      float: left;
  }
  .text{
      white-space: nowrap;
      overflow: hidden;
  }

  .tables{
      margin-top: 13%;
  }

</style>
<body style="background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');white-space: nowrap;background-size:cover;">
<div class="">
    <div class="row" style="display: flex;padding: 30px;margin-top: 30px">
        <div class="col col-6 box1" id="boxChil">
            @if(!empty($resultProduct))
                 @foreach($resultProduct as $key =>$value)
                    <div class="card" style="width: 10rem;">
                        <img class="card-img-top" src="@if(!empty($value['image']))  {{$value['image']}}  @else  {{asset('/image/image1.jpg') }}  @endif"
                             alt="Ảnh đã xóa" style="width: 100%;height: 90px">
                        <div class="card-body">
                            <p class="card-text text"><a href="" class="btn btn-primary addCard" data-id-product="{{$value['id']}}"
                            data-id-table="{{$idTable}}" data-add-url="{{route('bread.addCardTable',['idProduct' => $value['id'],'idTable' => $idTable])}}"
                            style="text-align: center;text-overflow: clip;width: 120px">{{$value['name_product']}}</a></p>
                        </div>
                    </div>
                @endforeach
            @else
                <span style="color: red;text-align: center">Không có sản phẩm nào hết</span>
            @endif
                <div class="pagination d-felx justify-content-right" style="margin-top: 600px;margin-left: -19px;color: #0c4128">
                    {{ $resultProduct->appends($_GET)->links()}}
                </div>

        </div>

        <div class="col col-6 box2">
            <div class="tables">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên sản phẩm</th>
                            <th style="text-align: center">Giá sản phẩm</th>
                            <th style="text-align: center">Số lượng</th>
                            <th style="text-align: center" hidden >ID</th>
                            <th style="text-align: center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if(!empty($cardTable))
                                <?php $a = 0 ?>
                                @foreach($cardTable as $key => $value)
                                    <tr id="cradBox" data-id="{{$a++}}" class="block">
                                        <td style="text-align: center">{{$a}}</td>
                                        <td style="text-align: center">{{$value['name_product']}}</td>
                                        <td style="text-align: center">{{number_format($value['price'])}} :VND</td>
                                        <td style="text-align: center">
                                        <input type="number" value="{{$value['quantity']}}" name="quantity" id="quantity" style="width: 50px;text-align: center"></td>
                                        <td hidden><input  type="text" value="{{$value['idProduct']}}" name="idCard" id="idCard" style="width: 50px;text-align: center" /></td>
                                        <td style="text-align: center"><a href="" class="deleteCard" data-url="{{route('bread.deleteCardTable',['idTable' => $idTable])}}" data-card-id="{{$value['idProduct']}}"><i style="color: red" class="fa fa-trash" aria-hidden="true"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <span style="color: red">Chưa có sản phẩm nào hết !!!</span>
                            @endif
                    </tbody>
                </table>
                <table style="width: 100%;overflow: hidden">
                    <tr style="float: left;width: 50%">
                        <td><a href="" class="btn btn-info saveUpdate" id="saveUpdate" data-url-update="{{route('bread.updateCardTable',['idTable' =>$idTable])}}">Cập nhật</a></td>
                    </tr>
                    <tr style="float: right;width:35%">
                        <td style="padding-right: 8px !important;"><a href="{{route('bread.tableList')}}" class="btn btn-dark">Quay lại</a></td>
                        <td><a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="checkBill">Thanh toán/check bill</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
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
<!-- modal payment -->
<div class="modal fade modal-fullscreen" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <lable style="margin-bottom: 5px">Mã giảm giá</lable>
                <div class="" style="margin-bottom: 5px">
                    <input type="text" class="form-control coupon" id="coupon" name="coupon">
                </div>
                <lable style="margin-bottom: 5px">Người thanh toán</lable>
                <div style="margin-bottom: 5px">
                    @if(!empty($loginUser))
                        <input type="text" class="form-control created_by" id="created_by" name="created_by" value="{{$loginUser}}">
                    @endif
                </div>
                <div class="bill_order" id="bill_order">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createBill" data-bs-dismiss="modal" >Understood</button>
            </div>
        </div>
    </div>
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('.addCard').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('data-add-url')
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {
                        alert('thêm sản phẩm thành công');
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    }
                },
                error: function (data) {
                    console.log(data)
                    alert('them san pham that bai')
                }
            })
        })
        $('#saveUpdate').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('data-url-update');
            let data = { data : [] };
            let countBlock = 0;

            $('.block').each(function (key, value) {
                let block = $(value)
                block.attr('data-id', countBlock);
                let id = block.find("[name='idCard']").val();
                let quantity = block.find("[name='quantity']").val();
                let lead_card_product = {
                    id: id,
                    quantity: quantity
                }
                data.data[countBlock] = lead_card_product;
                countBlock++;
            })
            console.log(data)
            $.ajax({
                url: url,
                headers: {
                    "Content-Type": "application/json",
                     Accept: "application/json",
                     //'x-csrf-token': csrf
                },
                type: "POST",
                data: JSON.stringify(data),
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data)
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
        }),
        $('.deleteCard').on('click',function (e) {
               e.preventDefault();
               let url = $(this).attr('data-url')
               let id = $(this).attr('data-card-id')
               let formData = new FormData();
               formData.append('id',id)
                $.ajax({
                    url: url,
                    headers: {
                        // "Content-Type": "application/json",
                        // Accept: "application/json",
                        //'x-csrf-token': csrf
                    },
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".theloading").show();
                    },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        }
                    },
                    error: function (data) {
                        alert('xóa sản phẩm thất bại');
                        $(".theloading").hide();
                    }
                })
        })

        $('#checkBill').on('click',function (e) {
            e.preventDefault();
            let session = <?php echo json_encode($cardTable) ?>;
            if (session){
                //console.log(session)
                let block = "";
                let block_acceptions = $("#bill_order")
                $.each(session, function (key, value) {
                    block += ` <div class="bill blockProduct" id="bill" data-id="0">`
                    block += ` <lable>Tên sản phẩm</lable>`
                    block += `<input type="text" name="name_product" class="name_product form-control" id="name_product" value="` + value.name_product + `" disabled>`
                    block += `<lable>Giá sản phẩm</lable>`
                    block += `<input type="text" name="price" class="price form-control" id="price" value="` + value.price + `" disabled>`
                    block += `<lable>Số lượng sản phẩm</lable>`
                    block += ` <input type="text" id="quantity" name="quantity" class="form-control quantity" value="` + value.quantity + `" disabled>`
                    block += ` <input type="text" id="product_id" name="product_id" class="form-control product_id" value="` + value.idProduct + `" hidden>`
                    block += `</div>`
                    block += `<div style="margin-bottom: 15px"></div>`
                })
                $(block_acceptions).html(block)
            }else{
                console.log($('.block').length)
                let block = "";
                let block_acceptions = $("#bill_order")
                block += `<div class="bill block" id="bill" style="color: red;text-align: center;margin-top: 20px" >không có sản phẩm nào</div>`
                $(block_acceptions).html(block)
            }
            if ($('.block').length <= 0){
                let block = "";
                let block_acceptions = $("#bill_order")
                block += `<div class="bill block" id="bill" style="color: red;text-align: center;margin-top: 20px" >không có sản phẩm nào</div>`
                $(block_acceptions).html(block)
            }
        })

        $('#createBill').on('click',function (e) {
            e.preventDefault();
            var data = {
                coupon: $("input[name='coupon']").val(),
                created_by: $("input[name='created_by']").val(),
                data : []
            }
            var countBlock = 0;
            $(".blockProduct").each(function (key, value) {
                var block = $(value);
                block.attr('data-id',countBlock)
                var name_product = block.find("[name='name_product']").val();
                var price = block.find("[name='price']").val();
                var quantity = block.find("[name='quantity']").val();
                var product_id = block.find("[name='product_id']").val();
                var lead_bill_product = {
                    product_id:product_id,
                    price:price,
                    total:quantity
                }
                data.data[countBlock] = lead_bill_product;
                countBlock++;
            });
            console.log(data)
            if (confirm('bạn chắc chắn muốn thanh toán cho hóa đơn này')) {
                $.ajax({
                    url: '{{route('bread.createBillOneTable')}}',
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        //'x-csrf-token': csrf
                    },
                    type: "POST",
                    data: JSON.stringify(data),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status == 200) {
                            console.log(data.data.id)
                            var billId = data.data.id
                            var url = '{{route('bread.viewDetailBill',['id' => ':id'])}}'
                            url = url.replace(':id', billId)
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.href = url;
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
            }
        })
    })

</script>


