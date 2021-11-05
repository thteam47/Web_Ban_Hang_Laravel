<form method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="submit" value="Đăng nhập" name="login">
</form>
<form method="POST" enctype="multipart/form-data">
    @csrf
    <input type="submit" value="Đăng nhập" name="login">
</form>