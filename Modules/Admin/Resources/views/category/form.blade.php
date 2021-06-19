

<div class="form-group has-success">
	<label class="col-lg-3 control-label">Tên danh mục</label>
	<div class="col-lg-6">
		<input type="text" placeholder="Tên danh mục" name="name" value="{{old('name',!empty($category->c_name)?$category->c_name:'')}}" class="form-control">

		@if($errors->has('name'))
		<p class="help-block "style= "color:red">{{ $errors->first('name') }}</p>
		@endif
	</div>


</div>
<div class="form-group has-success">

	<label class="col-lg-3 control-label">Icon</label>
	<div class="col-lg-6">
		<input type="text" placeholder="fa fa-home" name="icon" value="{{ old('icon',!empty($category->c_icon) ? $category->c_icon : '') }}" class="form-control">
		@if($errors->has('icon'))
		<p class="help-block "style= "color:red">{{ $errors->first('icon') }}</p>
		@endif
	</div>

</div>

<div class="form-group has-success">
	<label class="col-lg-3 control-label">Hiển thị</label>
	<div class="col-lg-6">
		<input style="height:20px; width:20px;" type="checkbox" checked name="active" value="1" >
	</div>
</div>
					{{-- <div class="form-group has-error">
						<label class="col-lg-3 control-label">sample 2</label>
						<div class="col-lg-6">
							<input type="text" placeholder="" id="l-name" class="form-control">
							<p class="help-block">You gave a wrong info</p>
						</div>
					</div>
					<div class="form-group has-warning">
						<label class="col-lg-3 control-label">sample 3</label>
						<div class="col-lg-6">
							<input type="email" placeholder="" id="email2" class="form-control">
							<p class="help-block">Something went wrong</p>
						</div>
					</div> --}}

