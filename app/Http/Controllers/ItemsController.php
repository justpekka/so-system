<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Items;

class ItemsController extends Controller
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        return $this->index();
    }

    public function index()
    {
        echo "<pre>";
        print_r(
            json_decode(Items::join('item_lists', 'item_logs.item_id', '=', 'item_lists.item_id'))
        );
        return; 
    }
}
