<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	public $timestamps = false;

    public function author()
    {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function qod()
    {
        return $this->with(['author', 'category'])->take(7)->inrandomorder();
    }
}