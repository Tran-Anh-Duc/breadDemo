<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bread Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');
        white-space: nowrap;
        background-size: cover;
    }
</style>
<body>
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Mã đơn hàng: <span
                                    style="color: #a8729a;">{{$findOneBill['user']}}</span>!</h5>

                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Tên khách hàng: {{$findOneBill['created_by']}}</p>
                                <p class="small text-muted mb-0">Áp dụng giảm giá : {{$findOneBill['coupon']}}</p>
                            </div>
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                     @php $sumTotal = 0 @endphp
                                    @foreach($showBill as $key => $value)
                                    @php $sumTotal += $value->price * $value->total @endphp
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                                class="img-fluid" alt="Phone">
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">{{$value->name_product}}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Đã xem : 100</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Số lượng : {{$value->total}}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">{{!empty($value->price) ? number_format($value->price) : '0'}}
                                                VND</p>
                                        </div>
                                    </div>
                                        <br>
                                    @endforeach
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <td colspan="5" class="text-right"><h3><strong>Tổng tiền: {{ number_format($sumTotal) }} VND</strong></h3></td>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('list')}}" style="" type="button" class="btn btn-success"
                        id="saveBill" data-id="{{$id}}" data-save-bill="{{route('bread.update_store',['id' => $id])}}">Lưu</a>
                        <a href="#" style="" type="button" class="btn btn-danger" id="btnDele" data-id="{{$findOneBill['id']}}" data-delete="{{route('bread.delete_bill',['bill_id' => $findOneBill['id']])}}" >Hủy phiếu thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var csrf = "{{ csrf_token() }}";
    $(document).ready(function () {
        $('#btnDele').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-delete');
            var bill_id = $(this).attr('data-id');
            console.log(bill_id)
            if (confirm('Bạn chắc chắn muốn hủy phiếu thanh toán này')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: bill_id
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status == 200) {
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.href = '{{route('list')}}';
                            }, 2500);
                        } else {
                            $('#errorModal').modal('show');
                            $('.msg_error').text(data.message);
                        }
                    },
                    error: function (data) {
                        alert('delete errors')
                    }
                })
            }
        })

        $('#saveBill').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-save-bill')
            var id = $(this).attr('data-id')
            console.log(url, id)
            if (confirm('Bạn chắc chắn muốn hủy phiếu thanh toán này')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status == 200) {
                            $('#successModal').modal('show');
                            $('.msg_success').text(data.message);
                            window.scrollTo(0, 0);
                            setTimeout(function () {
                                window.location.href = '{{route('list')}}';
                            }, 2500);
                        } else {
                            $('#errorModal').modal('show');
                            $('.msg_error').text(data.message);
                        }
                    },
                    error: function (data) {
                        alert('delete errors')
                    }
                })
            }
        })
    })
</script>
