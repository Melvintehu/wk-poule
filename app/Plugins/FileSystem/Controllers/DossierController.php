<?php

namespace App\Plugins\FileSystem\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Classes\FileGenerator\FileGenerator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Plugins\FileSystem\Models\Dossier;



class DossierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
  

   
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
        $folder_id = $request->get('folder_id');
        $file = $request->file('file');
        Storage::disk('public');
        if($folder_id === null || !$folder_id) {
            $dossier = Dossier::create([
                'filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
            ]);

            $contents = file_get_contents($file->getPathname());

            Storage::disk('public')->put('cloud-drive-files/folders/root/' . $dossier->id . '-' .  $file->getClientOriginalName(), $contents);
      
            
        } else {
            
            $dossier = Dossier::create([
                'filename' => $file->getClientOriginalName(),
                'folder_id' => $folder_id,
                'extension' => $file->getClientOriginalExtension(),
            ]);
            $contents = file_get_contents($file->getPathname());

            Storage::disk('public')->put('cloud-drive-files/folders/'. $dossier->folder_id . "/" .  $dossier->id . '-' .  $file->getClientOriginalName(), $contents );    
   
                
            return response()->json($folder_id , 200);
        }
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
    public function edit(Dossier $dossier)
    {
        $url = "/storage/cloud-drive-files/folders/" . $dossier->folder_id . "/" . $dossier->id . "-" . $dossier->filename;
        $dossier->path = $url;
        return response()->json($dossier, 200);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $dossier = Dossier::find($id)->remove();
    }



}
