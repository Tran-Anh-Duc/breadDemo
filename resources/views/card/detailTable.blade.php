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
                        <img class="card-img-top" src="{{$value['image']}}" alt="Card image cap" style="width: 100%;height: 90px">
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
                <div class="pagination d-felx justify-content-right" style="margin-top: 600px">
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
                        </tr>
                    </thead>
                    <tbody>
                            @if(!empty($cardTable))
                                <?php $a = 0 ?>
                                @foreach($cardTable as $key => $value)
                                    <tr id="cradBox" data-id="{{$a++}}" class="block">
                                        <td style="text-align: center">{{$a}}</td>
{{--                                        <td style="text-align: center" hidden  class="valuePr">{{$value['idProduct']}}</td>--}}
                                        <td style="text-align: center">{{$value['name_product']}}</td>
                                        <td style="text-align: center">{{number_format($value['price'])}} :VND</td>
                                        <td style="text-align: center">
                                        <input type="number" value="{{$value['quantity']}}" name="quantity" id="quantity" style="width: 50px;text-align: center"></td>
                                        <td><input hidden type="text" value="{{$value['idProduct']}}" name="idCard" id="idCard" style="width: 50px;text-align: center" /></td>

                                    </tr>
                                @endforeach
                            @else
                                <span style="color: red">Chưa có sản phẩm nào hết !!!</span>
                            @endif
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td><a href="" class="btn btn-info saveUpdate" id="saveUpdate" data-url-update="{{route('bread.updateCardTable',['idTable' =>$idTable])}}">Cập nhật</a></td>
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
        })
    })

</script>

{{--[--}}
{{--{--}}
{{--"id": 5,--}}
{{--"quantity": 4--}}
{{--},--}}
{{--{--}}
{{--"id": 6,--}}
{{--"quantity": 92--}}
{{--}--}}
{{--]--}}
