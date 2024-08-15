<?php

namespace App\Http\Controllers;

use App\Author;
use Carbon\Carbon;
use App\Product;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function viewAllAuthor()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(10);
        //$authors = null;
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'authors' => $authors
        ], 200);
    }

    public function getAuthorForProduct()
    {
        $authors = Author::orderBy('id', 'desc')->get();
        //sending in json format to the resouce/js/store/index.js
        return response()->json([
            'authors' => $authors
        ], 200);
    }

    public function addNewAuthor(Request $request)
    {
        $this->validate($request, [
            'author_name' => 'required|min:2|max:50',
            'image' => 'required'
        ]);

        //new code for image upload in Vue JS
        $strpos = strpos($request->image, ';');
        $sub = substr($request->image, 0, $strpos);
        $ex = explode('/', $sub)[1];
        $image_name = time() . str::random(5) . "." . $ex;
        $img = Image::make($request->image)->save('author_images/' . $image_name, 100);


        $without_space = str_replace(" ", "-", $request->author_name);
        $without_slashAndSpace = str_replace("/", "-", $without_space);
        $without_slashAndSpaceAndDot = str_replace(".", "-", $without_space);
        $slug = $without_slashAndSpaceAndDot . time() . str::random(5);
        Author::insert([
            'name' => $request->author_name,
            'image' => $image_name,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);
        return ['message' => 'ok'];
    }

    public function deleteAuthor($id)
    {
        if (Product::where('author_id', $id)->exists()) {
            return response()->json([
                'Message' => "Cant Be Deleted"
            ], 404);
        } else {
            $data = Author::where('id', $id)->first();
            if ($data->image != null) {
                unlink('author_images/' . $data->image);
            }
            Author::findOrFail($id)->delete();
        }
    }

    public function editAuthor($id)
    {
        $author = Author::find($id);
        return response()->json([
            'author' => $author
        ], 200);
    }

    public function updateAuthor(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'image' => 'required'
        ]);

        $without_space = str_replace(" ", "-", $request->name);
        $without_slashAndSpace = str_replace("/", "-", $without_space);
        $without_slashAndSpaceAndDot = str_replace(".", "-", $without_space);
        $slug = $without_slashAndSpaceAndDot . time() . str::random(5);

        $author_info = Author::where('id', $id)->first();

        if ($request->image != $author_info->image) {

            //delete previous image if uploaded new
            if (file_exists('author_images/' . $author_info->image)) {
                unlink('author_images/' . $author_info->image);
            }

            //new code for image upload in Vue JS
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $image_name = time() . str::random(5) . "." . $ex;
            $img = Image::make($request->image)->save('author_images/' . $image_name, 100);

            Author::where('id', $id)->update([
                'name' => $request->name,
                'image' => $image_name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Author::where('id', $id)->update([
                'name' => $request->name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
