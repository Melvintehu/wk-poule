<?php 
use App\Plugins\FileSystem\Models\Folder;
use Illuminate\Http\Request;

Route::post('folder/where', function(Request $request){
    return response()->json(Folder::where($request->all())->get());
});

// Route::resource('folder', $api_namespace . 'FolderController');