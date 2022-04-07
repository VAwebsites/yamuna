<?php

namespace App\Http\Livewire;

use App\Models\Villa;
use Livewire\Component;
use App\Models\VillaImage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VillaVillaImagesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Villa $villa;
    public VillaImage $villaImage;
    public $villaImageImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New VillaImage';

    protected $rules = [
        'villaImageImage' => ['image', 'max:1024'],
    ];

    public function mount(Villa $villa)
    {
        $this->villa = $villa;
        $this->resetVillaImageData();
    }

    public function resetVillaImageData()
    {
        $this->villaImage = new VillaImage();

        $this->villaImageImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newVillaImage()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.villa_villa_images.new_title');
        $this->resetVillaImageData();

        $this->showModal();
    }

    public function editVillaImage(VillaImage $villaImage)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.villa_villa_images.edit_title');
        $this->villaImage = $villaImage;

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

        if (!$this->villaImage->villa_id) {
            $this->authorize('create', VillaImage::class);

            $this->villaImage->villa_id = $this->villa->id;
        } else {
            $this->authorize('update', $this->villaImage);
        }

        if ($this->villaImageImage) {
            $this->villaImage->image = $this->villaImageImage->store('public');
        }

        $this->villaImage->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', VillaImage::class);

        collect($this->selected)->each(function (string $id) {
            $villaImage = VillaImage::findOrFail($id);

            if ($villaImage->image) {
                Storage::delete($villaImage->image);
            }

            $villaImage->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetVillaImageData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->villa->villaImages as $villaImage) {
            array_push($this->selected, $villaImage->id);
        }
    }

    public function render()
    {
        return view('livewire.villa-villa-images-detail', [
            'villaImages' => $this->villa->villaImages()->paginate(20),
        ]);
    }
}
