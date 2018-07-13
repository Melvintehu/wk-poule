<?php

namespace App\Traits;

use App\Photo;

trait HasPhotos{

    public function photo()
    {
        $className = explode("\\", __CLASS__)[1];

        return Photo::where([
            ['model_id', $this->id],
            ['type', strtolower($className)],
        ])->first();
    }

    public function photos()
    {
        $className = explode("\\", __CLASS__)[1];

        return Photo::where([
            ['model_id', $this->id],
            ['type', strtolower($className)],
        ])->get();
    }

    public function getPhotoNotFound()
    {
        return '/images/cms/geen_afbeelding_beschikbaar_gr.gif';
    }

    public function getPhoto($type)
    {
        if(file_exists(public_path() . $this->$type)){
            return $this->$type;
        }
        return $this->getPhotoNotFound();
    }

    public function getLandscapeAttribute()
    {
        if($this->photo() == null) {
            return $this->getPhotoNotFound();
        }

        $className = explode("\\", __CLASS__)[1];
        return "/images/" . strtolower($className) . "/{$this->id}/landscape/{$this->photo()->filename}";
    }

    public function getLandscapesAttribute()
    {
        $className = explode("\\", __CLASS__)[1];

        $photos = collect($this->photos());

        $photos = $photos->map(function($item, $key) use($className){
            return "/images/" . strtolower($className) . "/{$this->id}/landscape/{$item->filename}";
        });

        return $photos;
    }

    public function getPortraitAttribute()
    {
        if($this->photo() == null) {
            return $this->getPhotoNotFound();
        }

        $className = explode("\\", __CLASS__)[1];
        return "/images/" . strtolower($className) . "/{$this->id}/portrait/{$this->photo()->filename}";
    }

    public function getOriginalAttribute()
    {
        if($this->photo() == null) {
            return $this->getPhotoNotFound();
        }

        $className = explode("\\", __CLASS__)[1];
        return "/images/" . strtolower($className) . "/{$this->id}/{$this->photo()->filename}";
    }

    public function getThumbnailAttribute()
    {
        if($this->photo() == null) {
            return $this->getPhotoNotFound();
        }

        $className = explode("\\", __CLASS__)[1];
        return "/images/" . strtolower($className) . "/{$this->id}/thumbnail/{$this->photo()->filename}";
    }

}

?>