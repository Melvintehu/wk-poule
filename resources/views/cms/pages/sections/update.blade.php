@extends('cms.master')

@section('title')
    Aanpassen
@stop

@section('content')
    <h1>Mentor aanpassen </h1>
    <hr>

    <div class="row">
        <div class="col-lg-12">             
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">       
                        <div class="panel-body">
                        </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        
                                        <div class="table-responsive">        
                                            <div>
                                                 {!! Form::model($data['section'],
                                                    array(
                                                        'method' => 'PUT',
                                                        'action' => ['SectionController@update', $data['section']->id]
                                                        )
                                                    )
                                                !!}
                                                    <thead>
                                                        <tr>
                                                           <td>
                                                                {!! Form::label('title', ' De titel die weergegeven wordt op de website ') !!} 
                                                                {!! Form::text('title', null, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                        <tr>
                                                           <td>
                                                                {!! Form::label('body', ' De text die weergegeven wordt op de website ') !!} 
                                                                {!! Form::textarea('body', null, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                       <tr>
                                                           <td>
                                                                {!! Form::label('template', ' De text die weergegeven wordt op de website ') !!} 
                                                                {!! Form::select('template', $data['templates']->pluck('name'), null, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php 
                                                                    foreach($data['templates'] as $template) {

                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                           <td>
                                                                {!! Form::label('page_position', 'Op welke volgorde staat deze sectie ?') !!} 
                                                                {!! Form::select('page_position', $data['page_positions'], null, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr> 
                                                    </thead>    

                                                                                                        
                                                    <div class='form-group'>
                                                        <input type='submit' class='btn btn-primary' value='aanpassen' />
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End row -->
                
                   <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-default">
                           
                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive">

                                            <table class="table table-hover">
                                                
                                                <tbody>
                                                   
                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div> <!-- End row -->


            
                <div class="row">

                    <div class="col-md-12">

                        <h1>Foto beheren </h1>

                        <hr>

                        <div class="panel panel-default">
                           
                            <div  class="panel-body">

                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive">

                                            <table class="table">
                                                
                                                <tbody>

                                                    <tr>

                                                        <td>

                                                            <form  enctype="multipart/form-data" action='/cms/section/{{ $data['section']->id }}/photos' method="POST" id="PhotoUpload" class="dropzone" >
                                                                {{ csrf_field() }}
                                                            </form>

                                                        </td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div> <!-- End row -->


        </div>
    </div>
@stop

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<script >
Dropzone.options.PhotoUpload = {
  maxFilesize: 25,
  accept: function(file, done) {
    console.log("uploaded");
    done();
  },
  init: function() {
    this.on("addedfile", function() {
      if (this.files[1]!=null){
        this.removeFile(this.files[0]);
      }
    });
  }
};

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>
<script type="text/javascript" src="../../js/app.js"></script>

@stop