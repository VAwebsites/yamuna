<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ApprovedBank;
use Livewire\WithFileUploads;
use App\Models\HomepageSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomepageSettingApprovedBanksDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public HomepageSetting $homepageSetting;
    public ApprovedBank $approvedBank;
    public $approvedBankLogo;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ApprovedBank';

    protected $rules = [
        'approvedBankLogo' => ['image', 'max:1024'],
        'approvedBank.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(HomepageSetting $homepageSetting)
    {
        $this->homepageSetting = $homepageSetting;
        $this->resetApprovedBankData();
    }

    public function resetApprovedBankData()
    {
        $this->approvedBank = new ApprovedBank();

        $this->approvedBankLogo = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newApprovedBank()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.homepage_setting_approved_banks.new_title'
        );
        $this->resetApprovedBankData();

        $this->showModal();
    }

    public function editApprovedBank(ApprovedBank $approvedBank)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.homepage_setting_approved_banks.edit_title'
        );
        $this->approvedBank = $approvedBank;

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

        if (!$this->approvedBank->homepage_setting_id) {
            $this->authorize('create', ApprovedBank::class);

            $this->approvedBank->homepage_setting_id =
                $this->homepageSetting->id;
        } else {
            $this->authorize('update', $this->approvedBank);
        }

        if ($this->approvedBankLogo) {
            $this->approvedBank->logo = $this->approvedBankLogo->store(
                'public'
            );
        }

        $this->approvedBank->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ApprovedBank::class);

        collect($this->selected)->each(function (string $id) {
            $approvedBank = ApprovedBank::findOrFail($id);

            if ($approvedBank->logo) {
                Storage::delete($approvedBank->logo);
            }

            $approvedBank->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetApprovedBankData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->homepageSetting->approvedBanks as $approvedBank) {
            array_push($this->selected, $approvedBank->id);
        }
    }

    public function render()
    {
        return view('livewire.homepage-setting-approved-banks-detail', [
            'approvedBanks' => $this->homepageSetting
                ->approvedBanks()
                ->paginate(20),
        ]);
    }
}
