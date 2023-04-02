@extends('dashboard.layout.main')

@section('container')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/report" class="text-success"><h1>Report</h1></a></li>
                <li class="breadcrumb-item active">Salary Detail</li>
              </ol>
            </div>
          <div class="col-sm-6 mt-1">
            <ol class="breadcrumb float-sm-right">
              <div class="print-sale">
              @foreach($salary as $sal)
                @endforeach
                <form action="/pdf-salary-detail{{ $sal['therapist_id'] }}" method="" target="_blank">
                <button class="btn btn-success" type="submit">
                  <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
                </button>
                </form>
              </div>
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
          <div class="col-12 ">
          <div class="card">
              <div class="card-header">
                <h1 class="card-title">{{ $sal['therapist_name'] }}</h1>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 350px;">
                    <span class=""><input type="date" name="table_search" class="form-control float-right" placeholder="Search"></span>
                    <span><input type="date" name="table_search" class="form-control float-right" placeholder="Search"></span>

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" id="salary-detail">
                <table class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Order Id</th>
                      <!-- <th class="text-center">Cust Name</th> -->
                      <th class="text-center">Service</th>
                      <th class="text-center">Time Duration</th>
                      <th class="text-center">Extra Time</th>
                      <th class="text-center">Service (Extra Time)</th>
                      <th class="text-center">Salary (Rp)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($salary as $sal)
                    @foreach($sal['order_details'] as $dt)
                    @if($dt['customer_name'] != null)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td class="text-center">{{ $dt['order_date'] }}</td>
                      <td class="text-center">#{{ $dt['order_id'] }}</td>
                      <!-- <td class="">{{ $dt['customer_name'] }}</td> -->
                      <td class="text-center">{{ $dt['service'] }}</td>
                      <td class="text-center">{{ $dt['time_duration'] }}'</td>
                      @if($dt['extra_time'] == null)
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      @else
                      <td class="text-center">{{ $dt['extra_time'] }}'</td>
                      <td class="text-center">{{ $dt['service_extra']}}</td>
                      @endif
                      <td class="text-right">{{Str::rupiah($dt['order_bonus']) }},00</td>
                    </tr>
                    @else
                    <tr>
                      <td colspan="9">Sorry, We don't take service yet right now!</td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                  </tbody>
                  <tfoot>
                        <tr>
                    
                          <th colspan='7' class="text-center">Total Salary (Rp)</th>
                          <th class="text-right">{{ Str::rupiah($Summary) }},00</th>
                          
                        </tr>
                      </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/salary_detail.js"></script>
@endsection