<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NearByLocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['img', 'name', 'order', 'distance'];

    protected $searchableFields = ['*'];

    protected $table = 'near_by_locations';
}
