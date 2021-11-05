
<!DOCTYPE html>
<head>
    <title>Trang quản lý Admin Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/theme_admin/css/bootstrap.min.css') }}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/theme_admin/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/theme_admin/css/style-responsive.css') }}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/theme_admin/css/font.css') }}" type="text/css"/>
    <link href="{{asset('public/theme_admin/css/font-awesome.css') }}" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <script src="{{asset('public/theme_admin/js/jquery2.0.3.min.j') }}s"></script>
</head>
<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Register</h2>
            <?php
            $message = Session::get('error');
            if ($message){
            echo '<p class="alert alert-danger" style="color: red;">',$message ,'</p>';
            Session::put('error',null);
            }
            $succes = Session::get('succes');
            if ($succes){
            echo '<p class="alert alert-danger" style="color: green;">',$succes ,'</p>';
            Session::put('succes',null);
            }
        ?>
        <form method="POST"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <input type="text" class="ggg" name="name" value="{{ old('name') }}" placeholder="Fullname" >
            @if($errors->has('name'))
            <p class="help-block "style= "color:red">{{ $errors->first('name') }}</p>
            @endif
            <input type="text" class="ggg" name="email" value="{{ old('email') }}" placeholder="Email" >
            @if($errors->has('email'))
            <p class="help-block "style= "color:red">{{ $errors->first('email') }}</p>
            @endif
            <input type="text" class="ggg" name="username" value="{{ old('username') }}" placeholder="Username" >
            @if($errors->has('username'))
            <p class="help-block "style= "color:red">{{ $errors->first('username') }}</p>
            @endif
            <input type="text" class="ggg" name="phone" value="{{ old('phone') }}" placeholder="Phone" >
            @if($errors->has('phone'))
            <p class="help-block "style= "color:red">{{ $errors->first('phone') }}</p>
            @endif
            <input type="password" class="ggg" name="password" placeholder="Password" >
            @if($errors->has('password'))
            <p class="help-block "style= "color:red">{{ $errors->first('password') }}</p>
            @endif
            <input type="password" class="ggg" name="repassword" placeholder="Repeat Password" >
            @if($errors->has('repassword'))
            <p class="help-block "style= "color:red">{{ $errors->first('repassword') }}</p>
            @endif
            <div class="clearfix"></div>
            <input type="submit" value="Register" name="login">
        </form>
        <p>Do you already have an account ?<a href="">Login</a></p>
    </div>
</div>
<script src="{{asset ('public/theme_admin/js/bootstrap.js') }}"></script>
<script src="{{asset ('public/theme_admin/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{asset ('public/theme_admin/js/scripts.js') }}"></script>
<script src="{{asset ('public/theme_admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{asset ('public/theme_admin/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset ('public/theme_admin/js/jquery.scrollTo.js') }}"></script>
</body>
</html>
