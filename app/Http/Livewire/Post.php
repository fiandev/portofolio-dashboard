<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Trix;

class Post extends Component
{
    public $title;
    public $content;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trix_value_updated($value){
        $this->content = $value;
    }

    public function save(){
        dd([
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    public function render()
    {
        return view('livewire.post');
    }
}