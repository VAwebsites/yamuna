<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomepageBanner extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['banner', 'homepage_setting_id'];

    protected $searchableFields = ['*'];

    protected $table = 'homepage_banners';

    public function homepageSetting()
    {
        return $this->belongsTo(HomepageSetting::class);
    }
}
