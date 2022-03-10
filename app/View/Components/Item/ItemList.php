<?php

namespace App\View\Components\Item;

use Illuminate\View\Component;

class ItemList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $titles;
    public $items;
    
    public function __construct($titles, $items)
    {
        $this->titles = $titles;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item.item-list');
    }
}
