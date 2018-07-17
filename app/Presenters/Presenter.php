<?php 

namespace App\Presenters;

use Illuminate\Support\Facades\Schema;


abstract class Presenter 
{
    protected $instance;

    public function __construct($instance)
    {
        $this->instance = $instance;
    }

    public function __get($property)
    {

        if(method_exists($this, $property)) {
            return call_user_func([$this, $property]);
        } else if(Schema::hasColumn($this->instance->getTable(), $property)) {
            return $this->instance->$property;
        }

        $message = '%s does not respond to the "%s" property or method.';
        throw new \Exception(sprintf($message, static::class, $property));

    }

}

