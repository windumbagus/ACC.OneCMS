@extends('admin.admin') 

@section('master-management', 'active')
@section('master-holiday', 'active')

@section('content')

<!-- TableUserCMS -->
<div class="box box-primary">
    <div class="box-header with-border">
        
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Holiday GCM</h3>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="add-holiday-gcm btn btn-block btn-primary">Create New Holiday</a>  
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-block btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <input type="text" placeholder="Search by Description" class="InputSearch form-control">
            </div>
            <div class="col-sm-4">
                <div class="col-sm-6">
                    <a href="#" class="ButtonSearch btn btn-block btn-info">Search</a>    
                </div>
                <div class="col-sm-6">
                    <a href="#" class="ResetSearch btn btn-block btn-info">Reset</a>    
                </div>
            </div>
        </div><br>

        <table id="example1" class="table table-bordered display nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Tanggal Holiday</th>
            <th>Description</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($Holidays as $Holiday)
            <tr>  
                <td><span>{{$Holiday->HolidayCMS->TanggalHoliday}}</span></td>
                <td><span>{{$Holiday->HolidayCMS->Description}}</span></td>
                {{-- @if (property_exists($Holiday->HolidayCMS, 'TanggalHoliday'))
                <td><span>{{$Holiday->HolidayCMS->TanggalHoliday}}</span></td>
                @else 
                <td></td>
                @endif --}}
                <td>
                <span>
                    <a href="#" data-id="{{ $Holiday->HolidayCMS->Id}}" class="update-holiday-gcm btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp; 
                    <a  href="{{asset('holiday_gcm/delete/'.$Holiday->HolidayCMS->Id)}}" class=" btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure want to delete this ?')" ><i class="fa fa-trash"></i>
                    </a> 
                </span>
                </td>
            </tr>   
                            
            @endforeach       
        </tbody>
        </table>
    </div>
 </div>

  <!-- page script -->
<script>
    $(document).ready(function () {
      $('#example1').DataTable({
          'deferRender': true,
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          'scrollX': true,
          sDom: 'lrtip', 
          "columns": [
                {"searchable":false},                
                null,
                {"searchable":false},
            ]
      })

        //Button Search
        $('.ButtonSearch').on('click', function(){
            var searchData = $('.InputSearch').val()
            var dtable = $('#example1').DataTable()
            dtable.search(searchData).draw()
        })

        //Reset Button Search
        $('.ResetSearch').on('click',function(){
            var tab = $('#example1').DataTable()
            tab.search('').draw()
            $('.InputSearch').val('')
        })

        //ADD
        $(document).on('click','.add-holiday-gcm',function(){
        $('#add-holiday-gcm').modal();     
        });

        
    })
  </script>

@include('modal.add_holiday_gcm')
@endsection
