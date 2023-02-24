<title>detail</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    body{
        background-image: url('https://images01.nicepagecdn.com/page/67/56/ website-template-preview-67567.jpg');
        white-space: nowrap;
        background-size:cover;
    }
</style>
<body>
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Chi tiết sản phẩm, <span
                                    style="color: #a8729a;">{{$result['name_product']}}</span>!</h5>

                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Thông tin</p>
                                <p class="small text-muted mb-0">Áp dụng giảm giá : Không có chương trình</p>
                            </div>
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img
                                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                                class="img-fluid" alt="Phone">
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">{{$result['name_product']}}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Đã xem : 100</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Tồn kho : 100</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">{{!empty($result['price']) ? number_format($result['price']) : '0'}}
                                                VND</p>
                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center" style="padding-top: 50px">
                                        <div class="col-md-2">
                                            <p class="text-muted mb-0 small" style="font-size: 20px;color:black;">Mô tả chi
                                                tiết sản phẩm:</p>
                                            <textarea
                                                style="width: 750px;height: auto" disabled>{{$result['product_description']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('list')}}" style="" type="button" class="btn btn-success">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>



