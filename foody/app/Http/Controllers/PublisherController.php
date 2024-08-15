<?php

namespace App\Http\Controllers;

use App\Publisher;
use Carbon\Carbon;
use App\Product;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function viewAllPublisher()
    {
        $publishers = Publisher::orderBy('id', 'desc')->paginate(10);
        //$publishers = null;
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'publishers' => $publishers
        ], 200);
    }

    public function getPublisherForProduct()
    {
        $publishers = Publisher::orderBy('id', 'desc')->get();
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'publishers' => $publishers
        ], 200);
    }

    public function addNewPublisher(Request $request)
    {
        $this->validate($request, [
            'publisher_name' => 'required|min:2|max:50',
            'image' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image, ';');
        $sub = substr($request->image, 0, $strpos);
        $ex = explode('/', $sub)[1];
        $image_name = time() . str::random(5) . "." . $ex;
        $img = Image::make($request->image)->save('publisher_images/' . $image_name, 100);


        $without_space = str_replace(" ", "-", $request->publisher_name);
        $without_slashAndSpace = str_replace("/", "-", $without_space);
        $without_slashAndSpaceAndDot = str_replace(".", "-", $without_space);
        $slug = $without_slashAndSpaceAndDot . time() . str::random(5);
        Publisher::insert([
            'name' => $request->publisher_name,
            'image' => $image_name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];
    }

    public function deletePublisher($id)
    {
        if (Product::where('publisher_id', $id)->exists()) {
            return response()->json([
                'Message' => "Cant Be Deleted"
            ], 404);
        } else {
            $data = Publisher::where('id', $id)->first();
            if ($data->image != null) {
                unlink('publisher_images/' . $data->image);
            }
            Publisher::findOrFail($id)->delete();
        }
    }

    public function editPublisher($id)
    {
        $publisher = Publisher::find($id);
        return response()->json([
            'publisher' => $publisher
        ], 200);
    }

    public function updatePublisher(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'image' => 'required'
        ]);

        $without_space = str_replace(" ", "-", $request->name);
        $without_slashAndSpace = str_replace("/", "-", $without_space);
        $without_slashAndSpaceAndDot = str_replace(".", "-", $without_space);
        $slug = $without_slashAndSpaceAndDot . time() . str::random(5);

        $publisher_info = Publisher::where('id', $id)->first();

        if ($request->image != $publisher_info->image) {

            //delete previous image if uploaded new
            if (file_exists('publisher_images/' . $publisher_info->image)) {
                unlink('publisher_images/' . $publisher_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $image_name = time() . str::random(5) . "." . $ex;
            $img = Image::make($request->image)->save('publisher_images/' . $image_name, 100);

            Publisher::where('id', $id)->update([
                'name' => $request->name,
                'image' => $image_name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Publisher::where('id', $id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
