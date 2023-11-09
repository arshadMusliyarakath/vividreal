@extends('main.master')
@section('title', 'Employees')

@section('content')
    
<div class="heading-area mt-3">
    <div class="float-start">
        <h2 class="">Employees List</h2>
    </div>
    <div class="float-end">
        <a href="{{ route('employee.add')}}" class="btn btn-success">Add Employee</a>
    </div>
    <div style="clear: both"></div>
</div>
<hr>
<table id="companies-table" class="table table-bordered">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<style>
.logo-bg {
	height: 60px;
	width: 60px;
	background-size: cover;
	background-position: center;
}
.heading-area h2 {
	font-size: 30px;
	font-weight: bold;
	margin: 0;
}
</style>

<script>
    $(document).ready(function() {
        $('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('employeeData') }}',
            columns: [
                { data: 'fname', name: 'fname' },
                { data: 'lname', name: 'lname' },
                { data: 'company_name', name: 'company_name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action'}
            ]  
        });
    });

</script>





@endsection