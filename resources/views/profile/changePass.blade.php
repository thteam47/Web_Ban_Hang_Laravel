<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/theme_fontend/css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('public/theme_fontend/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/theme_fontend/js/js-zoom_image.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('public/theme_fontend/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Change Password</title>
</head>
<style type="text/css" media="screen">
    body{
        font-family: 'Roboto', sans-serif;
        font-size: 100%;
        overflow-x: hidden;
        background: url({{ asset('public/theme_admin/images/bg.jpg') }}) no-repeat 0px 0px;
        background-size:cover;
    }    
    
    .separator {
        border-right: 1px solid #dfdfe0; 
    }
    .input-group {
        margin-bottom:10px; 
    }
    .pass_show{position: relative
        height: 100%;} 
        .pass_show .ptxt { 

            font-size: 16px;
            width: 50px;
            position: absolute; 
            top: 50%; 
            right: 20px; 
            z-index: 1; 
            color: blue; 
            margin-top: -10px; 
            cursor: pointer; 
            transition: .3s ease all; 
            z-index: 999;
        } 
        .pass_show .ptxt:hover{color: #333333;} 
    </style>
    <script>
        $(document).ready(function(){
            $('.pass_show').append('<span class="ptxt">Show</span>');  
        });
        $(document).on('click','.pass_show .ptxt', function(){ 

            $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

            $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
        });
    </script>
    <body>
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel panel-info" style="margin-top: 100px;">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align: center;">
                                <span class="glyphicon glyphicon-th"></span>
                                Change password   
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                                    <img alt="" class="img-thumbnail" style="margin: 100px;" src="{{ asset('public/theme_fontend/img/profile/avatar1.png') }}">                        
                                </div>
                                <div style="margin-top:100px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
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
                                            echo '<p class="alert alert-success" style="color: blue; font-size: 20px;">',$message ,'</p>';
                                            Session::put('error',null);
                                        }
                                        ?>
                                        <form method="POST"  enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon input-lg"><span class="glyphicon glyphicon-lock"></span></div>
                                                    <div class="pass_show">
                                                        <input class="form-control input-lg" type="password" placeholder="Current Password" name="currentpass" > 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon input-lg"><span class="glyphicon glyphicon-log-in"></span></div>
                                                    <div class="pass_show">
                                                        <input class="form-control input-lg pass_show" type="password" placeholder="New Password" name="newpass" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon input-lg"><span class="glyphicon glyphicon-log-in"></span></div>
                                                    <div class="pass_show">
                                                        <input class="form-control input-lg pass_show" type="password" placeholder="Repeat Password" name="repass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="CHANGE PASSWORD">
                                        </form>
                                        <p style="margin-top:  20px;text-align: center; font-size: 20px;">Return Profile? <a href="{{ route('profile') }}">Click here!</a></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>