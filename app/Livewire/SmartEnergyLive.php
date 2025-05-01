<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SmartEnergy;
use Illuminate\Support\Facades\Auth;

class SmartEnergyLive extends Component
{
    public $energyData = [];

    public function loadData()
    {
        $threshold = 5; // detik
        $raw = SmartEnergy::where('id_user', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('id_device')
            ->map(fn($items) => $items->first());

        // tambahkan status aktif
        $this->energyData = $raw->map(fn($item) => [
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
        return view('livewire.smart-energy-live');
    }
}
