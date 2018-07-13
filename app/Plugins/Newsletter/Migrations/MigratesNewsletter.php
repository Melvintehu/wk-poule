<?php 

use App\Plugins\Interfaces\Migratable;
use Artisan;

class MigratesNewsletter implements Migratable 
{

    private $path = "App\Plugins\Newsletter\Migrations";

    public function __construct() 
    {

    }

    private static function migrate() 
    {
        Artisan::call("migrate", ["--path" + $this->path]);
    }

}