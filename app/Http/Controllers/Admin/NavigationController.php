<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class NavigationController extends Controller
{
    /**
     * display navigation data in category table
     * view categories page
     */
    public function index(Request $request)
    {
        $page = 10;
        $items = Navigation::orderBy('created_at', 'DESC');

        if($request->search != null)
        {
            $items = $items->where('nav_bn', 'LIKE', '%' . $request->search . '%');
        }

        if($request->pagination != null)
        {
            $page = $request->pagination;
        }


        $items = $items->paginate($page);
        $search = $request->search;
        $pagination = $request->pagination? $request->pagination : $page;

        return view('admin.pages.navigation.navigation', compact('items', 'search', 'pagination'));
    }

    /**
     * category data store in database collect by category form
     */
    public function store(Request $request)
    {
        $request->validate([
            'nav_bn' => ['required', 'string', 'unique:' . Navigation::class],
            'nav_en' => ['required', 'string', 'unique:' . Navigation::class],
            'slug' => ['required', 'string', 'unique:' . Navigation::class],
            'status' => ['required'],
            'position' => ['required']
        ]);

        Navigation::insert([
            'nav_bn' => $request->nav_bn,
            'nav_en' => $request->nav_en,
            'slug' => $request->slug,
            'position' => $request->position,
            'status' => $request->status,
            'created_at' => Carbon::now()
        ]);

        toast('Navigation data inserted successfully!', 'success');
        return redirect()->back();
    }

    /**
     * get single data in database base on specific id
     */
    public function show($id)
    {
        $category = Navigation::find($id);
        return response()->json($category);
    }

    /**
     * update category data in database base on specific id
     */
    public function update(Request $request)
    {
        Navigation::find($request->id)->update([
            'nav_bn' => $request->nav_bn,
            'nav_en' => $request->nav_en,
            'slug' => $request->slug,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        toast('Navigation data updated successfully!', 'success');
        return redirect()->back();
    }

    /**
     * category data trash in database base on specific id
     */
    public function trash($id)
    {
        Navigation::find($id)->delete();
        toast('Navigation data deleted successfully!', 'success');
        return redirect()->back();
    }
}
