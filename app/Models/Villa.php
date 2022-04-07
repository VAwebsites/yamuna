<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Villa extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'description',
        'bhk',
        'sq_feet',
        'land_size',
        'price',
        'thumbnail',
    ];

    protected $searchableFields = ['*'];

    public function villaImages()
    {
        return $this->hasMany(VillaImage::class);
    }
}
