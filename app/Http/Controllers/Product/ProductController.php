<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\MangeImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use MangeImage;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=Product::all();

        return view('Product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)

    {
        $validated = $request->validated();

       $filepath=$this->addImage($request,'image','public');
        $validated['image'] = $filepath;
        $create = Product::create($validated);
        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('Product.edit',compact('product'));
    }
    public function getProductDetails($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'price' => $product->selling_price,
                'available_quantity' => $product->quantity,
            ]);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $old_image=$product->image;

        if ($request->hasfile('image')){
            $filePath=$this->updateImage($old_image,'image','public');
            $validated['image'] = $filePath;
        }

        $update = $product->update($validated);
        toastr()
            ->addInfo('تم تحديث البيانات بنجاح.','تحديث');
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('product');

    }
}
