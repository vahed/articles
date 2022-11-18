<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','title', 'created'];

    const UPDATED_AT = NULL;
    const CREATED_AT = null;

    /**
     * Get the section that owns the article.
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
