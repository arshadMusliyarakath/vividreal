@extends('main.master')
@section('title', 'Edit Company')

@section('content')

    <form action="{{ route('company.do.edit') }}" method="POST" enctype="multipart/form-data">
        <h1 class="title">Edit Company</h1>
        <hr>
        @csrf
        <input type="hidden" value="{{ $company->company_id }}" name="company_id">
        <div class="mb-3">
            <label for="" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="name" value="{{ $company->name }}" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" value="{{ $company->email }}" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Company Logo</label>
            <input type="file" class="form-control" name="logo">
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
            <input type="text" class="form-control" name="website" value="{{ $company->website }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit Company</button>
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
