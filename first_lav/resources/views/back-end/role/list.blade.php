@extends('back-end.layout.master')
@section('content')
<link rel="stylesheet" href="{{asset('public/back-end')}}/css/lib/datatable/dataTables.bootstrap.min.css">
<!-- <link rel="stylesheet" href="{{asset('public/back-end')}}/css/bootstrap-select.less"> -->
<!-- <link rel="stylesheet" href="{{asset('public/back-end')}}/scss/style.css"> -->
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>{{ $page_name }}</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Table</a></li>
                  <li class="active">Data table</li>
              </ol>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">

      <div class="col-md-12">
        @if($message = Session::get('success'))
        <div class="alert alert-success">
          {{ $message }}
        </div>
        @endif
          <div class="card">
              <div class="card-header">
                  <strong class="card-title">{{ $page_name }}</strong>
                  <a href="{{route('RoleCreate')}}" class="btn btn-primary pull-right">Create</a>
              </div>
              <div class="card-body">
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Display Name</th>
              <th>Description</th>
              <th>Permissions</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>

            @foreach($data as $i=>$row)

            <tr>
              <td>{{ $i+1 }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->display_name }}</td>
              <td>{{ $row->description }}</td>
              <td>
                @if($row->perms())
                  <ul style="margin-left: 20px;">
                    @foreach($row->perms()->get() as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                  </ul>
                @endif  
              </td>
              <td>
                <a class="btn btn-primary" href="{{route('RoleUpdate',$row->id)}}">Edit</a>
                <!-- <a class="btn btn-danger" href="{{route('PermissionDelete',$row->id)}}">Delete</a> -->
                {{ Form::open(['method'=>'DELETE','url'=>['/backend/roles/delete/'.$row->id],'style'=>'display:inline']) }}
                {{ Form::submit('Delete',['class'=>'btn btn-danger']) }}
                {{ Form::close() }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
              </div>
          </div>
      </div>


      </div>
  </div><!-- .animated -->
</div>

<script src="{{asset('public/back-end')}}/js/vendor/jquery-2.1.4.min.js"></script>
<script src="{{asset('public/back-end')}}/js/plugins.js"></script>
<script src="{{asset('public/back-end')}}/js/main.js"></script>


<script src="{{asset('public/back-end')}}/js/lib/data-table/datatables.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/jszip.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/pdfmake.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/vfs_fonts.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/buttons.html5.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/buttons.print.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="{{asset('public/back-end')}}/js/lib/data-table/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
    } );
</script>
@Endsection