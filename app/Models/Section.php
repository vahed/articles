<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['id','section_name'];

    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;

    /**
     * Get the articles for the sections.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    

}
