<?php 

use App\Plugins\Plugin;

class Newsletter extends Plugin
{

    protected function boot()
    {
        $this->migrations['Newsletter'] = MigratesNewsletter::class; 
    } 

}