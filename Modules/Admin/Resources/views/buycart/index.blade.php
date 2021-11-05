@extends('admin::layouts.master')
@section('content')
<script type="text/javascript">
	function updateStatus(status, id){
		$.get(
			'{{ route('updateStatus') }}',
			{ status:status,id:id },
			function(){
				location.reload();
			}
			);
	}
</script>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang tổng quan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Kho hàng</li>
		</ol>
	</div>
	
</div>

<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí kho hàng
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

						<th style="width:5%;" >STT</th>
						<th style="width:35%;" >Thông tin đơn hàng</th>
						<th style="width:25%;">Thông tin khách hàng</th>
						@hasAnyrole(['admin','assistant'])
						<th style="width:10%;" >Thông tin người bán</th>						
						@endhasAnyrole
						<th style="width:10%;" >Tổng tiền</th>
						<th style="width:15%;" >Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					?>
					@foreach($data as $item)
					<tr>
						<td><?php echo $i++ ?></td>
						<td>{!! $item->infoProduct !!}</td>
						<td>{!! $item->infoBuyer !!}</td>
						@hasAnyrole(['admin','assistant'])
						<td>Tên: {{  $item->name }} <br> Phone:{{  $item->name }}</td>	
						@endhasAnyrole
						<td>{{ number_format($item->total,0,',','.') }} VNĐ</td>
						<td>
							<select name="status" id="" class="form-control" onchange="updateStatus(this.value,'{{ $item->id }}')">
								<option value="1" @if($item->status==1) selected @endif>Thành công</option>
								<option value="0" @if($item->status==0) selected @endif>Đang xử lí</option>
								<option value="2" @if($item->status==2) selected @endif>Hết hàng</option>			
							</select></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@stop
