@extends('cms.master')

@section('title')
    Projecttag toevoegen    
@stop

@section('content')
    <h1>Project toevoegen </h1>
    <hr>

    <div class="row">
        <div class="col-lg-12"> 
            <hr>
            <div class="row">                 
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        {!! Form::open(['method' => 'POST', 'action' => 'ProjectController@store' ]) !!}
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            {!! Form::label('name', ' De naam van het project ') !!} 
                                                            {!! Form::text('name', null, ['required'=>'true', 'class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                        <tr>
                                                           <td>
                                                                {!! Form::label('description', ' De beschrijving van het project') !!} 
                                                                {!! Form::text('description', null, ['required'=>'true','class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>

                                                        <tr>
                                                           <td>
                                                                {!! Form::label('residence', ' Plaatsnaam van het project') !!} 
                                                                {!! Form::text('residence', null, ['required'=>'true','class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                           <td>
                                                                {!! Form::label('client', ' De naam van de klant ') !!} 
                                                                {!! Form::text('client', null, ['required'=>'true','class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>


                                                        <tr>
                                                           <td>
                                                                {!! Form::label('date', 'De datum van het project ') !!} 
                                                                {!! Form::date('date', null, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>

                                                        <tr>
                                                           <td>
                                                                {!! Form::label('discipline_id', 'De discipline van het project ') !!} 
                                                                {!! Form::select('discipline_id', $disciplines, null, ['class' => 'form-control']) !!}
                                                           </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <input type="submit" value="opslaan" class="btn btn-primary" name="opslaan">   
                                                            </td>
                                                        </tr> 

                                                    </tbody>
                                                </table>
                                            {!! Form::close() !!}
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
