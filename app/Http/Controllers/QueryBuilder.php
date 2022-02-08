<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilder extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = DB::table('customers')->get();

        print '<table border>';
            print '<th>';
                foreach($users[0] as $key => $value) {
                    print '<td><b>' . $key . '</b></td>';
                };
            print '</th>';

            foreach($users as $child) {
                print '<tr>';
                    foreach($child as $key => $child_value) {
                        print '<td>' . $child_value .  '</td>';
                    };
                print '</tr>';
            };
        print '</table>';
        return;
    }
}
