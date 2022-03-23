<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('id','desc')->get();
        return view('product.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(),[
            "Cat_id"=>"required",
            "subcategory_id"=>"required",
            "name"=>"required",
            "short_desc"=>"required",
            "desc"=>"required",
            "price"=>"required|numeric|min:1",
            "qty"=>"required|numeric|min:1",
            "vat"=>"required",
            "offer_price"=>"required|numeric|min:1",
            "remaining_stock"=>"required",
            "low_stock"=>"required",
            "image"=>"required|mimes:jpeg,jpg,png",
        ],["Cat_id.required" => "Category  filed is required.",
            "subcategory_id.required" => "Sub Category  filed is required."
        ]);

        if ($validator->fails())
        {
            return redirect("product/create")
                ->withErrors($validator)
                ->withInput();
        }

        if($request->has("image"))
        {
            $input = $request->input();
            unset($input['_token']);
            $destination_path = "storage/uploads/product/";

            $file = $request->file('image');
            $file_name = time().rand().".".$file->getClientOriginalExtension();
            $file->move($destination_path,$file_name);
            $input['image'] = $file_name;

            if ($input['units'] != "pkts" ||  $input['units'] != "bags" )
            {
                unset($input['size']);
            }
            Product::create($input);
            $request->session()->flash('response',"success");
            $request->session()->flash('msg',"Product Added Successfully.");
            return redirect(url('product'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::orderBy('id','desc')->get();
        $data['sub_categories'] = SubCategory::orderBy('id','desc')->get();
        $data['product'] = Product::where('id',$id)->first();
        return view('product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "Cat_id"=>"required",
            "subcategory_id"=>"required",
            "name"=>"required",
            "short_desc"=>"required",
            "desc"=>"required",
            "price"=>"required|numeric|min:1",
            "qty"=>"required|numeric|min:1",
            "vat"=>"required",
            "offer_price"=>"required|numeric|min:1",
            "remaining_stock"=>"required",
            "low_stock"=>"required",
        ],["Cat_id.required" => "Category  filed is required.",
            "subcategory_id.required" => "Sub Category  filed is required."
        ]);

        if ($validator->fails())
        {
            return redirect("product/create")
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->input();
        unset($input['_token']);
        unset($input['_method']);

        $product = Product::where('id',$id)->first();

        if($request->has("image"))
        {

            $destination_path = "storage/uploads/product/";
            $exists_path = "storage/uploads/product/".$product->image;
            if (file_exists($exists_path))
            {
                unlink($exists_path);
            }
            $file = $request->file('image');
            $file_name = time().rand().".".$file->getClientOriginalExtension();
            $file->move($destination_path,$file_name);
            $input['image'] = $file_name;
        }

        if ($input['units'] != "pkts" ||  $input['units'] != "bags" )
        {
            unset($input['size']);
        }
        Product::where('id',$id)->update($input);
        $request->session()->flash('response',"success");
        $request->session()->flash('msg',"Product Updated Successfully.");
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id',$request['id'])->first();

        $exitpath = storage_path('uploads/product/'.$product->image);
        if (file_exists($exitpath))
        {
            unlink($exitpath);
        }
        Product::where('id',$request['id'])->delete();
        return response()->json(array("status"=>"success","message"=>"Product Deleted Successfully"));
    }

    public function datatable(Request $request)
    {
        $results = Product::with('category')->orderBy('id','desc')->get();
      //  return $results;
        return DataTables::of($results)
            ->addColumn('action',function ($results){
                return '<div class="text-center">
                         <a href="'.route('product.edit',$results->id).'"  title="Edit" class="text-warning fa-lg"><i class="fa fa-pencil" aria-hidden="true"></i></i></a>
                         <a href="javascript:void(0)" data-id="'.$results->id.'" class="delete_btn text-danger fa-lg"  title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public  function getSubCategory(Request $request)
    {
        $subCategories = SubCategory::where("Cat_id",$request->category_id)->get();

        return $subCategories;
    }
}
