<title>table</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
  .box1{
    width: 50%;
    height: 900px;
    background-color: #685353;
  
  }
  .box2{
    width: 50%;
    height: 900px;
    background-color: #4e4e99;
  }
       
</style>
<body style="background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');white-space: nowrap;background-size:cover;">

<div class="" style="display: grid;">
    <div class="row">
    <div class="col col-6 box1" style="">
        
    </div>
    <div class="col col-6 box2" style="">
        
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
