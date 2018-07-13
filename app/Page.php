<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// models
use App\Section;
use App\Classes\FileHelper;
use App\Classes\Slot;

use File;

class Page extends Model
{
	private $directory = '/resources/views/pages';
	private $slot;

    protected $fillable = [
    	'name',
    ];

    public function availableSlots() 
    {		
    	// null object 
    	$nullSlot = new Slot;
    	$nullSlot->position = 0;
    	
    	return Slot::slotSpaces($this)
    	->filter(function($slot){
    		return $slot->isAvailable();
    	})->prepend($nullSlot);
    }

    public function getContents()
    {	 
		return FileHelper::getFileContents($this->directory, $this->name . '.blade.php');
    }

    public function sections()
    {
    	return $this->hasMany('App\Section');
    }

    public function nonExistent()
    {
    	if( count(Page::where('name', $this->name)->get()) == 0 ) {
    		return true;
    	}

    	return false;
    }

    public static function createFromDirectory($dir) 
    {
    	FileHelper::getFilesFromDirectory($dir)
        ->getFiles()
    	->each(function($file)
    	{
            $page = Page::extractPage($file);
            if( $page->nonExistent() ) {
            	$page->save();
            }
    	});
    }

    private static function extractPage($file)
    {	
    	$page = new Page;
    	$page->name = str_replace('.blade.php', '', $file->getFilename()); 
    	return $page;
    }

}
