<?php

namespace App\Livewire;

use App\Models\Day;
use Livewire\Component;

class CurrentReadingsCard extends Component
{
	public int|float|null $value = 0;

	public string $unit_of_measurement, $svg_path, $name, $tower_id, $data_type;

	public function update()
	{
		$this->value = Day::latest($this->data_type, $this->tower_id) ?? null;
	}

	public function mount($name, $unit_of_measurement, $svg_path, $tower_id, $data_type)
	{
		$this->tower_id = $tower_id;
		$this->name = $name;
		$this->unit_of_measurement = $unit_of_measurement;
		$this->svg_path = $svg_path;
		$this->data_type = $data_type;

		$this->update();
	}
    public function render()
    {
        return view('livewire.current-readings-card');
    }
}
