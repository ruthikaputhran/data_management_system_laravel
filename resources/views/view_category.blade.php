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
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Category</li>
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

    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name </th>
            <th>Description </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>

            @can('delete_category')
            <td>
              <form action="{{ route('deleteCategory', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>

              
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
        //"ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- Page specific script -->