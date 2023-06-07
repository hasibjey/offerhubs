<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Image;

class CompanyController extends Controller
{
    /**
     * setup e-commerce information
     */
    public function install()
    {
        return view('admin.pages.company.install');
    }

    /**
     * display category data in category table
     * view categories page
     */
    public function index(Request $request)
    {
        $items = DB::table('companies')->first();

        return view('admin.pages.company.company', compact('items'));
    }

    /**
     * category data store in database collect by category form
     */
    public function collection(Request $request)
    {    
        if(count(Company::all()) <= 0)
        {
            $this->store($request);
            toast('Company data inserted successfully!', 'success');
            return redirect()->back();
        }
        else {
            $this->update($request);
            toast('Company data updated successfully!', 'success');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $image_url = 'assets/images/company.png';
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $image_url = 'assets/images/' . date('YmdHis') . random_int(0, 999) . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path($image_url));
        }

        Company::insert([
            'image' => $image_url,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'tax' => $request->tax,
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * update category data in database base on specific id
     */
    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $old_image_url = Company::find($request->id)->image;
            if ($old_image_url != 'assets/images/company.png')
                unlink(public_path($old_image_url));

            $image_url = 'assets/images/' . date('YmdHis') . random_int(0, 999) . '.webp';
            Image::make($request->image)->encode('webp', 90)->save(public_path($image_url));

            Company::find($request->id)->update([
                'image' => $image_url,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'tax' => $request->tax,
            ]);
        } else {

            Company::find($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'tax' => $request->tax,
            ]);
        }
    }
}
