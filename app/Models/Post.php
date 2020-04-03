<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    //
    protected $fillable = [
        'name', 'details', 'user_id', 'category_id'
    ];
    public function searchableAs()
    {
        return 'posts_index';
    }
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
//        return $this->toArray();
        return [
            'id' => $this->id,
            'writer' => $this->user->name,
            'category' => $this->category->name,
            'name' => $this->name
        ];
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
