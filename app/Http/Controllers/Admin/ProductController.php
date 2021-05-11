<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\ProductVideo;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Session;
use File;
use Faker\Provider\Image;
use App\Models\Stock;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with('subcategory')->latest()->get();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
            $sub_category=SubCategory::find($request->what);

            $product=new Product;
            $product->title=$request->title;
            $product->category_id=$request->category;
            $product->who=$request->who;
            $product->when=$request->when;
            $product->price=$request->price;
            $product->type=$request->type;
            $product->description=$request->description;
            $product->save();
            $product->subcategory()->attach($sub_category);
    
            $product_video=new ProductVideo;
            $product_video->product_id=$product->id; 
            $video=$request->video;
            $filename=$video->getClientOriginalName();
            $destination=public_path('product_videos/');
            $video->move($destination,$filename);
            $product_video->video=$filename;
            $product_video->save();
    
            $images=$request->images;
            for($i=0;$i<sizeof($images);$i++)
            {
                $product_image=new ProductImage;
                $imagename=rand().'.'.explode('/',explode(';',$images[$i])[0])[1];
                \Image::make($images[$i])->save(public_path('product_images/').$imagename);
                $product_image->product_id=$product->id;
                $product_image->image=$imagename;
                $product_image->save();
            }

            $stock = new Stock;
            $stock->product_id=$product->id;
            $stock->save();
        if($stock)
        {
            Session::flash('created','Product Created Successfuly');
            return redirect()->route('admin.products');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $product=Product::find($id);
       $product_images=ProductImage::where('product_id',$product->id)->get();
       $product_video=ProductVideo::where('product_id',$product->id)->first();
       $categories=Category::all();
       return view('admin.products.edit',compact('product','product_images','product_video','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestl
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $sub_category=SubCategory::find($request->what);
        $product=Product::find($id);
        $existing_sub_category=SubCategory::find($product->subcategory[0]->id);
        $product->subcategory()->detach($existing_sub_category);
        if($request->video != null)
        {
            $existing_video=ProductVideo::where('product_id',$product->id)->first();
            @unlink(public_path('/product_videos/'.$existing_video->video));
            $existing_video->delete();
            $product_video=new ProductVideo;
            $product_video->product_id=$product->id; 
            $video=$request->video;
            $filename=$video->getClientOriginalName();
            $destination=public_path('product_videos/');
            $video->move($destination,$filename);
            $product_video->video=$filename;
            $product_video->save();
        }

        $product->title=$request->title;
        $product->category_id=$request->category;
        $product->who=$request->who;
        $product->when=$request->when;
        $product->price=$request->price;
        $product->type=$request->type;
        $product->description=$request->description;
        $product->update();
        $product->subcategory()->attach($sub_category);

        $images=$request->images;
        if($images != null)
        {
            for($i=0;$i<sizeof($images);$i++)
            {
                $product_image=new ProductImage;
                $imagename=rand().'.'.explode('/',explode(';',$images[$i])[0])[1];
                \Image::make($images[$i])->save(public_path('product_images/').$imagename);
                $product_image->product_id=$product->id;
                $product_image->image=$imagename;
                $product_image->save();
            }
        }

        if($product)
        {
            Session::flash('updated','Product Updated Successfuly');
            return redirect()->route('admin.products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product=Product::find($id);
        $video=ProductVideo::where('product_id',$product->id)->first();
        @unlink(public_path('/product_videos/'.$video->video));
        $images=ProductImage::where('product_id',$product->id)->get();
        foreach($images as $image)
        {
            @unlink(public_path('/product_images/'.$image->image));
        }
        $existing_sub_category=SubCategory::find($product->subcategory[0]->id);
        $product->subcategory()->detach($existing_sub_category);

        $stock =Stock::where('product_id',$id)->first();
        $stock->delete();
        $product->delete();
        if($product)
        {
            Session::flash('deleted','Product Deleted Successfuly');
            return redirect()->back();
        }
    }

    public function remove_image($id)
    {
        $image=ProductImage::find($id);
        @unlink(public_path('/product_images/'.$image->image));
        $image->delete();
        if($image)
        {
            return redirect()->back();
        }
    }

    public function change_trending_option($id)
    {
        $product=Product::find($id);
        if($product->is_trending == false)
        {
            $product->is_trending = true;
            $product->update();
        }
        else
        {
            $product->is_trending = false;
            $product->update();
        }

        return response()->json('200');
    }

    public function change_seller_option($id)
    {
        $product=Product::find($id);
        if($product->is_best_seller == false)
        {
            $product->is_best_seller = true;
            $product->update();
        }
        else
        {
            $product->is_best_seller = false;
            $product->update();
        }

        return response()->json('200');
    }

    public function get_subcategories($id)
    {
       $category=Category::find($id);
       $sub_categories=Subcategory::where('category_id',$category->id)->get();
       return $sub_categories;
    }

}
