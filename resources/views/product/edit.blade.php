@extends('layout.app')
@section('title',"Edit Product")

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8" style="margin: 0 auto;">
                <h2>Edit Product</h2>
                <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{method_field("PATCH")}}
                    <div class="form-group">
                        <label for="Cat_id">Select Category:</label>
                        <select class="form-control" id="Cat_id"  name="Cat_id" >
                            <option value="">Select Category Name</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if ($product->Cat_id == $category->id) {{ 'selected' }} @endif>{{$category->Catname}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('Cat_id'))
                            <label class="text-danger text-bold">{{$errors->first('Cat_id')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-group" id="subCategoryDiv">
                            <label>Sub Category</label>
                            <br>
                            <select class="form-control" name="subcategory_id" id="subcategory">
                                <option value="">Select SubCategory</option>
                                @foreach($sub_categories as $row)
                                    <option value="{{$row->id}}" @if ($product->subcategory_id == $row->id) {{ 'selected' }} @endif>{{$category->Catname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$product->name}}">
                        @if($errors->first('name'))
                            <label class="text-danger text-bold">{{$errors->first('name')}}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short Desc:</label>
                        <input type="text" class="form-control" id="short_desc" placeholder="Enter short desc" name="short_desc" value="{{$product->short_desc}}">
                        @if($errors->first('short_desc'))
                            <label class="text-danger text-bold">{{$errors->first('short_desc')}}</label>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="desc">Desc:</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter  desc" name="desc" value="{{$product->desc}}">
                        @if($errors->first('desc'))
                            <label class="text-danger text-bold">{{$errors->first('desc')}}</label>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{$product->price}}">
                                @if($errors->first('price'))
                                    <label class="text-danger text-bold">{{$errors->first('price')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty">Qty:</label>
                                <input type="text" class="form-control" id="qty" placeholder="qty" name="qty" value="{{$product->qty}}">
                                @if($errors->first('qty'))
                                    <label class="text-danger text-bold">{{$errors->first('qty')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="units">units:</label>
                                <select class="form-control" name="units" id="units">
                                    <option value="kg" @if ($product->units == 'kg') {{ 'selected' }} @endif>KG</option>
                                    <option value="gm" @if ($product->units == 'gm') {{ 'selected' }} @endif>GM</option>
                                    <option value="pc" @if ($product->units == 'pc') {{ 'selected' }} @endif>PC</option>
                                    <option value="itr" @if ($product->units == 'itr') {{ 'selected' }} @endif>ITR</option>
                                    <option value="ml" @if ($product->units == 'ml') {{ 'selected' }} @endif>ML</option>
                                    <option value="pounds" @if ($product->units == 'pounds') {{ 'selected' }} @endif>Pounds</option>
                                    <option value="pints" @if ($product->units == 'pints') {{ 'selected' }} @endif>Pints</option>
                                    <option value="pkts" @if ($product->units == 'pkts') {{ 'selected' }} @endif>pkts</option>
                                    <option value="bags" @if ($product->units == 'bags') {{ 'selected' }} @endif>bags</option>
                                </select>

                            </div>
                        </div>
                        @if($product->units == "pkts" || $product->units == "bags" )
                            <div class="col-md-2" >
                                <div class="form-group"  id="sizeDiv">
                                    <label for="size">Size:</label>
                                    <select class="form-control" name="size" id="size">
                                        <option value="XS" @if ($product->size == 'XS') {{ 'selected' }} @endif>XS</option>
                                        <option value="S" @if ($product->size == 'S') {{ 'selected' }} @endif>S</option>
                                        <option value="M" @if ($product->size == 'M') {{ 'selected' }} @endif>M</option>
                                        <option value="L" @if ($product->size == 'L') {{ 'selected' }} @endif>L</option>
                                        <option value="XL" @if ($product->size == 'XL') {{ 'selected' }} @endif>XL</option>
                                        <option value="XXL" @if ($product->size == 'XXL') {{ 'selected' }} @endif>XXL</option>
                                    </select>

                                </div>
                            </div>

                        @endif
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
                        <input type="text" class="form-control" id="vat" placeholder="Enter  vat" name="vat" value="{{$product->vat}}">
                        @if($errors->first('vat'))
                            <label class="text-danger text-bold">{{$errors->first('vat')}}</label>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="offer_price">Offer Price:</label>
                        <input type="text" class="form-control" id="offer_price" placeholder="Enter  offer price" name="offer_price" value="{{$product->offer_price}}">
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
                    <div class="form-group">
                        <img src="{{asset('storage/uploads/product/'.$product->image)}}" width="100px">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remaining_stock">Remaining Stock:</label>
                                <input type="text" class="form-control" id="remaining_stock" placeholder="Enter remaining stock" name="remaining_stock" value="{{$product->remaining_stock}}">
                                @if($errors->first('remaining_stock'))
                                    <label class="text-danger text-bold">{{$errors->first('remaining_stock')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="low_stock">low stock:</label>
                                <input type="text" class="form-control" id="low_stock" placeholder="low stock" name="low_stock" value="{{$product->low_stock}}">
                                @if($errors->first('low_stock'))
                                    <label class="text-danger text-bold">{{$errors->first('low_stock')}}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Active" @if ($product->status == 'Active') {{ 'selected' }} @endif>Active</option>
                            <option value="Inactive" @if ($product->status == 'Inactive') {{ 'selected' }} @endif>Inactive</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('product.index')}}" class="btn badge-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="video_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="yt-player">
                    <video width="450" height="300" controls autoplay  class="sample_video">
                        <source src="" type="video/mp4" class="video-src">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

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