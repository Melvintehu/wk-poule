<?php 
use App\Plugins\FileSystem\Models\Files;
use Illuminate\Http\Request;

Route::post('file/where', function(Request $request){
    return response()->json(Files::where($request->all())->get());
});


// Route::resource('files', $api_namespace . "FileController");