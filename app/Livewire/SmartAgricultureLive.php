<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SmartAgriculture;
use Illuminate\Support\Facades\Auth;

class SmartAgricultureLive extends Component
{
    public $agriData = [];

    public function loadData()
    {
        $threshold = 5; // detik
        $raw = SmartAgriculture::where('id_user', Auth::id())
            ->orderBy('updated_at','desc')
            ->get()
            ->groupBy('id_device')
            ->map(fn($items) => $items->first());

        // tambahkan status
        $this->agriData = $raw->map(fn($item) => [
            'model'     => $item,
            'is_active' => Carbon::now()->diffInSeconds($item->updated_at) <= $threshold,
        ]);        
    }

    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.smart-agriculture-live');
    }
}
