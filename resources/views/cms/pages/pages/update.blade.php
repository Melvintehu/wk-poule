@extends('cms.master')

@section('title')
    Aanpassen
@stop

@section('content')
    <h1>Pagina <span style="font-weight:Bold">{{ $data['page']->name }}</span> beheren </h1>
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
                                           
                                                 {!! Form::model($data['page'],
                                                    array(
                                                        'method' => 'PUT',
                                                        'action' => ['PageController@update', $data['page']->id]
                                                        )
                                                    )
                                                !!}
                                                <thead>
                                                    <tr>    
                                                        <th>
                                                            {!! Form::label('name', ' De pagina naam ') !!} 
                                                        </th>
                                                        <td>  
                                                            {!! Form::text('name', null, ['class' => 'form-control']); !!}
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


            <h1> Secties op deze pagina </h1>
            <hr>
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                           
                            <div class="panel-body">
                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        @if(!$data['page']->sections->isEmpty())
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
                                                    @foreach ($data['page']->sections as $object)
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
           

                <div class="row">


                    <div class="col-md-12">
                        <div class="panel panel-default">
                           
                        <h1> Secties toevoegen aan deze pagina </h1>
                            <div class="panel-body">
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        
                                        <div class="table-responsive">
                                            {!! Form::open(['method' => 'POST', 'action' => 'SectionController@store' ]) !!}
                                                
                                                <table class="table table-hover">
                                                    <tbody>
                                                    
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
                                                                
                                                                {!! Form::hidden('page_id', $data['page']->id, ['class' => 'form-control']); !!} 
                                                           </td>
                                                        </tr>
                                                        

                                                        <tr>
                                                            
                                                           <td>
                                                                {!! Form::label('page_position', 'Op welke volgorde staat deze sectie ? ( De sectie met de  waarde 0 wordt niet op de website weergegeven) ') !!} 
                                                                {!! Form::select('page_position', $data['page_positions'], null, ['class' => 'form-control']); !!} 

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

                </div> <!-- End row -->



        </div>


    </div>

@stop
