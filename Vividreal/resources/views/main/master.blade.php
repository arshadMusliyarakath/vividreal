<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vividreal - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  </head>
  <body>
    <nav id="menu" class="navbar navbar-expand-lg" style="background-color: #ffe185">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Vividreal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <a class="nav-link {{ (request()->is('employees') || request()->is('add-employee')) ? 'active' : '' }}" href="{{ route('employees')}}">Employees</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (request()->is('companies') || request()->is('add-company')) ? 'active' : '' }}" href="{{ route('companies')}}">Companies</a>
              </li>
            </ul>
            Hi {{ auth()->user()->name }}, <a href="{{ route('user.logout') }}" class="ms-2 btn btn-danger logout_btn">Logout</a>
        
        
          </div>
        </div>
      </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>
.logout_btn {
	padding: 0px 9px 1px;
	margin: 0;
	font-size: 13px;
	line-height: 2;
}
</style>


  </body>
</html>