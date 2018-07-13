<?php

namespace App\Plugins\FileSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Dossier extends Model
{
  
    protected $fillable = [
        'filename',
        'folder_id',
        'extension',
    ];
    
    public function remove()
    {
        if($this->folder_id === null) {
            Storage::disk('public')->delete('cloud-drive-files/folders/root/' . $this->id . '-' . $this->filename);
        } else {
            Storage::disk('public')->delete('cloud-drive-files/folders/'. $this->folder_id . "/" .  $this->id . '-' . $this->filename );
        }
        $this->delete();
    }

}
