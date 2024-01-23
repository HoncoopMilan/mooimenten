<?php

namespace App\Livewire;

use App\Models\Questionnaire;
use Livewire\Component;

class SearchBarQuestionnaire extends Component
{
    public $questionnaires;
    public $searchInput = 'test';

    public function render()
    {
        return view('livewire.search-bar-questionnaire');
    }

    public function search(){
        $this->$questionnaires = Questionnaire::where('name', 'like', '%' . $this->searchInput . '%')->get();
    }
}
