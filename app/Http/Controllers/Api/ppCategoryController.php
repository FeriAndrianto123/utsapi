<?php

namespace App\Http\Controllers\Api;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryControler extends Controller
{
    public function index()
    {
        //get all posts
        $categories = category::latest()->paginate(5);

        //return collection of posts as a resource
        return new CategoryResource(true, 'List Data', $categories);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $categories = category::create([
            'name'   => $request->name,
        ]);

        //return response
        return new CategoryResource(true, 'Data Berhasil Ditambahkan!', $categories);
    }

    public function show($id)
    {
        //find post by ID
        $categories = category::find($id);

        //return single post as a resource
        return new CategoryResource(true, 'Detail Data BY ID!', $categories);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $categories = category::find($id);

            //update post
            $categories->update([
                'name'   => $request->name,
            ]);


        //return response
        return new CategoryResource(true, 'Data Berhasil Diubah!', $categories);
    }

    public function destroy($id)
    {

        //find post by ID
        $categories = category::find($id);

        //delete post
        $categories->delete();

        //return response
        return new CategoryResource(true, 'Data Berhasil Dihapus!', null);
    }
}
