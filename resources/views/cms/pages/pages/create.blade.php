@extends('cms.master')

@section('title')
    Pagina's laden   
@stop

@section('content')
    <h1>Pagina's inladen </h1>
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
                                                {!! Form::open(['method' => 'POST', 'action' => 'PageController@store' ]) !!}
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                               <td>

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
