<title>card</title>
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<style>
    th{
        color: white
    }

    h3{
        text-align: center;
        color: white;
        font-size: 25px;
        margin-bottom: 30px;
        margin-top: 20px;
    }
</style>
<body style="background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');white-space: nowrap;background-size:cover;">
<div class="container-sm">
    <h3>Giỏ hàng của bạn</h3>
    <table id="cart" class="table table-hover table-condensed list_card">
        <thead>
        <tr>
            <th style="width:50%;">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        @php $total = 0 @endphp
        @if(!empty(session('card')))
            @foreach(session('card') as $key => $detail)
                @php $total += $detail['price'] * $detail['quantity'] @endphp
                <tr data-id="{{ $key }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                     width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin" style="color: white">{{ $detail['name_product'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" style="color: white">{{ number_format($detail['price']) }} VND</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $detail['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center" style="color: white">{{ number_format($detail['price'] * $detail['quantity']) }}VND</td>
                    <td class="actions" data-th="">
                        <button data-id-delete="{{$key}}" class="btn btn-danger btn-sm remove-from-cart" data-delete="{{route('bread.removeCard')}}"><i class="fa fa-trash-o"></i></button>
                    </td>
                    <td>
                        <button data-id="{{$key}}" class="btn btn-info update_card" data-url="{{route('bread.updateCard')}}">update</button>
                    </td>
                </tr>
            @endforeach
        @else
            <p style="color: red;margin-top: 20px;text-align: center">không có sản phẩm nào trong giỏ hàng</p>
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total) }} VND</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/bread/list_product') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success" data-bs-toggle="modal"  data-bs-target="#staticBackdrop" id="checkBill" >Checkout</button>
            </td>
        </tr>
        </tfoot>
    </table>
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

<!-- Modal -->
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
            <lable style="margin-bottom: 5px">Người mua hàng</lable>
            <div style="margin-bottom: 5px">
                <input type="text" class="form-control created_by" id="created_by" name="created_by">
            </div>
            <div class="bills" id="bills">

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
    var csrf = "{{ csrf_token() }}";
    $(document).ready(function () {
        $('.update_card').on('click', function (e) {
            e.preventDefault()
            var url = $(this).data('url')
            var id = $(this).data('id')
            var quantity = $(this).parents('tr').find('input.quantity').val()
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id,
                    quantity: quantity
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {
                        $('.list_card').html(data.data)
                        alert('update card success')
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    }
                },
                error: function (data) {
                    alert('update errors')
                }
            })
        })

        $('.remove-from-cart').on('click',function (e) {
            e.preventDefault();
            var url = $(this).data('delete');
            var id = $(this).data('id-delete')
            console.log(id,url)
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {
                        $('.list_card').html(data.data)
                        alert('delete card success')
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    }
                },
                error: function (data) {
                    alert('delete errors')
                }
            })
        })

        $('#checkBill').on('click',function (e) {
            var session = <?php echo json_encode(session('card')) ?>;
            if(session){
                let block = "";
                let block_acceptions = $("#bills")
                $.each(session, function (key, value) {
                    block += ` <div class="bill block" id="bill" data-id="0">`
                    block += ` <lable>Tên sản phẩm</lable>`
                    block += `<input type="text" name="name_product" class="name_product form-control" id="name_product" value="` + value.name_product + `" disabled>`
                    block += `<lable>Giá sản phẩm</lable>`
                    block += `<input type="text" name="price" class="price form-control" id="price" value="` + value.price + `" disabled>`
                    block += `<lable>Số lượng sản phẩm</lable>`
                    block += ` <input type="text" id="quantity" name="quantity" class="form-control quantity" value="` + value.quantity + `" disabled>`
                    block += ` <input type="text" id="product_id" name="product_id" class="form-control product_id" value="` + value.product_id + `" hidden>`
                    block += `</div>`
                    block += `<div style="margin-bottom: 15px"></div>`
                })
                $(block_acceptions).html(block)
            }else{
                console.log($('.block').length)
               let block = "";
               let block_acceptions = $("#bills")
               block += `<div class="bill block" id="bill" style="color: red;text-align: center;margin-top: 20px" >không có sản phẩm nào</div>`
               $(block_acceptions).html(block)
            }
            if ($('.block').length <= 0){
               let block = "";
               let block_acceptions = $("#bills")
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
            $(".block").each(function (key, value) {
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
            if (confirm('bạn chắc chắn muốn thanh toán cho hóa đơn này')) {
                $.ajax({
                    url: '{{route('bread.createBill')}}',
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



    });
</script>

