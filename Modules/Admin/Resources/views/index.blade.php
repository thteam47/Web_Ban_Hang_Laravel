@extends('admin::layouts.master')
@section('content')
<h1>Hello 
	@foreach($nameAuth as $item)
	{{ $item->name }}
	@endforeach
</h1>


@stop
