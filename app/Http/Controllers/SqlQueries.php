<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SqlQueries extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = DB::select('select * from customers');

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

    // public function insert(Request $request)
    // {
    //     $users = DB::insert('insert into users (id, name) values (?, ?)', [1, 'Marc']);

    //     print "<pre>";
    //     return print_r($users);
    // }

    // public function update(Request $request)
    // {
    //     $affected = DB::update(
    //         'update users set votes = 100 where name = ?',
    //         ['Anita']
    //     );

    //      or use this.
    //    DB::unprepared('update users set votes = 100 where name = "Dries"');
    // }

    // public function delete(Request $request)
    // {
    //     $deleted = DB::delete('delete from users');
    // }

    public function search(Request $request)
    {
        $users = DB::select('select * from customers where customerNumber = :customerNumber', ['customerNumber' => 103]);

        print "<pre>";
        return print_r($users);
    }

    // public function geneStatement(Request $request)
    // {
    //     DB::statement('drop table users');
    // }
}
