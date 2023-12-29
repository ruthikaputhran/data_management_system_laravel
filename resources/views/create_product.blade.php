@include('header')
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Product</li>
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
              <h3 class="card-title">Create Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ $isEdit == 0 ? route('addProduct') : route('updateProduct') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputName">Product Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $isEdit == 1 ? $data['name'] : '' }}" placeholder="Enter Product name">
                </div>


                <div class="form-group">
                  <label>Product Description</label>
                  <textarea class="form-control" name="description" placeholder="Enter product description">{{ $isEdit == 1 ? $data['description'] : '' }}</textarea>
                </div>

                <div class="form-group col-4">
                  <label for="exampleInputName">Price</label>
                  <input type="text" class="form-control" name="price" value="{{ $isEdit == 1 ? $data['name'] : '' }}" placeholder="Enter price">
                </div>



                <div class="form-group">
                  <label for="category" class="col-md-4 col-form-label text-md-end text-start">Category</label>
                  <div class="col-md-4">
                    <!-- $item->category?->name -->
                    
                    <select class="form-control" name="category" id="category">
                      @foreach ($category as $readCat)

                      <option value="{{$readCat->id}}">{{$readCat->name}}</option>

                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image"> Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                  </div>

                </div>

              </div>

            <input type="hidden" name="id" value="{{ $isEdit == 1 ? $data['id'] : '' }}">

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