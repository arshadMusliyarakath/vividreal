@extends('main.master')
@section('title', 'Add Company')

@section('content')

    <form action="{{ route('company.do.add') }}" method="POST" enctype="multipart/form-data">
        <h1 class="title">Add Company</h1>
        <hr>
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Company Logo</label>
            <input type="file" class="form-control" name="logo" required>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="" class="form-label">Website</label>
            <input type="text" class="form-control" name="website" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Company</button>
    </form>


<style>
body{
  background: #f6f9ff;
}
form {
	margin: 0 auto;
	width: 36%;
	border: 1px solid;
	padding: 40px;
	border-color: rgba(0,0,0,0.1);
	margin-top: 40px;
	border-radius: 10px;
	background: white;
}
h1.title {
	font-size: 25px;
	font-weight: bold;
	margin: 0;
}
</style>


@endsection
