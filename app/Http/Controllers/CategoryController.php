<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Str;

class CategoryController extends Controller
{
    //category blade
    function category() {
        $categories = Category::all();
        $trashed_categories = Category::onlyTrashed()->get();
        return view('admin.category.category', [
            'categories' => $categories,
            'trashed_categories' => $trashed_categories
        ]);
    }

    // add category
    function add_category(CategoryRequest $request) {
        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        $category_image = $request->category_image;
        $extension = $category_image->getClientOriginalExtension();
        $after_replace = str_replace(' ', '-', $request->category_name);
        $file_name = $after_replace.'-'.rand(1000, 9999).'.'.$extension;
        Image::make($category_image)->resize(300, 200)->save(public_path('uploads/category/'.$file_name));
        
        Category::find($category_id)->update([
            'category_image' => $file_name,
        ]);
        return back()->withSuccess('Successfully added category');

    }

    // category soft delete
    function category_soft_delete($category_id) {
        Category::find($category_id)->delete();
        return back();
    }

    // category force delete
    function category_force_delete($category_id) {
        $category_image = Category::onlyTrashed()->where('id', $category_id)->first()->category_image;
        $delete_from = public_path('uploads/category/'.$category_image);
        unlink($delete_from);
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('category_delete', 'Successfully category item deleted');
    }

    // category edit
    function category_edit($category_id) {
        $category_info = Category::find($category_id);
        return view('admin.category.category_edit', [
            'category_info' => $category_info
        ]);
    }

    // category update
    function category_update(Request $request) {
        $request->validate([
            'category_name' => 'required',
        ], [
            'category_name' => 'Category name need to be fillable.'
        ]);
        if($request->category_image == null) {
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'added_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);
            return back()->withUpdatesuccess('Category updated successfully');
        } else {
            $category_img_del = Category::where('id', $request->category_id)->first()->category_image;
            $delete_from = public_path('uploads/category/'.$category_img_del);
            unlink($delete_from);
            $upload_img = $request->category_image;
            $extension = $upload_img->getClientOriginalExtension();
            $after_replace = str_replace(' ', '-', $request->category_name);
            $file_name = Str::lower($after_replace).'-'.rand(1000, 9999).'.'.$extension;
            Image::make($upload_img)->resize(300, 200)->save(public_path('uploads/category/'.$file_name));
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'category_image' => $file_name,
                'added_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);
            return back()->withUpdatesuccess('Category updated successfully');
        }
    }
}
