@extends('cms.master')

@section('title')
    Pagina's secties overzicht
@stop

@section('content')
    <h1> Pagina secties overzicht </h1>
    <hr>

    <div class="row">
        <div class="col-lg-12"> 
            @foreach($data['pages'] as $page) 
            <h1> Pagina {{ $page->name }} </h1>
            <hr>
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                           
                            <div class="panel-body">
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        @if(!$page->sections->isEmpty())
                                        <div class="table-responsive">        
                                            <table class="table table-hover">
                                               
                                                <thead>
                                                    <tr>
                                                        <th>#<span class='ion-arrow-down-b table-head'></span></th>
                                                        <th>Title</th>
                                                        <th>body</th>
                                                        <th>page</th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($page->sections as $object)
                                                        <tr>
                                                            <td>{{ $object->id }}</td>
                                                            <td>{{ $object->title }}</td>
                                                            <td>{{ $object->body }}</td>
                                                            <td>{{ $object->page['name'] }}</td>

                                                            <!-- Aanpassen form -->
                                                            <td>
                                                                 {!! Form::open(
                                                                    array(
                                                                        'method' => 'GET',
                                                                        'action' => ['SectionController@edit', $object->id]
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
                                                                        'action' => ['SectionController@destroy', $object->id]
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
                                        @else
                                                        <tr>
                                                            <td>
                                                              <p> Er zijn nog geen secties toegevoegd aan deze pagina. Klik <a href="/cms/section/create"> hier </a> om een sectie aan deze pagina toe te voegen. </p>
                                                              </td>
                                                        </tr>
                                                    @endif
                                       
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                </div> <!-- End row -->
                @endForeach



        </div>
    </div>
@stop
