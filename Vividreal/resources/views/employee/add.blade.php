@extends('main.master')
@section('title', 'Add Employee')

@section('content')

    <form action="{{ route('employee.do.add') }}" method="POST" enctype="multipart/form-data">
        <h1 class="title">Add Employee</h1>
        <hr>
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">First Name</label>
            <input type="text" class="form-control" name="fname" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lname" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="number" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Company</label>
            <select name="company_id" class="form-control" required>
                <option value="">Select Company</option>
                @foreach ($companies as $item)
                   <option value="{{$item->company_id}}">{{$item->name}}</option> 
                @endforeach
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
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
