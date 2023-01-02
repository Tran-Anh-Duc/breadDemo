<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container-sm">
        <table id="cart" class="table table-hover table-condensed list_card">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            @php $total = 0 @endphp
            @foreach(session('card') as $key => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $key }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                     width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name_product'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{ number_format($details['price']) }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($details['price'] * $details['quantity']) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                    <td>
                        <button data-id="{{$key}}" class="btn btn-info update_card" data-url="{{route('bread.updateCard')}}">update</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total) }}</strong></h3></td>
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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

         $('.update_card').on('click',function (e) {
                e.preventDefault()
                var url = $(this).data('url')
                var id = $(this).data('id')
                var quantity = $(this).parents('tr').find('input.quantity').val()
                $.ajax({
                    type:"GET",
                    url:url,
                    data:{
                        id:id,
                        quantity:quantity
                    },
                    success:function (data) {
                        console.log(data)
                        if(data.status == 200){
                            $('.list_card').html(data.data)
                            alert('update card success')
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        }
                    },
                    error:function (data) {
                        alert('update errors')
                    }
                })
         })
        });
     </script>

