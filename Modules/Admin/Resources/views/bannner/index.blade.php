@extends('admin::layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Danh sách quảng cáo</li>
		</ol>
	</div>
	
</div>

<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí danh sách quảng cáo	
		</div>
		<div class="themmoi text-center" style = "margin-top:10px">
			<a href="{{ route('admin.get.create.adv') }}" class="btn btn-primary ">Thêm quảng cáo</a>
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
						<th>Ảnh quảng cáo</th>
						<th>Liên kết tới trang</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					?>
					@foreach($advs as $adv)
					<tr>
						<td><?php echo $i++ ?></td>
						<td>
						<img src="{{ asset('/storage/app/advImg/'.$adv->adv_img) }}" alt="" class="thumbnail" width="300px" height="150px">
						</td>
						<td>{{ $adv->adv_link }}</td>
						
						<td>
							<a href="{{ route('admin.get.edit.adv',$adv->adv_id) }}" ui-toggle-class=""><i class="fa fa-edit"></i>Sửa</a>
							<a href="{{ route('admin.get.detroy.adv',$adv->adv_id) }}"><i class="fa fa-times text-danger text"></i>Xóa</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</div>
@stop
