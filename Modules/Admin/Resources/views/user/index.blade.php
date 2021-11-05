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
<script type="text/javascript">
	function updateRole(email, role, check){
		console.log(check);
		$.get(
			'{{ route('updateRoles') }}',
			{ email:email,role:role},
			setTimeout(function(){
				window.location.reload(1);
			}, 500)			
			);
		// setTimeout(updateRole,5000);
	}
</script>
<div class="table-agile-info col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Quản lí danh sách người dùng			
		</div>
		<div class="themmoi text-center" style = "margin-top:10px">
			<a href="{{ route('admin.get.create.product') }}" class="btn btn-primary ">Thêm người dùng</a>
		</div>
		<?php
		$message = Session::get('error');
		if ($message){
			echo '<p class="alert alert-danger">',$message ,'</p>';
			Session::put('error',null);
		}
		?>
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

			<table class="table table-hover b-t b-ligh "  style="width:100%;">
				<thead>
					<tr>						
						<th style="width:5%;">STT</th>
						<th style="width:13%;">Tên người dùng</th>
						<th style="width:10%;">Email</th>
						<th style="width:10%;">Username</th>
						<th style="width:10%;">Trạng thái</th>
						<th style="width:8%;">Admin</th>
						<th style="width:8%;">Assistant</th>
						<th style="width:8%;">Seller</th>
						<th style="width:8%;">User</th>
						<th style="width:20%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>		
					<?php $i=1; ?>			
					@foreach($userList as $user)					
					<tr>
						<td><?php echo $i++ ?></td>
						<td >{{ $user->name }}</td>	
						<td >{{ $user->email }}</td>
						<td>{{ $user->username }} </td>
						<td><?php if($user->active==1) echo 'Online'; else echo 'Offline';?></td>
						<td><input type="checkbox" name="admin_role" {{ $user->hasRole('admin')?'checked':'' }} onclick="updateRole('{{ $user->email }}','admin_role')">
						</td>
						<td><input type="checkbox" name="assistant_role" {{ $user->hasRole('assistant')?'checked':'' }} onclick="updateRole('{{ $user->email }}','assistant_role')">
						</td>
						<td><input type="checkbox" name="seller_role" {{ $user->hasRole('seller')?'checked':'' }} onclick="updateRole('{{ $user->email }}','seller_role')">
						</td>
						<td><input type="checkbox" name="user_role" {{ $user->hasRole('user')?'checked':'' }} onclick="updateRole('{{ $user->email }}','user_role')">
						</td>
						<td>
							<div class="btn-group">
								
								<div class="btn btn-outline-danger">
									<a href="{{ route('admin.get.detroy.user',$user->id) }}"><i class="fa fa-times text-danger text"></i>Xóa</a>
								</div>
								
							</div>
						</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
			<div id="pagination" style="margin: auto;text-align: center;">
				<ul class="pagination pagination-lg justify-content-center">
					{{ $userList->links('vendor/pagination/bootstrap-4') }};
				</ul>
			</div>
		</div>
		
	</div>
</div>

@stop
