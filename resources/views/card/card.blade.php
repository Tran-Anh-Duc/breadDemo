<title>card</title>
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
            @foreach(session('card') as $key => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $key }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                     width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin" style="color: white">{{ $details['name_product'] }}</h4>
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
                <button class="btn btn-success">Checkout</button>
            </td>
        </tr>
        </tfoot>
    </table>
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
    });
</script>

