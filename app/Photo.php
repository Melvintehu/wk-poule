<?php
namespace App;

use File;
use Image;
use Carbon\Carbon;
use App\Classes\ImageCropper;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Process\Process;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
	use SoftDeletes;    
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public $multiple;

	protected $fillable = [
		'filename',
		'type',
		'model_id',
	];

	public static function multiple()
	{
		$photo = new Self();
		$photo->multiple = true;
		return $photo;
	}

	public function dir()
	{
		$dir = 'images/' . $this->type . '/';
		Self::checkDirectory($dir);

		$dir .= $this->model_id . '/';
		Self::checkDirectory($dir);

		return $dir;
	}

	private static function uniqueFilename($file)
	{
		return Carbon::now()->toDateString() . ' ' .Carbon::now()->second . '-' . $file->getClientOriginalName();
	}

	public static function checkDirectory($dir)
	{
		if(!is_dir($dir)) {
			mkdir($dir);
		}
	}

	public static function exists($type, $model_id)
	{
		return Photo::where([
            'type' => $type,
            'model_id' => $model_id
        ])->first();
	}

	public static function makeOrUpdate($type, $model_id, $filename, $multi)
	{
		$photo = Self::exists($type, $model_id);

		// if photo is null
        if($photo === null) {
            $photo = Photo::create([
	            'filename' => $filename,
                'type' => $type,
                'model_id' => $model_id
            ]);
        }else{
        	// else delete the reference
            if(file_exists($photo->dir() . $photo->filename)){
            	if(!$multi) {
	                File::delete($photo->dir() . $photo->filename);
            	}else{
					$photo = Photo::create([
						'filename' => $filename,
						'type' => $type,
						'model_id' => $model_id
					]);
					return $photo;
				}
            }

            // set new filename
            // update photo
            $photo->filename = $filename;
            $photo->update();
        }
        return $photo;
	}



	public static function forModel($type, $model_id, $file, $multi = false)
	{
		// Self::checkMigration();
		$filename = Self::uniqueFilename($file);

		$photo = Photo::makeOrUpdate(
			$type,
			$model_id,
			$filename,
			$multi
		);


        // save the image
    // checks if the directory exists  else makes that directory
        Self::checkDirectory($photo->dir());
        Image::make($file)->encode('png', 35)->save($photo->dir() . $photo->filename);
		return $photo;
	}





	// 1. run composer
	// 2. run npm
	// 3. todo make migrations
	// 4. run migration


	// private static function checkMigration()
	// {
	// 	if(!Schema::hasTable('photos')) {
	// 		$process = new Process('php artisan migrate');
	// 		$process->setWorkingDirectory(base_path());
	// 		$process->run();

	// 		if (!$process->isSuccessful()) {
	// 		    throw new ProcessFailedException($process);
	// 		}
	// 	}
	// }

}
