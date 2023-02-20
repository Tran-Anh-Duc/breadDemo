<title>table</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
  .box1{
    width: 800px;
    height: 900px;
    background-color: #685353;
    margin-right: 10px;
    margin-left: 190px;
  }
  .box2{
    width: 770px;
    height: 900px;
    background-color: #4e4e99;
  }

  .addCard {
      font-size: 13px;
      width: 120px;
  }
  .cardName{
    width: 76%;
    flex: 0 0 auto;
  }
</style>
<body style="background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');white-space: nowrap;background-size:cover;">
<div class="">
    <div class="row" style="margin-top: 80px;margin-bottom: 10px">
        <div class="box1 col col-6">
            <h3 style="text-align: center;color: #abddc5">Danh sách sản phẩm</h3>
            <div class="card" style="margin-top: 10px">
                <div class="flex-container row" style="margin-left: 20%;max-width:73% ">
                    @if(count($resultProduct) > 0)
                        @foreach($resultProduct as $key => $value)
                            <div class="card col-md-3" style="margin: 10px;margin-top: 30px !important;">
                                <img
                                    src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                    alt="Denim Jeans" style="width:100%">
                                <p style="height: 100%; font-size: 13px;text-align:center;font-weight: 1000">{!!Str::limit($value['name_product'],10) !!}</p>
                                <p class="price" style="text-align: center">Giá bán: {{number_format($value['price'])}} VND</p>
                                    <a href="#"
                                       class="btn btn-info addCard"
                                       type="button"
                                       data-url="{{route('bread.addCardTable',['idProduct' =>$value['id'] ,'idTable'=>$id ])}}" data-idProduct="{{$value['id']}}" data-idTable="{{$id}}"
                                    >Thêm giỏ hàng</a>
                            </div>
                        @endforeach
                    @else
                        <span style="color: red;font-size: 30px;margin-left: 30%">'không có dữ liệu'</span>
                    @endif
                    <div class="pagination d-felx justify-content-right"
                         style="display: flex !important;justify-content: flex-end !important;">
                        {{ $resultProduct->withQueryString()->render('paginate') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="box2 col col-6">
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
        @if(session()->has('table-'.$id))
{{--        @if(!empty(session('cardTable')))--}}
{{--            @foreach(session('cardTable') as $key => $details)--}}
                @foreach(session('table-'.$id) as $key => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $key }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                     width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9 cardName">
                                <h5 class="nomargin" style="color: white;font-size: 13px" >{{ $details['name_product'] }}</h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" style="color: white">{{ number_format($details['price']) }} VND</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center" style="color: white">{{ number_format($details['price'] * $details['quantity']) }}VND</td>
                    <td class="actions" data-th="">
                        <button data-id-delete="{{$key}}" class="btn btn-danger btn-sm remove-from-cart" data-delete="{{route('bread.removeCard')}}"><i class="fa fa-trash-o"></i></button>
                    </td>
                    <td>
                        <button data-id="{{$key}}" class="btn btn-info update_card" data-url="{{route('bread.updateCardTable')}}">update</button>
                    </td>
                </tr>
            @endforeach
{{--        @else--}}
{{--            <p style="color: red;margin-top: 20px;text-align: center">không có sản phẩm nào trong giỏ hàng</p>--}}
{{--        @endif--}}
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total) }} VND</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/bread/tableList') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
{{--                <button class="btn btn-success">Checkout</button>--}}
                @if($resultTable['status_order'] == 2)
                <a href="" class="btn btn-success" type="button" data-urlPay="{{route('bread.paymentOneTable',['idTable' => $id])}}" id="payment">Checkout</a>
                @else
                    <a href="" class="btn btn-success" type="button" data-urlPay="{{route('bread.paymentOneTable',['idTable' => $id])}}" style="display: none">Checkout</a>
                @endif

            </td>
        </tr>
        </tfoot>
    </table>
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
        $(".addCard").on('click', function (e) {
            e.preventDefault();
            var idProduct  = $(this).attr('data-idProduct');
            var idTable  = $(this).attr('data-idTable');
            var url = $(this).data('url');
            console.log(idProduct,idTable)
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    idProduct: idProduct,
                    idTable : idTable
                },
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
            });
        })

        $('.update_card').on('click', function (e) {
            e.preventDefault()
            var url = $(this).data('url')
            var id = $(this).data('id')
            var quantity = $(this).parents('tr').find('input.quantity').val()
            console.log(id,quantity)
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

        $('.remove-from-cart').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('delete');
            var id = $(this).data('id-delete')
            console.log(id, url)
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

        $('#payment').on('click',function (e) {
            e.preventDefault();
            var urlPay = $(this).attr('data-urlPay');
            console.log(urlPay)
            $.ajax({
                type: "GET",
                url: urlPay,
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {
                        alert('thanh toán thành công');
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.href='{{route('bread.tableList')}}';
                        }, 500);
                    }
                },
                error: function (data) {
                    console.log(data)
                    alert('them san pham that bai')
                }
            });
        })
    });

</script>
