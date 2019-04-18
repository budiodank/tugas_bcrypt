@extends('layouts.global')

@section('title') Edit operator @endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form method="POST" action="{{route('users.update', ['id' => $user->id])}}" class="p-3 shadow-sm bg-white">
				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name</label><br>
				<input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Full Name"/><br>

				<label for="nik">Nomor Induk Kependudukan</label><br>
				<input value="{{$user->nik}}" class="form-control" placeholder="Nomor Induk Kependudukan" type="number" name="nik" id="nik"/><br>

				<label for="no_telp">Phone number</label><br> 
				<input value="{{$user->no_telp}}" type="number" name="no_telp" class="form-control"><br>

				<label for="no_wa">Phone number (Whats App)</label><br> 
				<input value="{{$user->no_wa}}" type="number" name="no_wa" class="form-control"><br>

				<label for="email">Email</label><br>
				<input class="form-control" value="{{$user->email}}" type="text" name="email" id="email"/><br>

				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>

@endsection