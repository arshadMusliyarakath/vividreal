@extends('main.master')
@section('title', 'Companies')

@section('content')
    
<div class="heading-area mt-3">
    <div class="float-start">
        <h2 class="">Companies List</h2>
    </div>
    <div class="float-end">
        <a href="{{ route('company.add')}}" class="btn btn-success">Add Company</a>
    </div>
    <div style="clear: both"></div>
</div>
<hr>
<table id="companies-table" class="table table-bordered">
    <thead>
        <tr>
            <th width='110px'>Logo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
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
            ajax: '{{ route('companyData') }}',
            columns: [
                {
                    data: 'logo',
                    name: 'logo',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            return '<div class="logo-bg" style="background-image: url(\'/storage/logos/' + data + '\')"></div>';
                        }
                        return data;
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'website', name: 'website' },
                { data: 'action', name: 'action'}
            ]  
        });
    });

</script>

  <!-- Modal -->
  <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>



@endsection