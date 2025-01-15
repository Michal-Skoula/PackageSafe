<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Tower;
use Livewire\Component;

class PackageLineView extends Component
{
	public int $tower_id;
	public $tower_name;
	public int $tower_status;

	public $temperature, $humidity, $is_level, $collision;

	public function getData() : void
	{
		$this->temperature 	= Day::latest('temperature', $this->tower_id) ?? 0;
		$this->humidity 	= Day::latest('humidity', $this->tower_id) ?? 0;
		$this->is_level 	= Day::latest('rotation', $this->tower_id) ?? 0;
		$this->collision 	= Day::latest('collision', $this->tower_id) ?? 0;
	}
	public function towers() : void
	{
		$tower = Tower::find($this->tower_id);

		$this->tower_name = $tower->name;
		$this->tower_status = $tower->status ?? 5;
	}

	public function mount($tower_id) : void
	{
		$this->tower_id = $tower_id;
		$this->getData();
		$this->towers();
	}

	public function render()
    {
        return view('livewire.package-line-view');
    }
}
