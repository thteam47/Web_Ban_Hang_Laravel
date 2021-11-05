<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Forgot Password</title>
</head>
<style type="text/css" media="screen">
    body{
        font-family: 'Roboto', sans-serif;
        font-size: 100%;
        overflow-x: hidden;
        background: url({{ asset('public/theme_admin/images/bg.jpg') }}) no-repeat 0px 0px;
        background-size:cover;
    }
    
    .img-thumbnail{
        border:0px;    
    }
    .btn, .input-lg, .alert {border-radius:1px !important;}
</style>
<body>
    <div class="container bootstrap snippets bootdey" >
        <div class="row" >
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="top: 100px;">
                    <div class="text-center">
                        <img src="{{ asset('public/theme_fontend/img/profile/avatar1.png') }}"  width="180" class="img-thumbnail logo img-circle">
                        <div>
                            <h3 class="text-center">Forgot password?</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('error');
                            if ($message){
                            echo '<p class="alert alert-danger" style="font-size: 20px;">',$message ,'</p>';
                            Session::put('error',null);
                        }
                        ?>

                        <form method="POST"  enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="text" value="<?php if(Session::get('email')) echo Session::get('email');?>">
                            </div>
                            <div class="clearfix"></div>
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="SEND ME PASSWORD">
                        </form>
                        <p style="margin-top:  20px; font-size: 20px;">Try again? <a href="{{ route('loginUser') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>