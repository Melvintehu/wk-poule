<?php 
namespace App\Plugins;



abstract class Plugin 
{
    
    protected $migrations = [];

    public function __construct() 
    {
        this.boot();
        this.migrate();
    }

    public abstract function boot();


    private function migrate() 
    {
        foreach($migrations as $plugin => $migrationClass) 
        {
            $migrationClass::migrate();
        }
    }

}