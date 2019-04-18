@extends('layouts.global')

@section('title') Operator list @endsection

@section('content')
	
	<div class="row">
		<div class="col-md-6">
			<form action="{{route('users.index')}}">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Filter by email" name="email">

					<div class="input-group-append">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
	</div>

	<hr class="my-3">

			@if(session('status'))
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-warning">
							{{session('status')}}
						</div>
					</div>
				</div>
			@endif

	<div class="row">
		<div class="col-md-12 text-right">
			<a href="{{route('users.create')}}" class="btn btn-primary">Create operator</a>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th><b>Name</b></th>
						<th><b>NIK</b></th>
						<th><b>No. Telp</b></th>
						<th><b>Email</b></th>
						<th><b>Actions</b></th>
					</tr>
				</thead>
				<tbody>

					@foreach ($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->nik}}</td>
						<td>{{$user->no_telp}}<br>
							{{$user->no_wa}} (Whats App)
						</td>
						<td>{{$user->email}}</td>
						<td>
							<a href="{{route('users.edit', ['id' => $user->id])}}" class="btn btn-info btn-sm"> Edit </a>
							<form class="d-inline" action="{{route('users.destroy', ['id' => $user->id])}}" method="POST" onsubmit="return confirm('Are you sure delete user?')">
								@csrf
								<input type="hidden" value="DELETE" name="_method">
								<input type="submit" class="btn btn-danger btn-sm" value="Delete">
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colSpan="10">{{$users->appends(Request::all())->links()}}</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
@endsection