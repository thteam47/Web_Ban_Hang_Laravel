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

<div class="table-agile-info col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí danh mục sản phẩm			
		</div>
		<div class="themmoi text-center" style = "margin-top:10px">
			<a href="{{ route('admin.get.create.product') }}" class="btn btn-primary ">Thêm sản phẩm</a>
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
		<div class="bang" style="width: 100%;" >

			<table class="table table-hover b-t b-ligh  "  style="width:100%;">
				<thead>
					<tr>
						
						<th style="width:5%;">STT</th>
						<th style="width:20%;">Tên sản phẩm</th>
						<th style="width:10%;">Giá sản phẩm</th>
						<th style="width:20%;">Ảnh sản phẩm</th>
						<th style="width:5%;">Tình trạng</th>
						<th style="width:5%;">Trạng thái</th>
						<th style="width:10%;">Danh mục</th>
						<th style="width:5%;">Nổi bật</th>
						<th style="width:5%;">Hiển thị</th>
						<th style="width:15%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@if (isset($productList))
					<?php $i=1; ?>
					@foreach($productList as $product)
					<tr>
						<td><?php echo $i++ ?></td>
						<td >{{ $product->p_name }}</td>						
						<td>{{ number_format($product->p_price,0,',','.') }} VNĐ</td>
						<td>
						<img src="{{ asset('/storage/app/avatar/'.$product->p_image) }}" alt="" class="thumbnail" width="100px" height="100px">
						</td>
						<td>{{ $product->p_condition }}</td>
						<td>{{ $product->p_status }} </td>
						<td>{{ $product->c_name }}</td>
						<td>{{ $product->p_hot }}</td>
						<td>{{ $product->p_active }}</td>
						<td>
							<div class="btn-group">
								<div class="btn btn-outline-warning" style="border: 2px">
									<a  href="{{ route('admin.get.edit.product',$product->p_id) }}" ><i class="fa fa-edit"></i>Sửa</a>
								</div>
								<div class="btn btn-outline-danger">
									<a href="{{ route('admin.get.detroy.product',$product->p_id) }}"><i class="fa fa-times text-danger text"></i>Xóa</a>
								</div>
								
							</div>
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
