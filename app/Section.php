<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasPhotos;
class Section extends Model
{
    use HasPhotos;
    use SoftDeletes;    
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $appends = [
        'original',
    ];

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];
}