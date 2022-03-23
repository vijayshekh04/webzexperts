@extends('layout.app')
@section('title',"Product")

@section('content')
    <div class="container">
       <div class="mt-5">
           <div class="float-right">
               <a href="{{route('product.create')}}" class="btn btn-primary">Add New</a>
           </div>
       </div>
        <table class="table table-striped" id="datatable">
            <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Offer Price</th>
                <th>Vat</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


 <script>
     $(document).ready(function() {
         var table = $('#datatable').DataTable({
             processing: true,
             serverSide: true,
             ajax:{
                 type : 'post',
                 url:"{{ url('product/datatable') }}",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 error:function (e) {
                 }
             },
             columns: [
                 {data: 'status', name: 'status'},
                 {data: 'name', name: 'name'},
                 {data: 'category.Catname', name: 'category.Catname'},
                 {data: 'price', name: 'price'},
                 {data: 'offer_price', name: 'offer_price'},
                 {data: 'vat', name: 'vat'},
                 {data: 'action', name: 'action', orderable: false, searchable: false},
             ]
         });

         /**
          * Delete Record Call
          */
         $(document).on("click",".delete_btn",function () {
             var id = $(this).data("id");
             Swal.fire( {
                     title: "Are you sure?",
                     text: "You want to delete this record?",
                     type: "warning",
                     showCancelButton: !0,
                     confirmButtonColor: "#3085d6",
                     cancelButtonColor: "#d33",
                     confirmButtonText: "Yes, delete it!",
                     confirmButtonClass: "btn btn-primary",
                     cancelButtonClass: "btn btn-danger ml-1",
                     buttonsStyling: !1
                 }
             ).then(function(t) {
                     if(t.value){
                         $.ajax({
                             type: "post",
                             headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             url: "{{ url('product/destroy') }}",
                             data: {
                                 "id": id
                             },
                             dataType:"json",
                             success: function (response) {
                                 if(response.status == "success") {

                                     Swal.fire(
                                         '',
                                         response.message,
                                         'success'
                                     );

                                     table.ajax.reload();
                                 }else{
                                 }
                             },
                             error:function (e) {
                                 console.log(e);
                             }
                         })
                     }

                 }
             )
         });
     } );
 </script>
@endsection