<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        dd($request->all());
    }
}
