<?php

namespace App\Http\Controllers\AdminPanel\Setting\Barangay;

use App\Http\Controllers\Controller;

use App\Models\Barangayimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangayimageController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'barangay_name' => 'Required',
            'city' => 'Required',
            'province' => 'Required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500||dimensions:max_width=500,max_height=500',

        ]);

        $path = $request->file('image')->store('public/images',"s3");
         /** @var \Illuminate\Filesystem\FilesystemManager $disk */
         $disk = Storage::disk('s3');
         $url = $disk->url($path);

         //determine if file is visible
        $deletefile = DB::table('barangayimages')
        ->where('barangay_id','=',$request->barangay_id)
        ->first();
        if ($deletefile !== null) {
            $deletefile = DB::table('barangayimages')
        ->where('barangay_id','=',$request->barangay_id)
        ->first();
        Storage::disk('s3')->delete($deletefile->image);
         }


         //insert
        Barangayimage::updateOrCreate(['barangay_id' => $request->barangay_id],
        ['city' => $request->city,
        'barangay_name' => $request->barangay_name,
        'province'=>$request->province,
        'image'=>$path,
         'url' => $url

        ]);
        return redirect('/setting/maintenance')
                        ->with('success','Post has been created successfully.');
    }

}
