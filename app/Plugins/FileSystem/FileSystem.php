<?php 

use App\Plugins\Plugin;

class FileSystem extends Plugin
{

    protected function boot()
    {
        $this->migrations['FileSystem'] = MigratesFileSystem::class; 
    } 

    public static function routes() 
    {
        
    }

}