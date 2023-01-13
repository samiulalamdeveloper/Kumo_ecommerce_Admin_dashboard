<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\QuantityRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductThumb;
use App\Models\Size;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;

class ProductController extends Controller
{
    //Product blade
    function product() {
        $category_info = Category::all();
        return view('admin.product.product', [
            'category_info' => $category_info
        ]);
    }

    // getSubcategory
    function getSubcategory(Request $request) {
        $str = '<option value="">-- Select Subcategory --</option>';
        $subcategory_info = Subcategory::where('category_id', $request->categoryid)->get();
        foreach ($subcategory_info as $subcategory) {
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    // product store
    function product_store(ProductRequest $request) {
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'after_discount' => $request->product_price - ($request->product_price * $request->product_discount)/100,
            'product_brand' => $request->product_brand,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'slug' => str_replace(' ', '-', Str::lower($request->product_name)).'-'.rand(1000, 9999),
            'created_at' => Carbon::now(),
        ]);
        // Preview
        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = str_replace(' ', '-', Str::lower($request->product_name)).'-'.rand(1000, 9999).'.'.$extension;
        Image::make($uploaded_file)->resize(300, 200)->save(public_path('uploads/products/preview/'.$file_name));
        Product::find($product_id)->update([
            'preview' => $file_name
        ]);

        // Thumbnails
        $uploaded_thumbnails = $request->thumbnail;
        foreach ($uploaded_thumbnails as $thumbnail) {
            $thumb_extension = $thumbnail->getClientOriginalExtension();
            $thumb_name = str_replace(' ', '-', Str::lower($request->product_name)).'-'.rand(1000,9999).'.'.$thumb_extension;
            Image::make($thumbnail)->resize(300, 200)->save(public_path('uploads/products/thumbnails/'.$thumb_name));

            ProductThumb::insert([
                'product_id' => $product_id,
                'thumbnail' => $thumb_name
            ]);
        }
        return back()->withSuccess('Product added successfully.');
    }

    // Product List
    function product_list() {
        $product_info = Product::all();
        return view('admin.product.product_list',[
            'product_info' => $product_info
        ]);
    }

    // Product single item Delete
    function product_delete($product_id) {
        $preview_image = Product::where('id', $product_id)->get();
        $delete_preview = public_path('uploads/products/preview/'. $preview_image->first()->preview);
        unlink($delete_preview);
        Product::find($product_id)->delete();
        $thumb_image = ProductThumb::where('product_id', $product_id)->get();
        foreach($thumb_image as $thumb) {
            $delete_thumbnails = public_path('uploads/products/thumbnails/'. $thumb->thumbnail);
            unlink($delete_thumbnails);
            ProductThumb::find($thumb->id)->delete();
        }
        $inventories = Inventory::where('product_id', $product_id)->get();
        foreach($inventories as $inventory) {
            Inventory::find($inventory->id)->delete();
        }
        return back()->withProductdelete('Product item deleted successfully');
    }

    // product variation
    function product_variation() {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.product_variation', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    // add color
    function add_color(Request $request) {
        $request->validate([
            'color_name' => 'required'
        ]);

        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code
        ]);
        return back()->withSuccess('Color added successfully');
    }

    // Delete color
    function color_delete($color_id) {
        Color::find($color_id)->delete();
        return back()->withSuccesscolor('Color deleted successfully');
    }

    // add size
    function add_size(Request $request) {
        $request->validate([
            'size' => 'unique:sizes'
        ]);
    
        Size::insert([
            'size' => $request->size,
        ]);
        return back()->withSuccesssize('Size added successfully');
    }
    // Delete color
    function size_delete($size_id) {
        Size::find($size_id)->delete();
        return back()->withSuccesssizee('Size deleted successfully');
    }

    // Inventory (add)
    function inventory($product_id) {
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id',$product_id)->get();
        return view('admin.inventory.inventory', [
            'product_info'=> $product_info,
            'colors'=> $colors,
            'sizes'=> $sizes,
            'inventories' => $inventories,
        ]);
    }

    // Inventory store
    function inventory_store(QuantityRequest $request) {
        if(Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back()->withSuccess('Quanitity increment successfully');
        } else {
            Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
            ]);
            return back()->withSuccess('Inventory added successfully');
        }
    }

    // inventory delete
    function inventory_delete($product_id) {
        Inventory::find($product_id)->delete();
        return back()->withInventorydel('Inventory deleted successfully');
    }

}
    