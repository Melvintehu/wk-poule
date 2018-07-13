<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity;
use Illuminate\Support\Facades\Response;
use App\Classes\FileGenerator\FileGenerator;
use Illuminate\Support\Facades\Artisan;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::all();

        return response()->json($entities, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entity = Entity::create($request->all());

        FileGenerator::generateController($entity);

        Artisan::call("make:model", ['name' => $entity->name]);
       

        // generate 
$txt = "import Model from '../core/models/Model';
import Validator from '../app/Validator/Validator';
import WalkThrough from '../app/WalkThrough/WalkThrough';

class {$entity->name} extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            
        };

    }


}

export default {$entity->name};
";

        FileGenerator::createFile([
            'fileName' =>  ucfirst($entity->name) . '.js', 
            'directory' => '../resources/assets/js/cms/models/', 
            'contents' => $txt
        ]);

        /**
         * Get all the entities and generate a Objects.js file
         */
        $entities = Entity::all();
        FileGenerator::generateEntitiesFile($entities);
        FileGenerator::generateApi($entity);
            
        return Response()->json($entity, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = Entity::find($id);
        return response()->json($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Entity::find($id)->update($request->all());
        return response()->json([], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Entity::find($id)->delete();
        return response()->json([], 200);
    }
}
