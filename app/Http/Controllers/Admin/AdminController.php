<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * display information in table
     * view blade file
     */
    public function index()
    {
        $items = $this->getData();
        $count = count($items);
        return view('admin.pages.admins.admins', compact('items', 'count'));
    }

    /**
     * Store data in database collecting by from
     */
    public function store(Request $request)
    {
        // from field validation
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:' . Admin::class],
            'type' => ['required'],
        ]);

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make(1234),
            'created_at' => Carbon::now()
        ]);

        toast('Inserted Successfully!', 'success');
        return redirect()->back();
    }

    /**
     * get single data in database base on specific id
     */
    public function show($id)
    {
        $item = Admin::find($id);
        return response()->json($item);
    }

    /**
     * update data in database base on specific id
     */
    public function update(Request $request)
    {
        Admin::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
        ]);

        toast('Updated Successfully!', 'success');
        return redirect()->back();
    }

    /**
     * Trash data in database base on specific id
     */
    public function trash($id)
    {
        Admin::find($id)->delete();
        toast('Deleted Successfully!', 'success');
        return redirect()->back();
    }




    /**
     * collect database data
     */
    public function getData()
    {
        return Admin::orderBy('created_at', 'DESC')->get();
    }
}
