@extends('admin::layouts.master')
@section('content')
<h1>Hello World</h1>

<form action="/action_page.php">
	@csrf
	<label for="phone">Enter a phone number:</label><br><br>
	<input type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"><br><br>
	<small>Format: 123-45-678</small><br><br>
	<input type="submit">
</form>
<input type="text" placeholder="dsfds">
<p>
	This view is loaded from module: {!! config('admin.name') !!}
</p>
@stop
