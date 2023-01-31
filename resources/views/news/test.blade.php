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
           <form action="{{route('news.uploadImage')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">

                   <div class="col-md-6">
                       <input type="file" name="image" class="form-control">
                   </div>

                   <div class="col-md-6">
                       <button type="submit" class="btn btn-success">Upload a File</button>
                   </div>

               </div>
           </form>
       </div>
   </div>
</div>
@endsection
