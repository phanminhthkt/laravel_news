@extends('back-end.layout.master')
@section('content')
<!-- <div class="row"> -->
<div class="col-md-12">
  <div class="card">
      <div class="card-header">
          <strong class="card-title">{{$page_name}}</strong>
      </div>
      <div class="card-body">
        <!-- Credit Card -->
        <div id="pay-invoice">
            <div class="card-body">
                @if(count($errors) > 0)
                <div class="alert alert-danger" role="danger">
                    @foreach($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
                @endif
                <hr>
                {{ Form::open(['url' => 'backend/comment/reply','method' => 'post']) }}
                <!-- <form action="" method="post" novalidate="novalidate"> -->
                    <div class="form-group">
                        {{ Form::label('comment','Comment',['class'=>'control-label mb-1']) }}
                        {{ Form::textarea('comment',null,['class'=>'form-control','id'=>'comment'])}}
                    </div>
                    {{ Form::hidden('post_id',$id ) }}
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Reply</span>
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