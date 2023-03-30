<title>table</title>
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
                            <p class="card-text text"><a href="" class="btn btn-primary"
                            style="text-align: center;text-overflow: clip;width: 120px">{{$value['name_product']}}</a></p>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col col-6 box2">
        </div>


    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

