@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
		</ol>
	</div>
	
</div>

<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí danh mục sản phẩm			
		</div>
		<div class="themmoi text-center" style = "margin-top:10px">
			<a href="{{ route('admin.get.create.category') }}" class="btn btn-primary ">Thêm danh mục</a>
		</div>
		<div class="row w3-res-tb">			
			<div class="col-sm-3 m-b-xs">
				<div class="input-group">
					<input type="text" class="input-sm form-control" placeholder="Search">
					<span class="input-group-btn">
						<button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
					</span>
				</div>
				               
			</div>
			
		</div>
		<div class="table-responsive">

			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						
						<th>STT</th>
						<th>Tên danh mục</th>
						<th>Icon</th>
						<th>Trạng thái</th>
						<th style="width:30px;"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					?>
					@if (isset($categories))
					@foreach($categories as $category)
					<tr>
						<td><?php echo $i++ ?></td>
						<td>{{ $category->c_name }}</td>
						<td>
							<i class="{{ $category->c_icon }}" style="font-size: 40px;" ></i>
						</td>
						<td>{{ $category->getStatus($category->c_active)['name'] }}</td>
						<td>
							<a href="{{ route('admin.get.edit.category',$category->c_id) }}" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i></a>
							<a href="{{ route('admin.get.detroy.category',$category->c_id) }}"><i class="fa fa-times text-danger text"></i></a>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
		
	</div>
</div>
@stop
