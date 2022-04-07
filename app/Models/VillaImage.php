<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VillaImage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['image', 'villa_id'];

    protected $searchableFields = ['*'];

    protected $table = 'villa_images';

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
