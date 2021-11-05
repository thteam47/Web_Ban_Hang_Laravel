@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.get.list.product') }}">Danh mục sản phẩm</a></li>
			<li class="breadcrumb-item active" aria-current="page">Thêm danh mục sản phẩm</li>
		</ol>
	</div>
	
</div>

<div class="row">
	
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
				Thêm sản phẩm
			</header>
			<div class="panel-body">
				<form role="form" action="" method="POST" enctype="multipart/form-data" class="form-horizontal ">
					@csrf
					

					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Tên sản phẩm</label>
						<div class="col-lg-6">
							<input type="text" placeholder="Tên sản phẩm" name="p_name" value="{{old('p_name')}}" class="form-control">
							@if($errors->has('p_name'))
							<p class="help-block "style= "color:red">{{ $errors->first('p_name') }}</p>
							@endif
						</div>

					</div>
					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Giá sản phẩm</label>
						<div class="col-lg-6">
							<input type="number" placeholder="Giá sản phẩm" name="p_price" value="{{ old('p_price') }}" class="form-control">
							@if($errors->has('p_price'))
							<p class="help-block "style= "color:red">{{ $errors->first('p_price') }}</p>
							@endif

						</div>

					</div>
					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Giảm giá</label>
						<div class="col-lg-6">
							<input type="number" placeholder="Giảm giá" name="p_promotion" value="{{ old('p_promotion')}}" class="form-control">


						</div>

					</div>
					<div class="form-group has-success anh">
						<label class="col-lg-3 control-label">Ảnh sản phẩm</label>
						<div class="col-lg-6">
							<input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
							<img id="avatar" style="cursor: pointer;" class="thumbnail" width="200px" src="{{asset('public/theme_admin/img/new_seo-10-512.png')  }}">
						</div>
					</div>

					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Phụ kiện</label>
						<div class="col-lg-6">
							<input type="text" placeholder="Tên phụ kiện" name="p_accessories" value="{{ old('p_accessories') }}" class="form-control">
							@if($errors->has('p_accessories'))
							<p class="help-block "style= "color:red">{{ $errors->first('p_accessories') }}</p>
							@endif
						</div>

					</div>
					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Bảo hành</label>
						<div class="col-lg-6">
							<input type="text" placeholder="Khuyến mãi" name="p_warranty" value="{{ old('p_warranty') }}" class="form-control">
						</div>
					</div>
					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Tình trạng</label>
						<div class="col-lg-6">
							<input type="text" placeholder="Tình trạng máy" name="p_condition" value="{{ old('p_condition') }}" class="form-control">
						</div>
					</div>


					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Trạng thái</label>
						<div class="col-lg-6">
							<select name="p_status" id="" class="form-control">
								<option value="1">Còn hàng</option>
								<option value="0">Hết hàng</option>			
							</select>
						</div>
					</div>


					<div class="form-group has-success">

						<label class="col-lg-3 control-label">Miêu tả</label>
						<div class="col-lg-6">
							<textarea name="p_description" cols="80" value="{{ old('p_description') }}"></textarea>

							@if($errors->has('p_description'))
							<p class="help-block "style= "color:red">{{ $errors->first('p_description') }}</p>
							@endif

						</div>

					</div>

					<div class="form-group has-success">

						<label class="col-lg-3 control-label">Danh mục</label>
						<div class="col-lg-6">
							<select name="prod_cate" id="" class="form-control">
								@if (isset($cateList)) 
								@foreach ($cateList as $category)
								<option value="{{ $category->c_id }}">{{ $category->c_name }}</option>
								@endforeach
								@endif
							</select>

						</div>

					</div>


					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Nổi bật</label>
						<div class="col-lg-6">
							<input style="height:20px; width:20px;" type="checkbox" name="p_hot" " >
						</div>
					</div>

					<div class="form-group has-success">
						<label class="col-lg-3 control-label">Hiển thị</label>
						<div class="col-lg-6">
							<input style="height:20px; width:20px;" type="checkbox" checked name="p_active" " >
						</div>
					</div>


					<div class="form-group">
						<div class="text-center">
							<button class="btn btn-success" type="submit">Thêm sản phẩm</button>
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