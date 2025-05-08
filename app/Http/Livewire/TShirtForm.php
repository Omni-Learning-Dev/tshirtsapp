<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class TShirtForm extends Component
{
    use WithFileUploads;

    // Form Fields
    public $quantity = 1;
    public $size = 'M';
    public $color = 'Black';
    public $logo;
    public $customization = false;
    public $notes;

    // Validation Rules
    protected $rules = [
        'quantity' => 'required|integer|min:1',
        'size' => 'required|in:XS,S,M,L,XL,XXL',
        'color' => 'required',
        'logo' => 'nullable|image|max:1024', // 1MB Max
        'notes' => 'nullable|string|max:500',
    ];

    /**
     * Submit the form
     */
    public function submit()
    {
        $this->validate();

        // Process the logo upload if exists
        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
        }

        // Here you would save the order to database
        // For now, we just reset and show success message

        session()->flash('message', 'T-Shirt order placed successfully!');

        $this->reset(['quantity', 'size', 'color', 'logo', 'customization', 'notes']);
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.t-shirt-form');
    }
}
