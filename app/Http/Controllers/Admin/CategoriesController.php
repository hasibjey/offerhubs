<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class CategoriesController extends Controller
{
    /**
     * display category data in category table
     * view categories page
     */
    public function index(Request $request)
    {
        $page = 10;
        $navigation = Navigation::all();
        $items = DB::table('categories')
        ->leftJoin('navigations', 'categories.nav_id', 'navigations.id');

        if($request->search != null)
        {
            $items = $items
            ->where('categories.category_bn', 'LIKE', '%' . $request->search . '%')
            ->orWhere('categories.category_en', 'LIKE', '%' . $request->search . '%')
            ->orWhere('navigations.nav_bn', 'LIKE', '%' . $request->search . '%')
            ->orWhere('navigations.nav_en', 'LIKE', '%' . $request->search . '%');
        }

        if($request->pagination != null)
        {
            $page = $request->pagination;
        }

        $items = $items->select('categories.id', 'categories.category_bn', 'categories.category_en', 'categories.slug', 'categories.status', 'categories.image', 'categories.created_at', 'navigations.nav_bn')
        ->orderBy('categories.created_at', 'DESC')->paginate($page);
        $search = $request->search;
        $pagination = $request->pagination ? $request->pagination : $page;

        return view('admin.pages.categories.categories', compact('navigation', 'items', 'search', 'pagination'));
    }

    /**
     * category data store in database collect by category form
     */
    public function store(Request $request)
    {
        $image_url = 'assets/images/category.png';
        $request->validate([
            'navigation' => ['required', 'string'],
            'category_bn' => ['required', 'string', 'unique:' . Category::class],
            'category_en' => ['required', 'string', 'unique:' . Category::class],
            'slug' => ['required', 'string', 'unique:' . Category::class],
            'status' => ['required'],
        ]);

        if($request->hasFile('image'))
        {
            $image_url = 'images/categories/' . date('YmdHis') . random_int(0,999) . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path($image_url));
        }

        Category::insert([
            'category_bn' => $request->category_bn,
            'category_en' => $request->category_en,
            'slug' => $request->slug,
            'nav_id' => $request->navigation,
            'status' => $request->status,
            'image' => $image_url,
            'created_at' => Carbon::now()
        ]);

        toast('Category data inserted successfully!', 'success');
        return redirect()->back();
    }

    /**
     * get single data in database base on specific id
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * update category data in database base on specific id
     */
    public function update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $old_image_url = Category::find($request->id)->image;
            if ($old_image_url != 'assets/images/category.png')
            unlink(public_path($old_image_url));

            $image_url = 'images/categories/' . date('YmdHis') . random_int(0, 999) . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path($image_url));

            Category::find($request->id)->update([
                'category_bn' => $request->category_bn,
                'category_en' => $request->category_en,
                'slug' => $request->slug,
                'nav_id' => $request->navigation,
                'status' => $request->status,
                'image' => $image_url,
            ]);

        } else {

            Category::find($request->id)->update([
                'category_bn' => $request->category_bn,
                'category_en' => $request->category_en,
                'slug' => $request->slug,
                'nav_id' => $request->navigation,
                'status' => $request->status,
            ]);
        }

        toast('Category data updated successfully!', 'success');
        return redirect()->back();
    }

    /**
     * category data trash in database base on specific id
     */
    public function trash($id)
    {
        $delete = Category::find($id)->delete();

        toast('Category data deleted successfully!', 'success');
        return redirect()->back();
    }
}
