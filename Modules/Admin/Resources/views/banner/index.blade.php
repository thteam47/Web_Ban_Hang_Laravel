@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Danh sách ảnh bìa</li>
		</ol>
	</div>
	
</div>

<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí danh sách ảnh bìa
		</div>
		<div class="themmoi text-center" style = "margin-top:10px">
			<a href="{{ route('admin.get.create.banner') }}" class="btn btn-primary ">Thêm ảnh bìa</a>
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
						
						<th style="width: 5%;">STT</th>
						<th style="width: 30%;">Ảnh bìa</th>
						<th style="width: 50%;">Liên kết tới trang</th>
						<th style="width: 15%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					?>
					@foreach($bans as $item)
					<tr>
						<td><?php echo $i++ ?></td>
						<td>
						<img src="{{ asset('/storage/app/banImg/'.$item->ban_img) }}" alt="" class="thumbnail" width="300px" height="150px">
						</td>
						<td>{{ $item->ban_link }}</td>
						
						<td>
							<a href="{{ route('admin.get.edit.banner',$item->ban_id) }}" ui-toggle-class=""><i class="fa fa-edit"></i>Sửa</a>
							<a href="{{ route('admin.get.detroy.banner',$item->ban_id) }}"><i class="fa fa-times text-danger text"></i>Xóa</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</div>
@stop
