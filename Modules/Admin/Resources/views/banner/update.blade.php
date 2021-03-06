@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.get.list.banner') }}">Danh mục ảnh bìa</a></li>
			<li class="breadcrumb-item active" aria-current="page">Thêm ảnh bìa</li>
		</ol>
	</div>
	
</div>

<div class="row">
	
	<div class="col-lg-12">

		<section class="panel">
			<header class="panel-heading">
				Thêm ảnh bìa
			</header>
			<div class="panel-body">
				<form role="form" action="" enctype="multipart/form-data"  method="POST" class="form-horizontal ">
					@csrf								
					<div class="form-group has-success anh">
						<label class="col-lg-3 control-label">Ảnh bìa</label>
						<div class="col-lg-6">
							<input id="img" type="file" name="imgBan" class="form-control hidden" onchange="changeImg(this)">
							<img id="avatar" style="cursor: pointer;" class="thumbnail" width="200px" src="{{asset('storage/app/banImg/'.$ban->ban_img)  }}">
						</div>
					</div>
					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Liên kết tới trang:</label>
						<div class="col-lg-6">
							<input type="text" required placeholder="fa fa-home" name="link" value="{{ $ban->ban_link }}" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">
							<button class="btn btn-success" type="submit">Thêm ảnh bìa</button>
						</div>
					</div>

				</form>
			</div>

		</section>
	</div>
</div>
<script>
	function changeImg(input){
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		    if(input.files && input.files[0]){
		    	var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#avatar').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(document).ready(function() {
			$('#avatar').click(function(){
				$('#img').click();
			});
		});
	</script>
	@stop