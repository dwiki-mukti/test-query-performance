<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $startAt = microtime(true);

    /**
     * conclusion: 'federated' faster than 'join where' faster than 'join and'
     */

    /**
     * JOIN VS FEDERATED
     */
    // $data = DB::select("
    //     select
    //         notes.title,
    //         notes.content,
    //         notes.viewer,
    //         users.name,
    //         users.email,
    //         users.password
    //     from users 
    //     inner join notes on notes.user_id = users.id
    //     where users.email = 'nasim.adriansyah@yahoo.com'
    // ");

    $data = DB::select("
        select
            title,
            content,
            viewer,
            name,
            email,
            password
        from user_note_caches 
        where email = 'nasim.adriansyah@yahoo.com'
    ");

    // $data = DB::select("
    //     select
    //         notes.title,
    //         notes.content,
    //         notes.viewer,
    //         users.name,
    //         users.email,
    //         users.password
    //     from notes 
    //     inner join (
    //         select
    //             id,
    //             title,
    //             content,
    //             viewer
    //         from users 
    //         where email = 'nasim.adriansyah@yahoo.com'
    //     ) as users on notes.user_id = users.id
    // ");






    /**
     * CALC VS FEDERATED
     */
    // $data = DB::select("
    //     select
    //         users.name,
    //         SUM(notes.viewer) as total_viewer
    //     from users 
    //     inner join notes on notes.user_id = users.id
    //     and users.email = 'nasim.adriansyah@yahoo.com'
    //     group by users.id
    // ");

    // $data = DB::select("
    //     select
    //         users.name,
    //         SUM(notes.viewer) as total_viewer
    //     from users 
    //     inner join notes on notes.user_id = users.id
    //     where users.email = 'nasim.adriansyah@yahoo.com'
    //     group by users.id
    // ");

    // $data = DB::select("
    //     select
    //         name,
    //         total_viewer
    //     from note_counts 
    //     where email = 'nasim.adriansyah@yahoo.com'
    // ");

    $endAt = microtime(true);



    return response()->json([
        'accumulate_time' => ($endAt - $startAt),
        'data' => $data,
        // 'data2' => $data2,
        'message' => 'oke'
    ]);
});
