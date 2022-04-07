<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\HomepageBanner;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomepageSettingHomepageBannersDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public HomepageSetting $homepageSetting;
    public HomepageBanner $homepageBanner;
    public $homepageBannerBanner;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New HomepageBanner';

    protected $rules = [
        'homepageBannerBanner' => ['image', 'max:1024'],
    ];

    public function mount(HomepageSetting $homepageSetting)
    {
        $this->homepageSetting = $homepageSetting;
        $this->resetHomepageBannerData();
    }

    public function resetHomepageBannerData()
    {
        $this->homepageBanner = new HomepageBanner();

        $this->homepageBannerBanner = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHomepageBanner()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.homepage_setting_homepage_banners.new_title'
        );
        $this->resetHomepageBannerData();

        $this->showModal();
    }

    public function editHomepageBanner(HomepageBanner $homepageBanner)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.homepage_setting_homepage_banners.edit_title'
        );
        $this->homepageBanner = $homepageBanner;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->homepageBanner->homepage_setting_id) {
            $this->authorize('create', HomepageBanner::class);

            $this->homepageBanner->homepage_setting_id =
                $this->homepageSetting->id;
        } else {
            $this->authorize('update', $this->homepageBanner);
        }

        if ($this->homepageBannerBanner) {
            $this->homepageBanner->banner = $this->homepageBannerBanner->store(
                'public'
            );
        }

        $this->homepageBanner->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', HomepageBanner::class);

        collect($this->selected)->each(function (string $id) {
            $homepageBanner = HomepageBanner::findOrFail($id);

            if ($homepageBanner->banner) {
                Storage::delete($homepageBanner->banner);
            }

            $homepageBanner->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetHomepageBannerData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->homepageSetting->homepageBanners as $homepageBanner) {
            array_push($this->selected, $homepageBanner->id);
        }
    }

    public function render()
    {
        return view('livewire.homepage-setting-homepage-banners-detail', [
            'homepageBanners' => $this->homepageSetting
                ->homepageBanners()
                ->paginate(20),
        ]);
    }
}
