<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style type="text/css">

            *, *:before, *:after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html, body {
                font-size: 62.5%;
                height: 100%;
                overflow: hidden;
            }
            @media (max-width: 768px) {
                html, body {
                    font-size: 50%;
                }
            }

            svg {
                display: inline-block;
                width: 2rem;
                height: 2rem;
                overflow: visible;
            }

            .svg-icon {
                cursor: pointer;
            }
            .svg-icon path {
                stroke: rgba(255, 255, 255, 0.9);
                fill: none;
                stroke-width: 1;
            }

            input, button {
                outline: none;
                border: none;
            }

            .cont {
                position: relative;
                height: 100%;
                background-image: url("http://www.wallpaperup.com/uploads/wallpapers/2014/12/22/562818/153de0fa3da7066b6261ca573bbe1e06.jpg");
                background-size: cover;
                overflow: auto;
                font-family: "Cabin", Helvetica, Arial, sans-serif;
            }

            .demo {
                position: absolute;
                top: 50%;
                left: 50%;
                margin-left: -15rem;
                margin-top: -26.5rem;
                width: 30rem;
                height: 53rem;
                overflow: hidden;
            }

            .login {
                position: relative;
                height: 100%;
                background: -webkit-linear-gradient(top, rgba(146, 135, 187, 0.9) 0%, rgba(0, 0, 0, 0.7) 100%);
                background: linear-gradient(to bottom, rgba(146, 135, 187, 0.9) 0%, rgba(0, 0, 0, 0.7) 100%);
                -webkit-transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25), -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
            .login.inactive {
                opacity: 0;
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }
            .login__check {
                position: absolute;
                top: 16rem;
                left: 13.5rem;
                width: 14rem;
                height: 2.8rem;
                background: #fff;
                -webkit-transform-origin: 0 100%;
                transform-origin: 0 100%;
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }
            .login__check:before {
                content: "";
                position: absolute;
                left: 0;
                bottom: 100%;
                width: 2.8rem;
                height: 5.2rem;
                background: #fff;
                box-shadow: inset -0.2rem -2rem 2rem rgba(0, 0, 0, 0.2);
            }
            .login__form {
                position: absolute;
                top: 40%;
                left: 0;
                width: 100%;
                height: 55%;
                padding: 1.5rem 2.5rem;
                text-align: center;
            }
            .login__row {
                height: 5rem;
                padding-top: 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }
            .login__icon {
                margin-bottom: -0.4rem;
                margin-right: 0.5rem;
            }
            .login__icon.name path {
                stroke-dasharray: 73.50196075439453;
                stroke-dashoffset: 73.50196075439453;
                -webkit-animation: animatePath 2s 0.5s forwards;
                animation: animatePath 2s 0.5s forwards;
            }
            .login__icon.pass path {
                stroke-dasharray: 92.10662841796875;
                stroke-dashoffset: 92.10662841796875;
                -webkit-animation: animatePath 2s 0.5s forwards;
                animation: animatePath 2s 0.5s forwards;
            }
            .login__input {
                display: inline-block;
                width: 22rem;
                height: 100%;
                padding-left: 1.5rem;
                font-size: 1.5rem;
                background: transparent;
                color: #FDFCFD !important;
            }
            .login__submit {
                position: relative;
                width: 100%;
                height: 4rem;
                margin: 2rem 0 2.2rem;
                color: rgba(255, 255, 255, 0.8);
                background: #0DA8CF;
                font-size: 1.5rem;
                border-radius: 3rem;
                cursor: pointer;
                overflow: hidden;
                -webkit-transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
                transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
            }
            .login__submit:after {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                margin-left: -1.5rem;
                margin-top: -1.5rem;
                width: 3rem;
                height: 3rem;
                border: 2px dotted #fff;
                border-radius: 50%;
                border-left: none;
                border-bottom: none;
                -webkit-transition: opacity 0.1s 0.4s;
                transition: opacity 0.1s 0.4s;
                opacity: 0;
            }
            .login__submit.processing {
                width: 4rem;
                font-size: 0;
            }
            .login__submit.processing:after {
                opacity: 1;
                -webkit-animation: rotate 0.5s 0.4s infinite linear;
                animation: rotate 0.5s 0.4s infinite linear;
            }
            .login__submit.success {
                -webkit-transition: opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
                transition: opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
                transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s;
                transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
                -webkit-transform: scale(30);
                transform: scale(30);
                opacity: 0.9;
            }
            .login__submit.success:after {
                -webkit-transition: opacity 0.1s 0s;
                transition: opacity 0.1s 0s;
                opacity: 0;
                -webkit-animation: none;
                animation: none;
            }
            .login__signup {
                font-size: 1.2rem;
                color: #ABA8AE;
            }
            .login__signup a {
                color: #fff;
                cursor: pointer;
            }

            .ripple {
                position: absolute;
                width: 15rem;
                height: 15rem;
                margin-left: -7.5rem;
                margin-top: -7.5rem;
                background: rgba(0, 0, 0, 0.4);
                -webkit-transform: scale(0);
                transform: scale(0);
                -webkit-animation: animRipple 0.4s;
                animation: animRipple 0.4s;
                border-radius: 50%;
            }

            @-webkit-keyframes animRipple {
                to {
                    -webkit-transform: scale(3.5);
                    transform: scale(3.5);
                    opacity: 0;
                }
            }

            @keyframes animRipple {
                to {
                    -webkit-transform: scale(3.5);
                    transform: scale(3.5);
                    opacity: 0;
                }
            }   
            @-webkit-keyframes rotate {
                to {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes rotate {
                to {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @-webkit-keyframes animatePath {
                to {
                    stroke-dashoffset: 0;
                }
            }
            @keyframes animatePath {
                to {
                    stroke-dashoffset: 0;
                }
            }

            .has-form-error{
                border-color: #2dc3e8 !important;
                stroke: #2dc3e8 !important;
            }

            .help-block{
                margin-bottom: 0px;
                color:#2dc3e8;
                font-size: 12px;
            }

            ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
                color:    #fff;
            }
            :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
               color:    #fff;
               opacity:  1;
            }
            ::-moz-placeholder { /* Mozilla Firefox 19+ */
               color:    #fff;
               opacity:  1;
            }
            :-ms-input-placeholder { /* Internet Explorer 10-11 */
               color:    #fff;
            }

    </style>
    </head>
    <body>
        <div class="cont">
            <div class="demo">
                <div class="login">
                    <img src="{{ asset('img/logo_white_2.png') }}" width="250px" style="display: block; margin:0 auto; padding-top: 75px">
                    <div class="login__form login_form">
                    {!! Form::open(['id' => 'login_form']) !!}
                        <div class="login__row" id="LoginFormEmailInput">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            {!! Form::email('email', null, ['class' => 'login__input', 'placeholder' => 'Email', 'id' => 'LoginEmailInput']) !!}
                        </div>
                        <span id="LoginFormEmailError" style="display: none;" class="help-block" style="font-size: 12px"></span>
                        <div class="login__row" id="LoginFormPasswordInput">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            {!! Form::password('password', ['class' => 'login__input pass', 'placeholder' => 'Password']) !!}
                        </div>
                        <span id="LoginFormPasswordError" style="display: none;" class="help-block" style="font-size: 12px"></span>
                        <div class="checkbox pull-left" style="font-size: 12px; color:rgba(255,255,255,0.5)">
                          <label><input style="background-color: transparent;" type="checkbox" name="remember" value="remember">Remember me?</label>
                        </div>
                        <button type="button" class="login__submit login_submit">Sign in</button>
                        <p class="login__signup">Don't have an account? &nbsp;<a>Sign up</a></p>
                    {!! Form::close() !!}
                    </div>
                    <div class="login__form register_form" style="display: none; top:35%">
                    {!! Form::open(['id' => 'register_form']) !!}
                        <div class="login__row" id="RegisterFormNameInput">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            {!! Form::text('name', null, ['class' => 'login__input', 'placeholder' => 'Name']) !!}
                        </div>
                        <span id="RegisterFormNameError" style="display: none;" class="help-block" style="font-size: 12px"></span>
                        <div class="login__row" id="RegisterFormEmailInput">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            {!! Form::email('email', null, ['class' => 'login__input', 'placeholder' => 'Email']) !!}
                        </div>
                        <span id="RegisterFormEmailError" style="display: none;" class="help-block" style="font-size: 12px"></span>
                        <div class="login__row" id="RegisterFormPasswordInput">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            {!! Form::password('password', ['class' => 'login__input pass', 'placeholder' => 'Password']) !!}
                        </div>
                        <span id="RegisterFormPasswordError" style="display: none;" class="help-block" style="font-size: 12px"></span>
                        <button type="button" class="login__submit register_submit">Sign up</button>
                        <p class="login__signup">Already have an account? &nbsp;<a>Sign in</a></p>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                
                $('.login__row').tooltip('show');


                var animating = false,
                submitPhase1 = 1100,
                submitPhase2 = 400,
                logoutPhase1 = 800,
                $login = $(".login"),
                $app = $(".app");

                function ripple(elem, e) {
                    $(".ripple").remove();
                    var elTop = elem.offset().top,
                    elLeft = elem.offset().left,
                    x = e.pageX - elLeft,
                    y = e.pageY - elTop;
                    var $ripple = $("<div class='ripple'></div>");
                    $ripple.css({top: y, left: x});
                    elem.append($ripple);
                };

                $(document).on("click", ".login__signup", function(e) {
                    if ($('.register_form').is(":visible")){
                        $('.register_form').hide();
                        $('.login_form').show();
                    } else {
                        $('.register_form').show();
                        $('.login_form').hide();
                    }
                });

                $(document).on("click", ".login_submit", function(e) {  
                    if (animating) return;
                    animating = true;
                    var that = this;
                    ripple($(that), e);
                    $(that).addClass("processing");

                    $.ajax({
                      type: "POST",
                      url: "{{ route('login.attempt') }}",
                      data: $('#login_form').serialize(),
                      dataType: 'JSON',
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      success: function(e){
                        var data = e;
                        if (data.success == true){
                          setTimeout(function() {
                              $(that).addClass("success");
                              setTimeout(function() {
                              }, submitPhase2 - 70);
                          }, location.reload());
                        } else {
                            $(that).removeClass("processing");
                            animating = false;
                        }
                      },
                      error: function(e){
                        var data = jQuery.parseJSON(e.responseText);
                        if (data.errors){
                          if (data.errors.email){
                            $("#LoginFormEmailError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' + data.errors.email);
                            $("#LoginFormEmailError").show();
                            $("#LoginFormEmailInput").addClass('has-form-error');
                            $("#LoginFormEmailInput svg path").addClass('has-form-error');
                          } else {
                            $("#LoginFormEmailError").hide();
                            $("#LoginFormEmailInput").removeClass('has-form-error');
                            $("#LoginFormEmailInput svg path").removeClass('has-form-error');
                          }
                            if (data.errors.password){
                              $("#LoginFormPasswordError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' + data.errors.password);
                              $("#LoginFormPasswordError").show();
                              $("#LoginFormPasswordInput").addClass('has-form-error');
                              $("#LoginFormPasswordInput svg path").addClass('has-form-error');
                            } else {
                              $("#LoginFormPasswordInput").removeClass('has-form-error');
                              $("#LoginFormPasswordInput svg path").removeClass('has-form-error');
                            }
                              if (data.errors.credentials){
                                $("#LoginFormPasswordInput").addClass('has-form-error');
                                $("#LoginFormPasswordInput svg path").addClass('has-form-error');
                                $("#LoginFormEmailInput").addClass('has-form-error');
                                $("#LoginFormEmailInput svg path").addClass('has-form-error');
                                $("#LoginFormPasswordError").show();
                                $("#LoginFormPasswordError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> Credentials do not match!');
                              }
                          $(that).removeClass("processing");
                          animating = false;
                        }
                      }
                    });
                });

                $(document).on("click", ".register_submit", function(e) {
                    if (animating) return;
                    animating = true;
                    var that = this;
                    ripple($(that), e);
                    $(that).addClass("processing");
                    $.ajax({
                      type: "POST",
                      url: "{{ route('register.attempt') }}",
                      data: $('#register_form').serialize(),
                      dataType: 'JSON',
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      success: function(e){
                        var data = e;
                        if (data.success == true){
                          setTimeout(function() {
                              $(that).addClass("success");
                              setTimeout(function() {
                              }, submitPhase2 - 70);
                          }, location.reload());
                        } else {
                            $(that).removeClass("processing");
                            animating = false;
                        }
                      },
                      error: function(e){
                        var data = jQuery.parseJSON(e.responseText);
                        if (data.errors){

                            if (data.errors.name){
                                $("#RegisterFormNameInput").addClass('has-form-error');
                                $("#RegisterFormNameInput svg path").addClass('has-form-error');
                                $("#RegisterFormNameError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' + data.errors.name);
                                $("#RegisterFormNameError").show();
                            } else {
                                $("#RegisterFormNameInput").removeClass('has-form-error');
                                $("#LoginFormEmailInput svg path").removeClass('has-form-error');
                                $("#LoginFormNameError").hide();
                            }

                            if (data.errors.email){
                                $("#RegisterFormEmailInput").addClass('has-form-error');
                                $("#RegisterFormEmailInput svg path").addClass('has-form-error');
                                $("#RegisterFormEmailError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' + data.errors.email);
                                $("#RegisterFormEmailError").show();
                            } else {
                                $("#RegisterFormEmailInput").removeClass('has-form-error');
                                $("#RegisterFormEmailInput svg path").removeClass('has-form-error');
                                $("#RegisterFormEmailError").hide();
                            }

                            if (data.errors.password){
                                $("#RegisterFormPasswordInput").addClass('has-form-error');
                                $("#RegisterFormPasswordInput svg path").addClass('has-form-error');
                                $("#RegisterFormPasswordError").html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> ' + data.errors.password);
                                $("#RegisterFormPasswordError").show();
                            } else {
                                $("#RegisterFormPasswordInput").removeClass('has-form-error');
                                $("#RegisterFormPasswordInput svg path").removeClass('has-form-error');
                                $("#RegisterFormPasswordError").hide();
                            }

                            $(that).removeClass("processing");
                            animating = false;
                        }
                      }
                    });
                });

                $(document).on("click", ".app__logout", function(e) {
                    if (animating) return;
                    $(".ripple").remove();
                    animating = true;
                    var that = this;
                    $(that).addClass("clicked");
                    setTimeout(function() {
                        $app.removeClass("active");
                        $login.show();
                        $login.css("top");
                        $login.removeClass("inactive");
                    }, logoutPhase1 - 120);
                    setTimeout(function() {
                        $app.hide();
                        animating = false;
                        $(that).removeClass("clicked");
                    }, logoutPhase1);
                });

            });
        </script>
    </body>
</html>
