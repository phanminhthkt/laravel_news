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
              {{$message}}
          </div>
          @endif
          @if($error = Session::get('error'))
          <div class="alert alert-danger">
              {{$error}}
          </div>
          @endif
          <div class="card">
              <div class="card-header">
                  <strong class="card-title">{{ $page_name }}</strong>
                  <a href="{{route('PostCreate')}}" class="btn btn-primary pull-right">Create</a>
              </div>
              <div class="card-body">
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Title</th>
              <th>Author</th>
              <th>Total View</th>
              <th>Status</th>
              <th>Hot news</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $i=>$row)
            <tr>
              <td>{{ $i+1 }}</td>
               <td width="15%">
                @if(file_exists(public_path('/upload/post/').$row->thumb_image))
                <img width="100" src="{{asset('public/upload/post')}}/{{$row->thumb_image}}" class="img-responsive">
                @endif
              </td>
              <td width="20%">{{ $row->title }}</td>
             
              <td >{{ $row->creator->name }}</td>
              <td width="50">{{ $row->view_count }}</td>
              <td>
                {{ Form::open(['method'=>'PUT','url'=>['/backend/post/status/'.$row->id],'style'=>'display:inline']) }}
                @if($row->status === 0)
                {{ Form::submit('Unpublish',['class'=>'btn btn-danger']) }}
                @else
                {{ Form::submit('Publish',['class'=>'btn btn-success']) }}
                @endif
                {{ Form::close() }}
              </td>
              <td width="50">
                {{ Form::open(['method'=>'PUT','url'=>['/backend/post/hot_news/'.$row->id],'style'=>'display:inline']) }}
                @if($row->hot_news === 0)
                {{ Form::submit('No',['class'=>'btn btn-danger']) }}
                @else
                {{ Form::submit('Yes',['class'=>'btn btn-success']) }}
                @endif
                {{ Form::close() }}
              </td>
              <td>
                <a class="btn btn-info" href="{{route('CommentList',$row->id)}}"><i class="fa fa-comments"></i></a>
                <a class="btn btn-primary" href="{{route('PostUpdate',$row->id)}}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" href="{{route('PostDelete',$row->id)}}"><i class="fa fa-times"></i></a>
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
    });
</script>
@Endsection