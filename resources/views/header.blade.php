<html>

<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

</head>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
  
    <ul class="navbar-nav ml-auto">
       <!-- Notifications Dropdown Menu -->
       <a class="nav-link" data-toggle="dropdown" href="#">
        {{ Auth::user()->name }}
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
       <li class="nav-item dropdown">
    
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
      </li>
</div>
</ul>

 
  </nav>
  <!-- /.navbar -->
