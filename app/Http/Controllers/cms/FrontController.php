<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity;
class FrontController extends Controller
{   

    public function plugin() 
    {
        return view('cms.Core.plugin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $coreEntities = [
            'entity',
            'section',
            'navGroup',
            'settings',
        ];

        $entity = $request->get('type');
        
        if( in_array( $entity, $coreEntities ) ) {
            return view("cms.Core.{$entity}.index");
        }
        
        $entity = Entity::where('name', $entity)->first();

        return view('cms.Core.index', compact(
            'entity'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request)
    {
        $type = ucfirst($request->get('type'));
        $id = $request->get('id');

        $className = 'App\\' . $type;
        $object = $className::find($id);
        return view('cms.Core.edit', compact(
            'object',
            'type',
            'id'

        ));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
