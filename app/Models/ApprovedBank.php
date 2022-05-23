<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovedBank extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'logo', 'homepage_setting_id', 'order'];

    protected $searchableFields = ['*'];

    protected $table = 'approved_banks';

    public function homepageSetting()
    {
        return $this->belongsTo(HomepageSetting::class);
    }
}
