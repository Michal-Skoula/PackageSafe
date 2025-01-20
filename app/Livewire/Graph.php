<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Tower;
use Livewire\Component;

class Graph extends Component
{
	public string $graph_id, $data_type, $graph_type, $fill_color, $outline_color, $tower_name = 'unknown';
	public ?array $dates, $values;
	public int $tower_id;

	public function getData() : void
	{
		if(Day::isValidDataType($this->data_type)) {

			$days = array_reverse(Day::getAllDaysAvg($this->data_type, $this->tower_id));
			$this->tower_name = Tower::find($this->tower_id)->name;

			if($days) {
				foreach($days as $day) {
					$this->dates[] = $day['date'];
					$this->values[] = $day['value'];
				}
			} else {
				$this->dates = $this->values = null;
			}

		}
	}
	public function mount($graph_id, $data_type, $tower_id, $graph_type = 'line', $fill_color = '', $outline_color = '') : void
	{
		$this->graph_id = $graph_id;
		$this->graph_type = $graph_type;
		$this->tower_id = $tower_id;
		$this->data_type = $data_type;
		$this->fill_color = $fill_color;
		$this->outline_color = $outline_color;

		$this->getData();
	}

    public function render()
    {
        return view('livewire.graph');
    }
}
