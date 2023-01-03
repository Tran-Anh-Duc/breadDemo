<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    * {
        margin: 0px auto;
        padding: 0px;
        font-family: 'Open Sans', sans-serif;
    }
    .cont_principal {
        position: absolute;
        width: 100%;
        height: 100%;
        /* Rectangle 3: */
        background-image: linear-gradient(-87deg, #F2F5F6 0%, #DDE5E8 100%);
    }

    .cont_centrar {
        position: absolute;
        width: 320px;
        left:50%;
        top:50%;
        margin-left: -160px;
        margin-top: -160px;
    }

    .cont_centrar {
        position: relative;
        width: 320px;
        float: left;
        background-image: linear-gradient(-226deg, #FFFFFF 8%, #EEF3F5 100%);

        border-radius: 8px;
        transition: all 0.5s;
    }

    .cent_active {
        box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.21);
    }


    .cont_tabs_login {
        position: relative;
        float: left;
        width: 100%;
    }

    .ul_tabs > li {
        position: relative;
        float: left;
        width: 50%;
        list-style: none;
        text-align: center;

    }

    .ul_tabs > li > a  {
        text-decoration: none;
        font-family: Helvetica;
        font-size: 16px;
        color: #999;
        line-height: 14px;
        padding: 20px ;
        display: block;
        transition: all 0.5s;
    }

    .ul_tabs > .active > a  {
        color: #FF8383;

    }

    .linea_bajo_nom {
        position: relative;
        width: 100%;
        float: left;
        background-color: #999;
        height: 2px;
    }

    .active .linea_bajo_nom {
        position: relative;
        width: 100%;
        float: left;
        background-color: #FF8383;
        height: 2px;
    }

    .cont_text_inputs {
        position: relative;
        float: left;
        width: 100%;
        margin-top: 20px;
    }

    .input_form_sign {
        position: relative;
        float: left;
        width: 90%;
        border: none;
        border-bottom: 1px solid #B0BEC5 ;
        background-color: transparent;
        font-size: 14px;
        outline: none;
        transition: all 0.5s;
        height: 0px;
        margin: 0px;
        padding: 0px;
        opacity: 0;
        display: none;
    }

    .active_inp {
        margin: 5% 5% ;
        padding: 10px 0px;
        opacity: 1;
        height: 5px;
    }



    .input_form_sign:focus {
        border-bottom: 1px solid #FF8383 ;}

    .link_forgot_pass {
        position: relative;
        margin-top: 0px;
        margin-left: 30%;
        text-decoration: none;
        color: #999;
        font-size: 13px;
        display: none;
        float: left;
        transition: all 0.5s;
    }
    .cont_btn {
        position: relative;
        float: left;
    }

    .btn_sign {
        background: rgba(255,64,88,0.74);
        box-shadow: 0px 2px 20px 2px rgba(255,114,132,0.50);
        border-radius: 8px;
        padding: 15px 30px;
        border: none;
        color: #fff;
        font-size: 14px;
        position: relative;
        float: left;
        margin-left: 100px;
        margin-top: 20px;
        margin-bottom: 20px;
        cursor: pointer;
    }

    .terms_and_cons {
        width: 70%;
        color: #999;
        font-size: 13px;
        transition: all 0.5s;
    }

    .d_none {
        display: none;
    }

    .d_block {
        display: block;
    }

    .cont_text_inputs > input:nth-child(1){
        transition-delay: 0.2s;
    }

    .cont_text_inputs > input:nth-child(2){
        transition-delay: 0.4s;
    }
    .cont_text_inputs > input:nth-child(3){
        transition-delay: 0.6s;
    }
    .cont_text_inputs > input:nth-child(4){
        transition-delay: 0.8s;
    }
</style>
<div class="cont_principal">

    <div class="cont_centrar">
        <div class="cont_login">
            <form action="">
                <div class="cont_tabs_login">
                    <ul class='ul_tabs'>
                        <li class="active"><a href="#" onclick="sign_in()">SIGN IN</a>
                            <span class="linea_bajo_nom"></span>
                        </li>
                        <li><a href="#up" onclick="sign_up()" >SIGN UP</a><span class="linea_bajo_nom"></span>
                        </li>
                    </ul>
                </div>
                <div class="cont_text_inputs">
                    <input type="text" class="input_form_sign name" placeholder="NAME" name="name" id="name"/>

                    <input type="text" class="input_form_sign d_block active_inp email" placeholder="EMAIL" name="email" id="email" />

                    <input type="password" class="input_form_sign d_block  active_inp password" placeholder="PASSWORD" name="password"  id="password"/>
                    <input type="password" class="input_form_sign" placeholder="CONFIRM PASSWORD" name="conf_pass_us" />

                    <a href="#" class="link_forgot_pass d_block">Forgot Password ?</a>
                    <div class="terms_and_cons d_none">
                        <p><input type="checkbox" name="terms_and_cons" /> <label for="terms_and_cons">Accept Terms and Conditions.</label></p>

                    </div>
                </div>
                <div class="cont_btn row">
                    <div class="col-6 ">
                        <button style="width: 130px;margin-left: 50px;right: 50px" class="btn_sign " id="sign_up">SIGN IN</button>
                    </div>
                    <div class="col-6">
                        <button style="width: 130px;margin: 20px 20px 20px 20px;right: 5px" class="btn_sign sign_in" id="sign_in">Log In</button>
                    </div>

                </div>

            </form>
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
                {{--            <a id="redirect-url" class="btn btn-success">Xem</a>--}}
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function sign_up(){
        var inputs = document.querySelectorAll('.input_form_sign');
        document.querySelectorAll('.ul_tabs > li')[0].className="";
        document.querySelectorAll('.ul_tabs > li')[1].className="active";

        for(var i = 0; i < inputs.length ; i++  ) {
            if(i == 2  ){

            }else{
                document.querySelectorAll('.input_form_sign')[i].className = "input_form_sign d_block";
            }
        }

        setTimeout( function(){
            for(var d = 0; d < inputs.length ; d++  ) {
                document.querySelectorAll('.input_form_sign')[d].className = "input_form_sign d_block active_inp";
            }


        },100 );
        document.querySelector('.link_forgot_pass').style.opacity = "0";
        document.querySelector('.link_forgot_pass').style.top = "-5px";
        document.querySelector('.btn_sign').innerHTML = "SIGN UP";
        setTimeout(function(){

            document.querySelector('.terms_and_cons').style.opacity = "1";
            document.querySelector('.terms_and_cons').style.top = "5px";

        },500);
        setTimeout(function(){
            document.querySelector('.link_forgot_pass').className = "link_forgot_pass d_none";
            document.querySelector('.terms_and_cons').className = "terms_and_cons d_block";
        },450);

    }



    function sign_in(){
        var inputs = document.querySelectorAll('.input_form_sign');
        document.querySelectorAll('.ul_tabs > li')[0].className = "active";
        document.querySelectorAll('.ul_tabs > li')[1].className = "";

        for(var i = 0; i < inputs.length ; i++  ) {
            switch(i) {
                case 1:
                    console.log(inputs[i].name);
                    break;
                case 2:
                    console.log(inputs[i].name);
                default:
                    document.querySelectorAll('.input_form_sign')[i].className = "input_form_sign d_block";
            }
        }

        setTimeout( function(){
            for(var d = 0; d < inputs.length ; d++  ) {
                switch(d) {
                    case 1:
                        console.log(inputs[d].name);
                        break;
                    case 2:
                        console.log(inputs[d].name);

                    default:
                        document.querySelectorAll('.input_form_sign')[d].className = "input_form_sign d_block";
                        document.querySelectorAll('.input_form_sign')[2].className = "input_form_sign d_block active_inp";

                }
            }
        },100 );

        document.querySelector('.terms_and_cons').style.opacity = "0";
        document.querySelector('.terms_and_cons').style.top = "-5px";

        setTimeout(function(){
            document.querySelector('.terms_and_cons').className = "terms_and_cons d_none";
            document.querySelector('.link_forgot_pass').className = "link_forgot_pass d_block";

        },500);

        setTimeout(function(){

            document.querySelector('.link_forgot_pass').style.opacity = "1";
            document.querySelector('.link_forgot_pass').style.top = "5px";


            for(var d = 0; d < inputs.length ; d++  ) {

                switch(d) {
                    case 1:
                        console.log(inputs[d].name);
                        break;
                    case 2:
                        console.log(inputs[d].name);

                        break;
                    default:
                        document.querySelectorAll('.input_form_sign')[d].className = "input_form_sign";
                }
            }
        },1500);
        document.querySelector('.btn_sign').innerHTML = "SIGN IN";
    }


    window.onload =function(){
        document.querySelector('.cont_centrar').className = "cont_centrar cent_active";

    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#sign_up').on('click', function (e) {
            e.preventDefault();
            var name = $("input[name='name']").val();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password)
            console.log(name, email, password)
            $.ajax({
                url: '{{route('bread.register')}}',
                type: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(".theloading").show();
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#successModal').modal('show');
                        $('.msg_success').text(data.message);
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.href = "{{route('bread.viewLogin')}}";
                        }, 2500);
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

        $('#sign_in').on('click', function (e) {
            e.preventDefault();
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            var formData = new FormData();
            formData.append('email', email);
            formData.append('password', password)
            console.log(email,password)
            $.ajax({
                url: '{{route('bread.login')}}',
                type: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(".theloading").show();
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#successModal').modal('show');
                        $('.msg_success').text(data.message);
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.href = "{{route('list')}}";
                        }, 500);
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
        });
    })
</script>
