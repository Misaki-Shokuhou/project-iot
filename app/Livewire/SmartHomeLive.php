<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SmartHome;
use Illuminate\Support\Facades\Auth;

class SmartHomeLive extends Component
{
    public $homeData = [];

    public function loadData()
    {
        $threshold = 5; // detik
        $raw = SmartHome::where('id_user', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy('id_device')
            ->map(fn($items) => $items->first());

        // tambahkan status aktif
        $this->homeData = $raw->map(fn($item) => [
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
        return view('livewire.smart-home-live');
    }
}
