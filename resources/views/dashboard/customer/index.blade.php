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
              <a href="#" data-target="#addTerapist" data-toggle="modal">
                <li class="breadcrumb-item"><i class="fa fa-plus"></i>  Add Therapist</li>
              </a>
              
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
              <div class="card-body table-responsive p-0" style="height: 638px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Name</th>
                      <th >Phone</th>
                      <th >Service</th>
                      <th class="">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($customers as $customer)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $customer->cust_name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->service->massage }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editTerapist btn btn-block btn-default btn-lg" data-toggle="modal" data-target="#editTerapist"  >
                              <i class="fa fa-edit"></i>
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
    
        
      
    </section>

    <div class="content">
      <div class="container-fluid">
    
        <!-- modal edit --> 
        <div class="modal fade" id="editTerapist">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Therapist</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/therapist/edit/{{ $customer->id }}" method="post">
                      @method('put')
                      @csrf
                                  <!-- name -->
                                  <div class="row mb-3">
                                      <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <input type="hidden" id="terapist_id" name="terapist_name">
                                      <div class="col-md-8">
                                        <input id="editName" type="text" class="form-control @error('name') is-invalid @enderror" id="editName" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- nickname -->
                                  <div class="row mb-3">
                                      <label for="nickname" class="col-md-4 col-form-label text-md-end">Nickname</label>

                                      <div class="col-md-8">
                                          <input id="editNickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                                          @error('nickname')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- phone -->
                                  <div class="row mb-3">
                                      <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                                      <div class="col-md-8">
                                          <input id="editPhone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- kehadiran -->
                                  <div class="row mb-3">
                                      <label for="presence" class="col-md-4 col-form-label text-md-end">Presence</label>

                                      <div class="col-md-8">
                                          <input id="editPresence" type="text" class="form-control @error('presence') is-invalid @enderror" name="presence" value="{{ old('presence') }}" required autocomplete="presence" autofocus>

                                          @error('presence')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- commision -->
                                  <div class="row mb-3">
                                      <label for="commision" class="col-md-4 col-form-label text-md-end">Commision</label>

                                      <div class="col-md-8">
                                          <input id="editCommision" type="text" class="form-control @error('commision') is-invalid @enderror" name="commision" value="{{ old('commision') }}" required autocomplete="commision" autofocus>

                                          @error('commision')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>


                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
          <!-- /.end edit therapist -->
      </div>
    </div>
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/therapist.js"></script>
    
@endsection