@extends("layouts.global")

@section("title") Create Operator @endsection

@section("content")
	<div class="col-md-8">
		@if(session('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
		@endif
		<form class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">
			@csrf
			<label for="name">Name</label>
			<input value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" placeholder="Full Name" type="text" name="name" id="name"/>
			<div class="invalid-feedback">
				{{$errors->first('name')}}
			</div><br>

			<label for="nik">Nomor Induk Kependudukan</label>
			<input value="{{old('nik')}}" class="form-control {{$errors->first('nik') ? "is-invalid": ""}}" placeholder="Nomor Induk Kependudukan" type="number" name="nik" id="nik"/>
			<div class="invalid-feedback">
				{{$errors->first('nik')}}
			</div><br>

			<label for="no_telp">Phone number</label>
			<br> <input value="{{old('no_telp')}}" type="number" name="no_telp" class="form-control {{$errors->first('no_telp') ? "is-invalid" : ""}}" placeholder="08123456789">
			<div class="invalid-feedback">
				{{$errors->first('no_telp')}}
			</div><br>

			<label for="no_wa">Phone number (Whats App)</label>
			<br> <input value="{{old('no_wa')}}" type="number" name="no_wa" class="form-control {{$errors->first('no_wa') ? "is-invalid" : ""}}" placeholder="08123456789">
			<div class="invalid-feedback">
				{{$errors->first('no_wa')}}
			</div><br>

			<label for="email">Email</label>
			<input class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" placeholder="user@mail.com" type="text" name="email" id="email"/> 
			<div class="invalid-feedback">
				{{$errors->first('email')}}
			</div><br>

			<label for="password">Password</label>
			<input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="password" type="password" name="password" id="password"/>
			<div class="invalid-feedback">
				{{$errors->first('password')}}
			</div><br>

			<label for="password_confirmation">Password Confirmation</label> 
			<input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation"/>
			<div class="invalid-feedback">
				{{$errors->first('password_confirmation')}}
			</div><br>

			<input class="btn btn-primary" type="submit" value="Save"/>
		</form>
	</div>

@endsection