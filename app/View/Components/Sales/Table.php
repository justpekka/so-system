<?php

namespace App\View\Components\Sales;

use Illuminate\View\Component;

class Table extends Component
{
    /** The alert type, @var string */
    public $type;
    
    /** The data, @var mixed */
    public $data;
    
    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  mixed  $data
     * @return void
     */
    public function __construct($type = null, $data = null)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sales.table', ['type' => $this->type, 'data' => $this->data]);
    }

    public function index()
    {
        return 'table-light';
    }
}
