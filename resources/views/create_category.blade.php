@include('header')
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Category</h3>
            </div>
            @if(session()->has('message'))

            <div class="alert alert-success">
              {{ session()->get('message') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ $isEdit == 0 ? route('addCategory') : route('updateCategory') }}" method="post">
              @csrf
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $isEdit == 1 ? $data['name'] : '' }}" placeholder="Enter category name">
                </div>

                {{ $isEdit == 1 ? $data['description'] : '' }}
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter description">{{ $isEdit == 1 ? $data['description'] : '' }}</textarea>
                </div>
              </div>
              <input type="hidden" value="{{ $isEdit == 1 ? $data['id'] : '' }}" name="id">
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
</div>
</section>
</div>
@include('footer')