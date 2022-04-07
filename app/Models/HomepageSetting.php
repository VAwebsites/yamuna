<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomepageSetting extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'project_title',
        'project_location',
        'rera_number',
        'youtube_link',
        'brochure',
        'project_overview',
        'project_type',
        'project_status',
        'address_line_1',
        'address_line_2',
        'contact_number',
        'logo',
        'email',
        'footer_description',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'homepage_settings';

    public function approvedBanks()
    {
        return $this->hasMany(ApprovedBank::class);
    }

    public function homepageBanners()
    {
        return $this->hasMany(HomepageBanner::class);
    }
}
