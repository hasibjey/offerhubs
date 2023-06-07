<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\SMS;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Company;
use App\Models\Navigation;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use App\Models\publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    private function FrontendController()
    {
        if (is_null(Company::first())) {
            return view('admin.pages.company.install');
        }
    }
    /**
     * view index page
     */
    public function welcome(Request $request)
    {
        if ($request->slug != null) {
            $items = null;
            if ($request->slug == 'publishers') {
                $items = publisher::all();
            } else if ($request->slug == 'authors') {
                $items = Author::all();
            }
            return response()->json($items);
        } else {
            $sliders = DB::table('sliders')->get();
            $categories = DB::table('categories')->where('home_status', 1)->orderBy('home_position')->select('id', 'category_bn')->get();
            return view('welcome', compact('sliders', 'categories'));
        }
    }

    public function categories($slug)
    {
        $category_id = Category::where('slug', $slug)->select('id')->first();
        $product_id = ProductCategory::where('category_id', $category_id->id)->select('product_id')->get();
        if (count($product_id) == 0) {
            toast('Have no product in this category..!', 'error');
            return redirect('/');
        }
        $products = Product::whereIn('id', $product_id)->paginate(1);
        // return response()->json($products);
        return view('frontend.category-product', compact('product_id', 'products'));
    }

    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $images = ProductGallery::where('product_id', $product->id)->get();
        return view('frontend.product-details', compact('product', 'images'));
    }

    public function test()
    {
        // SMS::SMS_API('01945907007', 'Hello new');
    }
}
