<?php

namespace App\Http\Controllers;

use Image;
use File;
use App\Photo;
use Illuminate\Http\Request;
use App\Classes\ImageCropper;

class ImageHelperController extends Controller
{
	public function index(Request $request)
	{

		// find the photo record in the database
		$photo = json_decode( $request->get('photo') );
		$photo = Photo::find($photo->id);

		$dir = $photo->dir() . $request->get('dir') . '/';

		// directory checks
		Photo::checkDirectory($photo->dir());
		Photo::checkDirectory($dir);

		if($request->get('multi') != 'true') {

			$files = File::allFiles($photo->dir());

			if(is_array($files)){
				foreach($files as $file){
					if($photo->multiple != true) {
						File::delete($dir . $file->getFilename());
					}
				}
			}else{
				if($photo->multiple != true) {
					File::delete($dir . $files->getFilename());
				}
			}

		}


		$width = $request->get('width');
		$height = $request->get('height');
		$x = $request->get('x');
		$y = $request->get('y');

		// make a new image cropper from the photo object
		// crop it

		$imageCropper = ImageCropper::make($photo)
									->crop($width, $height, $x, $y)
									->image->save($dir . $photo->filename);

		return response()->json(['croppedImage' =>  $dir . $photo->filename], 200 );
	}
}

