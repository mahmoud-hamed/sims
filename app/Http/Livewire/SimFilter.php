<?php

namespace App\Http\Livewire;

use App\Models\Sim;
use Livewire\Component;
use Livewire\WithPagination;


class SimFilter extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $searchh = '';
    public $search = 'all';
    public function render()
    {
        $search = $this->search;
        $searchh = $this->searchh;

        if ($this->search == 'all') {
            $sims = Sim::where('number' , 'like' , '%' . $this->searchh . '%')->orderBy('id', 'DESC')->paginate(5);
            return view('livewire.sim-filter', compact('sims'));
        }
        $sims = Sim::where('number' , 'like' , '%' . $this->searchh . '%')->where('period', 'like' , '%' .  $this->search . '%')->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.sim-filter', compact('sims'));
    }
}
