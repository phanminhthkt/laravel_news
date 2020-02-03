@extends('back-end.layout.master')
@section('content')
<link rel="stylesheet" href="{{asset('public/back-end')}}/css/lib/chosen/chosen.css">
<script src="{{asset('public/back-end')}}/js/lib/chosen/chosen.jquery.js"></script>
<script>
      jQuery(document).ready(function() {
          jQuery(".myselect").chosen({
              disable_search_threshold: 10,
              no_results_text: "Oops, nothing found!",
              width: "100%"
          });
      });
     
  </script>
<!-- <div class="row"> -->
<div class="col-md-12">
  <div class="card">
      <div class="card-header">
          <strong class="card-title">{{ $page_name }}</strong>
      </div>
      <div class="card-body">
        <!-- Credit Card -->
        <div id="pay-invoice">
            <div class="card-body">
                @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>    
                @endif
                <hr>
                {{ Form::open(['url' => 'backend/roles/store','method' => 'post']) }}
                <!-- <form action="" method="post" novalidate="novalidate"> -->
                    <div class="form-group">
                        {{ Form::label('name','Name',['class'=>'control-label mb-1']) }}
                        {{ Form::text('name',null,['class'=>'form-control','id'=>'name'])}}
                    </div>
                     <div class="form-group">
                        {{ Form::label('display_name','Display Name',['class'=>'control-label mb-1']) }}
                        {{ Form::text('display_name',null,['class'=>'form-control','id'=>'display_name'])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'control-label mb-1']) }}
                        {{ Form::textarea('description',null,['class'=>'form-control','id'=>'description'])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('permission','Permission',['class'=>'control-label mb-1']) }}
                        {{ Form::select('permission[]',$data_permission,null,
                                [
                                    'class'=>'form-control myselect',
                                    'id'=>'description',
                                    'data-placeholder' => 'Select Permission',
                                    'multiple',
                                ])
                        }}
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Roles</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                    </div>
                <!-- </form> -->
                {{ Form::close() }}
            </div>
        </div>

      </div>
  </div> <!-- .card -->
</div>
<!-- </div> -->
@Endsection