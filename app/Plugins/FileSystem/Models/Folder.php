<?php

namespace App\Plugins\FileSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    
    protected $fillable = [
        'name',
        'parent_id',
    ];
    
    public function dossiers() 
    {
        return $this->hasMany("App\Plugins\FileSystem\Models\Dossier");
    }


    public function parent() 
    {
        return Folder::find($this->parent_id);
    }

    public function children() 
    {
        return Folder::where('parent_id', $this->id)->get();
    }

    public function hasChildren() 
    {
        return $this->children()->count() !== 0;
    }

    public function remove() 
    {
        $this->recursiveDelete($this);
    }


    // find the children of the rootFolder
    // foreach child, check if it has children
    // if has no children remove self
    // if has children, repeat above steps

    public function recursiveDelete($folder) 
    {
        if(!$folder->hasChildren()) {
            $folder->dossiers->each->remove();
            $folder->delete();
        } else {
            foreach($folder->children() as $index => $child) {
                $this->recursiveDelete($child);
            }
        }
        
        $folder->dossiers->each->remove();
        $folder->delete();

    }
    
}
