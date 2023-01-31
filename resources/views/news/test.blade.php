@extends('home')
@section('title','test upload image')
@section('style')
    <style>
       /*html, body {*/
       /*    background-color: #fff;*/
       /*    color: #636b6f;*/
       /*    font-family: 'Nunito', sans-serif;*/
       /*    font-weight: 200;*/
       /*    height: 100vh;*/
       /*    margin: 0;*/
       /*}*/

       .full-height {
           height: 100vh;
       }

       .flex-center {
           align-items: center;
           display: flex;
           justify-content: center;
       }

       .position-ref {
           position: relative;
       }

       .top-right {
           position: absolute;
           right: 10px;
           top: 18px;
       }

       .content {
           text-align: center;
       }

       .title {
           font-size: 84px;
       }

       .links > a {
           color: #636b6f;
           padding: 0 25px;
           font-size: 13px;
           font-weight: 600;
           letter-spacing: .1rem;
           text-decoration: none;
           text-transform: uppercase;
       }

       .m-b-md {
           margin-bottom: 30px;
       }
   </style>
@endsection
@section('content')
    <div class="flex-center position-ref full-height">
   <div class="content">
       <div class="title m-b-md">
           Welcome Optimizer Photo
       </div>
       <div class="links">
{{--           <form action="{{route('news.uploadImage')}}" method="POST" enctype="multipart/form-data">--}}
               @csrf
               <div class="row">

                   <div class="col-md-6">
                       <input type="file" name="image" class="form-control submitImage" id="submitImage">
                   </div>

                   <div class="col-md-6">
                       <button type="submit" class="btn btn-success" id="submitImage1">Upload a File</button>
                   </div>

               </div>
{{--           </form>--}}
       </div>
   </div>
</div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submitImage1').on('click',function () {
             var image = $("input[name='image']").val();
             var formData = new FormData();
             formData.append('image',image);
             console.log(image);
            $.ajax({
                url: '{{route('news.uploadImage')}}',
                type: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                beforeSend: function () {
                    $(".theloading").show();
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#successModal').modal('show');
                        $('.msg_success').text(data.message);
                        // window.scrollTo(0, 0);
                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 2500);
                    } else {
                        $('#errorModal').modal('show');
                        $('.msg_error').text(data.message);
                    }
                },
                error: function (data) {
                    console.log(data);
                    $(".theloading").hide();
                }
            })
        })


     </script>

@endsection
