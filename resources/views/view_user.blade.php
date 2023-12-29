@include('header')
@include('sidebar')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/js/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/js/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/js/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/js/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->

</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="card">
    <a href="{{ route('download-csv') }}" class="btn btn-primary" style="width: fit-content;
  margin-top: 1%;
  margin-left: 1%;">Export to CSV</a>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>First Name </th>
            <th>Last Name </th>
            <th>Email</th>
            <th>User Type</th>
            @can('delete_user')
            <th>Action</th>
            @endcan

          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->last_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->user_type }}</td>
            @can('delete_user')
            <td>
              <form action="{{ route('deleteUser', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>

              <a class="nav-link" href="{{ route('editUser',['id' => $item->id]) }}">
                Edit
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
              </a>


            </td>
            @endcan

          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>
  @include('footer')

  <!-- DataTables  & Plugins -->

  <script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/js/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/js/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/js/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>


  <script>
    $(function() {
      $("#dataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        //"order": [],
        "columnDefs": [{
            "orderable": false,
            "targets": "_all"
          } // Disable ordering for all columns
        ],
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- Page specific script -->