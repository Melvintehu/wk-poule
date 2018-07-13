@extends('cms.master')

@section('title')
    Pagina's overzicht
@stop

@section('content')
    <h1> Pagina's overzicht </h1>
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
                                            <table class="table table-hover">
                                                <tr> 
                                              
                                                </tr>
                                                <thead>
                                                    <tr>
                                                        <th>#<span class='ion-arrow-down-b table-head'></span></th>
                                                        <th>Naam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['pages'] as $object)
                                                        <tr>
                                                            <td>{{ $object->id }}</td>
                                                            <td>{{ $object->name }}</td>
                                                            <!-- Secties weergave form -->
                                                            <td>
                                                                 {!! Form::open(
                                                                    array(
                                                                        'method' => 'GET',
                                                                        'action' => ['PageController@edit', $object->id]
                                                                        )
                                                                    )
                                                                !!}

                                                                <input type='submit' class='btn btn-primary' value='aanpassen' />
                                                                {!! Form::close() !!}
                                                            </td>


                                                            <!-- Verwijderen form -->
                                                            <td>
                                                                 {!! Form::open(
                                                                    array(
                                                                        'method' => 'DELETE',
                                                                        'action' => ['PageController@destroy', $object->id]
                                                                        )
                                                                    )
                                                                !!}

                                                                <input type='submit' class='btn btn-danger' value='verwijderen' />
                                                                {!! Form::close() !!}
                                                            </td>


                                                        </tr>

                                                    @endforeach

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
