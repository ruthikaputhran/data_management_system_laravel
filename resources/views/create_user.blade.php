@include('header');
@include('sidebar');
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
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
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
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
           
           
            <form action="{{ $isEdit == 0 ? route('addUser') : route('updateUser') }}" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $isEdit == 1 ? $data['name'] : '' }}" placeholder="Enter first name">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Last name</label>
                      <input type="text" class="form-control" name="last_name" value="{{ $isEdit == 1 ? $data['last_name'] : '' }}" placeholder="Enter Last name">
                    </div>
                  </div>
                </div>
                @if ($isEdit != 1)
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="{{ $isEdit == 1 ? $data['email'] : '' }}" placeholder="Enter email">
                    </div>
                  </div>
                  @endif
                  <div class="col-6">
                    <div class="form-group">
                      <label for="userType" class="col-md-4 col-form-label text-md-end text-start">User Type</label>
                      <div class="col-md-6">
                        <select class="form-control" name="userType" id="userType" value="{{ $isEdit == 1 ? $data['userType'] : '' }}">
                          <option value="user_admin">User Admins</option>
                          <option value="sales_team">Sales Team</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
                @if ($isEdit != 1)
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="password_confirmation">Confirm Password</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                    </div>
                  </div>
                </div>
                @endif
       
                <div class="input-group mb-3">


                </div>
                <input type="hidden" value="{{ $isEdit}}" name="isEdit">
                <input type="hidden" value="{{$isEdit == 1 ? $data['id'] : ''}}" name="id">



              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('footer')