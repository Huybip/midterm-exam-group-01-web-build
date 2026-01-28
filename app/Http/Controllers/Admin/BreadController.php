<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bread;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BreadController extends Controller
{
    //List all breads
    public function index()
    {
        $breads = Bread::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.breads.index', compact('breads'));
    }

    //Show form to create new bread
    public function create()
    {
        return view('admin.breads.create');
    }

    //Save new bread
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg, png, jpg, gif, svg|,max:2048',
        ]);

        $data = $request->all();

        //Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('breads', 'public');
        }

        Bread::create($data);

        return redirect()->route('admin.breads.index')->with('sucess', 'Thêm bánh mới thành công!');
    }

    //Update bread
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg, png, jpg, gif, svg|max:2048',
        ]);

        $bread = Bread::findOrFail($id);
        $data = $request->all();

        //Upload new image
        if ($request->hasFile('image')) {
            //Delete old image if exists
            if ($bread->image){
                Storage::disk('public')->delete($bread->image);
            }
            $data['image'] = $request->file('image')->store('breads', 'public');
        }

        $bread->update($data);

        return redirect()->route('admin.breads.index')->with('sucess', 'Cập nhật bánh thành công!');
    }

    //Delete bread
    public function destroy($id)
    {
        $bread = Bread::findOrFail($id);

        //Delete image
        if ($bread->image) {
            Storage::disk('public')->delete($bread->image);
        }

        $bread->delete();

        return redirect()->route('admin.breads.index')->with('sucess', 'Xóa bánh mì thành công!');
    }
}

