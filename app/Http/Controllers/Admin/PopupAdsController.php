<?php

namespace App\Http\Controllers\Admin;

use Image;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PopupAds;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class PopupAdsController extends Controller
{
    /**
     * display popup ads data in popup ads table
     * view popup ads pages
     */
    public function index()
    {
        $items = PopupAds::orderBy('created_at', 'DESC')->select('id', 'image', 'status', 'url')->get();
        return view('admin.pages.popupads.popupads', compact('items'));
    }

    /**
     * store popup ads data in database collect by popup ads form
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required'],
            'status' => ['required'],
            'url' => ['required']
        ]);

        $image_name = date('YmdHis') . '.webp';
        $image_url = 'images/popup_ads/' . date('YmdHis') . '.webp';
        Image::make($request->image)->encode('webp', 90)->save(public_path('images/popup_ads/' . $image_name));

        PopupAds::insert([
            'image' => $image_url,
            'status' => $request->status,
            'url' => $request->url,
            'created_at' => Carbon::now(),
        ]);

        toast('Popup ads data inserted Successfully!', 'success');
        return redirect()->back();
    }

    /**
     * get single data in database base on specific id
     */
    public function show($id)
    {
        $item = PopupAds::find($id);
        return response()->json($item);
    }

    /**
     * update popup ads data in database base on specific id
     */
    public function update(Request $request)
    {
        $url = null;
        $request->slug? ($url = url('/post') . '/' . $request->slug) : ($url = $request->url);

        if ($request->hasFile('image')) {
            $old_image_url = PopupAds::find($request->id)->image;
            unlink(public_path($old_image_url));

            $image_name = date('YmdHis') . '.webp';
            $image_url = 'images/popup_ads/' . date('YmdHis') . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path('images/popup_ads/' . $image_name));

            PopupAds::find($request->id)->update([
                'image' => $image_url,
                'status' => $request->status,
                'url' => $request->url,
            ]);
        } else {
            PopupAds::find($request->id)->update([
                'status' => $request->status,
                'url' => $request->url,
            ]);
        }

        toast('Popup ads data updated Successfully!', 'success');
        return redirect()->back();
    }

    /**
     * trash data in database base on specific id
     */
    public function trash($id)
    {
        $old_image_url = PopupAds::find($id)->image;
        unlink(public_path($old_image_url));

        PopupAds::find($id)->delete();

        toast('Popup ads data deleted Successfully!', 'success');
        return redirect()->back();
    }
}
