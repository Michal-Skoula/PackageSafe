<?php

namespace App\Livewire;

use App\Models\Day;
use Livewire\Component;

class Graph extends Component
{
	public string $data_type;
	public string $graph_type;
	public int $tower_id;
	public ?array $dates;
	public ?array $values;

	public function getData() : void
	{
		if(Day::isValidDataType($this->data_type)) {
			$days = Day::getAllDaysAvg($this->data_type, $this->tower_id);

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
	public function mount($data_type, $tower_id, $graph_type = 'line') : void
	{
		$this->data_type = $data_type;
		$this->tower_id = $tower_id;
		$this->graph_type = $graph_type;

		$this->getData();
	}

    public function render()
    {
        return view('livewire.graph');
    }
}
