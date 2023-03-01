@section('container')
@extends('dashboard.layout.main')

@section('container')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 600px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Therapist</th>
                      <th >Time in</th>
                      <th >Time out</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($presences as $presence)
                      <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $presence->therapist->name }}</td>
                        <td>{{ $presence->time_start }}</td>
                        <td>{{ $presence->time_end }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editTerapist btn btn-block btn-primary" data-toggle="modal" data-target="#editTerapist"  >
                              <i class="fa-regular fa-clock"></i> 
                              Time in
                              </button>
      
                            </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-warning" >
                              <i class="fa-regular fa-clock"></i> 
                              Time out
                              </button>
                            </div>
                          </div>

                          
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      
      
      
      <!-- /.content -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</section>
  
@endsection
