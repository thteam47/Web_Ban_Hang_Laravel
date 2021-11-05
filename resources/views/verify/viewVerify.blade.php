<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Verify Account</title>
</head>
<style type="text/css" media="screen">
    body{
        font-family: 'Roboto', sans-serif;
        font-size: 100%;
        overflow-x: hidden;
        background: url({{ asset('public/theme_admin/images/bg.jpg') }}) no-repeat 0px 0px;
        background-size:cover;
    }
    li {
        font-size: 20px;
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
                <div class="col-md-6 col-md-offset-3" style="top: 100px;">
                    <div class="text-center">
                        <img src="{{ asset('public/theme_fontend/img/profile/avatar1.png') }}"  width="180" class="img-thumbnail logo img-circle">
                        <div>
                            <h3 class="text-center">Verify Account</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            $message = Session::get('error');
                            if ($message){
                                echo '<p class="alert alert-danger" style="font-size: 20px;">',$message ,'</p>';
                                Session::put('error',null);
                            }
                            ?>
                            <?php
                            $message = Session::get('message');
                            if ($message){
                                echo '<p class="alert alert-success" style="color: blue;font-size: 20px;">',$message ,'</p>';
                                Session::put('error',null);
                            }
                            ?>
                            <div class="main-verification-input-wrap">
                                <ul>
                                    <li>You will recieve a verification code on your mail after you registered. Click on button.</li>
                                    <li>If somehow, you did not recieve the verification email then <a href="{{ route('Reverifyemail') }}">resend the verification email</a></li>
                                </ul>
                                
                            </div>
                            <a class="btn btn-primary" style="font-size: 18px;" href="{{ route('home') }}">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>