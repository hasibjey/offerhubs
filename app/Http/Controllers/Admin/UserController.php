<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * get data and view in table
     */
    public function index(Request $request)
    {
        $page = 10;
        $search = $request->search;
        $pagination = $request->pagination? $request->pagination : $page;
        $items = User::orderBy('created_at', 'DESC')->select('id', 'name', 'phone', 'email');
        if(!is_null($search))
        {
            $items = $items->where('name', 'LIKE', '%'. $search .'%');
        }

        $items = $items->paginate($pagination);

        return view('admin.pages.users.users', compact('items', 'search', 'pagination'));
    }

    /**
     * view specific information base on id
     */
    public function view($id)
    {
        # code...
    }
}
