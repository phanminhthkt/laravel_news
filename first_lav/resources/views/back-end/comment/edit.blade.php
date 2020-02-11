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

        jQuery("textarea.my-editor").ckeditor({
            filebrowserImageBrowseUrl: '{{ url("public" )}}/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '{{ url("public" )}}/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '{{ url("public") }}/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ url("public") }}/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });
</script> 
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
              {{ Form::model($post,['route' =>['PostUpdate',$post->id],'method' => 'put','files' =>true,'enctype'=>'multipart/form-data']) }}
                <!-- <form action="" method="post" novalidate="novalidate"> -->
                    <div class="form-group">
                        {{ Form::label('title','Titles',['class'=>'control-label mb-1']) }}
                        {{ Form::text('title',null,['class'=>'form-control','id'=>'title'])}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('category','Category',['class'=>'control-label mb-1']) }}
                        {{ Form::select('category_id',$data_category,$post->category_id,
                                [
                                    'class'=>'form-control myselect',
                                    'id'=>'category',
                                    'data-placeholder' => 'Select Category',
                                    '',
                                ])
                        }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('short_description','Short Description',['class'=>'control-label mb-1']) }}
                        {{ Form::textarea('short_description',null,['class'=>'form-control','id'=>'short_description'])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'control-label mb-1']) }}
                        {{ Form::textarea('description',null,['class'=>'form-control my-editor','id'=>'description'])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('image','Image',['class'=>'control-label mb-1']) }}
                        <div class="clear"></div>
                        <img width="150" src="{{asset('public/upload/post/'.$post->thumb_image)}}">
                        {{ Form::file('img',['class'=>'form-control'])}}
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Post</span>
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