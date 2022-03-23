@extends('layout.app')
@section('title',"Add Product")

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8" style="margin: 0 auto;">
                <h2>Add Product</h2>
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Cat_id">Select Category:</label>
                        <select class="form-control" id="Cat_id"  name="Cat_id" >
                            <option value="">Select Category Name</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{$category->Catname}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('Cat_id'))
                            <label class="text-danger text-bold">{{$errors->first('Cat_id')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-group" style="display:{{ old('Cat_id') ? 'block' : 'none' }} " id="subCategoryDiv">
                            <label>Sub Category:</label>
                            <br>
                            <select class="form-control" name="subcategory_id" id="subcategory">
                                <option value="">Select SubCategory</option>
                            </select>
                        </div>
                        @if($errors->first('subcategory_id'))
                            <label class="text-danger text-bold">{{$errors->first('subcategory_id')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}">
                        @if($errors->first('name'))
                            <label class="text-danger text-bold">{{$errors->first('name')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short Desc:</label>
                        <input type="text" class="form-control" id="short_desc" placeholder="Enter short desc" name="short_desc" value="{{old('short_desc')}}">
                        @if($errors->first('short_desc'))
                            <label class="text-danger text-bold">{{$errors->first('short_desc')}}</label>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="desc">Desc:</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter  desc" name="desc" value="{{old('desc')}}">
                        @if($errors->first('desc'))
                            <label class="text-danger text-bold">{{$errors->first('desc')}}</label>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{old('price')}}">
                                @if($errors->first('price'))
                                    <label class="text-danger text-bold">{{$errors->first('price')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">Qty:</label>
                                <input type="text" class="form-control" id="qty" placeholder="qty" name="qty" value="{{old('qty')}}">
                                @if($errors->first('qty'))
                                    <label class="text-danger text-bold">{{$errors->first('qty')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="units">units:</label>
                                <select class="form-control" name="units" id="units">
                                    <option value="kg">KG</option>
                                    <option value="gm">GM</option>
                                    <option value="pc">PC</option>
                                    <option value="itr">ITR</option>
                                    <option value="ml">ML</option>
                                    <option value="pounds">Pounds</option>
                                    <option value="pints">Pints</option>
                                    <option value="pkts">pkts</option>
                                    <option value="bags">bags</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-2" >
                            <div class="form-group" style="display:none" id="sizeDiv">
                                <label for="size">Size:</label>
                                <select class="form-control" name="size" id="size">
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="vat">VAT:</label>
                        <input type="text" class="form-control" id="vat" placeholder="Enter  vat" name="vat" value="{{old('vat')}}">
                        @if($errors->first('vat'))
                            <label class="text-danger text-bold">{{$errors->first('vat')}}</label>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="offer_price">Offer Price:</label>
                        <input type="text" class="form-control" id="offer_price" placeholder="Enter  offer price" name="offer_price" value="{{old('offer_price')}}">
                        @if($errors->first('offer_price'))
                            <label class="text-danger text-bold">{{$errors->first('offer_price')}}</label>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image"  name="image">
                        @if($errors->first('image'))
                            <label class="text-danger text-bold">{{$errors->first('image')}}</label>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remaining_stock">Remaining Stock:</label>
                                <input type="text" class="form-control" id="remaining_stock" placeholder="Enter remaining stock" name="remaining_stock" value="{{old('remaining_stock')}}">
                                @if($errors->first('remaining_stock'))
                                    <label class="text-danger text-bold">{{$errors->first('remaining_stock')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="low_stock">low stock:</label>
                                <input type="text" class="form-control" id="low_stock" placeholder="low stock" name="low_stock" value="{{old('low_stock')}}">
                                @if($errors->first('low_stock'))
                                    <label class="text-danger text-bold">{{$errors->first('low_stock')}}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('product.index')}}" class="btn badge-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {


            // Sub Category

            $(document).on("change","#Cat_id",function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{url('get-subcategory')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{category_id:category_id},
                    method:"POST",
                    dataType:"json",
                    success:function(response)
                    {
                        console.log(response);
                        var subcat =  $('#subcategory').empty();
                        subcat.append('<option value ="">Select SubCategory</option>');
                        $.each(response,function(key,value){
                            subcat.append('<option value ="'+value.id+'">'+value.Subcat_name+'</option>');
                        });
                        // subcat.append('<option value ="add_new_subcategory" id="add_new_subcategory">Add New Subcategory</option>');

                        $("#subCategoryDiv").show();
                    }
                });
            });


            $(document).on("change","#units",function(){
                var units = $(this).val();

                if (units == "pkts" || units == "bags" )
                {
                    $("#sizeDiv").show();
                }
                else
                {
                    $("#sizeDiv").hide();
                }

            });
        } );
    </script>
@endsection