<?php

namespace App\View\Components;
use Illuminate\View\Component;

class Tag extends Component {

    public $tags;

    public function __construct($tags){
        $this->tags = $tags;
    }


    public function render(){

        return view('components.tags');
    }
}