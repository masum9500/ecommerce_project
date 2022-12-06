@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
<!-- Content Header (Page header) -->
  

<!-- Main content -->
<section class="content">

 <!-- Basic Forms -->
  <div class="box">
	<div class="box-header with-border">
	  <h4 class="box-title">Add Product</h4>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <div class="row">
		<div class="col">
			<form action="{{ route('product-update')}}" method="post">
			  <div class="row">
				<div class="col-12">


@csrf
<input type="hidden" name="id" value="{{ $product->id }}">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<h5>Select Brand <span class="text-danger">*</span></h5>
				<div class="controls">
					<select name="brand_id" class="form-control"  >
						<option value="" selected="" disabled="">Select Brand</option>
						@foreach($brands as $brand)
						<option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : ''}}>{{ $brand->brand_name_en }}</option>	
						@endforeach
					</select>
					@error('brand_id') 
					 <span class="text-danger">{{ $message }}</span>
					 @enderror 
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<h5>Select Category <span class="text-danger">*</span></h5>
				<div class="controls">
					<select name="category_id" class="form-control"  >
						<option value="" selected="" disabled="">Select Category</option>
						@foreach($categories as $category)
						<option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ''}}>{{ $category->category_name_eng }}</option>	
						@endforeach
					</select>

					@error('category_id') 
					 <span class="text-danger">{{ $message }}</span>
					 @enderror 
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<h5>Select Subcategory <span class="text-danger">*</span></h5>
				<div class="controls">
					<select name="subcategory_id" class="form-control"  >
						<option value="" selected="" disabled="">Select SubCategory</option>
						@foreach($subcategories as $subcategory)
						<option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : ''}}>{{ $subcategory->subcategory_name_eng }}</option>	
						@endforeach
					</select>
					
					@error('subcategory_id') 
					 <span class="text-danger">{{ $message }}</span>
					 @enderror 
				</div>
			</div>
		</div>
	</div>



<!-- ..........Seceond Row............ -->

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<h5>Select Sub Subcategory <span class="text-danger">*</span></h5>
			<div class="controls">
				<select name="subsubcategory_id" class="form-control"  required>
					<option value="" selected="" disabled="">Select SubCategory</option>
					@foreach($subsubcategories as $subsubcategory)
					<option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == $product->subsubcategory_id ? 'selected' : ''}}>{{ $subsubcategory->sub_subcategory_name_eng }}</option>	
					@endforeach
				</select>
				@error('subsubcategory_id') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Name EN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_name_en" class="form-control" value="{{ $product->product_name_en }}" required>
				@error('product_name_en') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Name BAN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_name_ban" class="form-control" value="{{ $product->product_name_ban }}" required>
				@error('product_name_ban') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>
</div>







<!-- ..........3rd Row............ -->

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Code <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" required>
				@error('product_code') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Quantity <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_qty" class="form-control" value="{{ $product->product_qty }}" required >
				@error('product_qty') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Tags EN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_tags_en" class="form-control" value="{{ $product->product_tags_en }}" data-role="tagsinput" required >
				@error('product_tags_en') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>
</div>









<!-- ..........4th Row............ -->

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Tags BAN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_tags_ban" class="form-control" value="{{ $product->product_tags_ban }}" data-role="tagsinput" required>
				@error('product_tags_ban') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Size EN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_size_en" class="form-control" value="{{ $product->product_size_en }}" data-role="tagsinput" required>
				@error('product_size_en') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<h5>Product Size BAN <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_size_ban" class="form-control" value="{{ $product->product_size_ban }}" data-role="tagsinput" required>
				@error('product_size_ban') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>
</div>







<!-- ..........5th Row............ -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<h5>Product Color En <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_color_en" class="form-control" value="{{ $product->product_color_en }}" data-role="tagsinput" required>
				@error('product_color_en') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<h5>Product Color Ban <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="product_color_ban" class="form-control" value="{{ $product->product_color_ban }}" data-role="tagsinput" required>
				@error('product_color_ban') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	
</div>






<!-- ..........6th Row............ -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<h5>Product Selling Price <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="selling_price" class="form-control" value="{{ $product->selling_price }}" required\>
				@error('selling_price') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<h5>Product Discount Price <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text"  name="discount_price" class="form-control" value="{{ $product->discount_price }}" required \>
				@error('discount_price') 
				 <span class="text-danger">{{ $message }}</span>
				 @enderror 
			</div>
		</div>
	</div>
</div>





<!-- ..........7th Row............ -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<h5>Short Description En <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea  name="short_descp_en" rows="4" id="textarea" class="form-control" required placeholder="Textarea text">{!! $product->short_descp_en !!}</textarea>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<h5>Short Description Ban <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea  name="short_descp_ban" id="textarea" rows="4" class="form-control" required placeholder="Textarea text">{!! $product->short_descp_ban !!}</textarea>
			</div>
		</div>
	</div>
</div>






<!-- ..........8th Row............ -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<h5>Long Description En <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea id="editor1" name="long_descp_en" rows="10" cols="80" required>
				{!! $product->long_descp_en !!}
				</textarea>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<h5>Short Description Ban <span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea id="editor2" name="long_descp_ban" rows="10" cols="80" required>
				{!! $product->long_descp_ban !!}
				</textarea>
			</div>
		</div>
	</div>
</div>
	<hr>



<!-- ..........9th Row............ -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="controls">
				<input type="checkbox" id="checkbox_1" name="hot_deals" value="1" {{ $product->hot_deals == 1 ?'checked' : '' }}>
				<label for="checkbox_1">Hot Deals</label><br>
				<input type="checkbox" id="checkbox_2" name="featured" value="1" {{ $product->featured == 1 ?'checked' : '' }}>
				<label for="checkbox_2">Featured</label>
			</div>								
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<div class="controls">
				<input type="checkbox" id="checkbox_3" name="special_offer" value="1" {{ $product->special_offer == 1 ?'checked' : '' }}>
				<label for="checkbox_3">Special Offer</label><br>
				<input type="checkbox" id="checkbox_4" name="special_deals" value="1" {{ $product->special_deals == 1 ?'checked' : '' }}>
				<label for="checkbox_4">Special Deals</label>
			</div>								
		</div>
	</div>
</div>


	</div>					
</div>
						
						
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
			  <div class="box-header">
				<h4 class="box-title">Product Multiple Images <strong>Update</strong></h4>
			  </div>


			<form action="{{ route('update-product-image') }}" method="post" enctype="multipart/form-data">
				@csrf

			  <div class="row row-sm">
			  	@foreach($multiImgs as $img)
			  	<div class="col-md-3">
			  		<div class="card">
					  <img src="{{ asset($img->photo_name) }}"  class="card-img-top" style="height: 170px; width: 280px;">
					  
					  <div class="card-body">
					    <h5 class="card-title">
					    	<a href="{{ route('multiple-img-delete',$img->id) }}" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
					    </h5>
					    <p class="card-text">
					    	<div class="form-group">
					    		<label class="form-control-label">Change Image<span class="text-danger">*</span></label>
					    		<input type="file" name="multi_img[{{ $img->id }}]" class="form-control">
					    	</div>
					    </p>
					    
					  </div>
					</div>
			  	</div>
			  	@endforeach

			  </div>
			  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
			  <br><br>
			</form>

			  
			</div>
		</div>
	</div>
</section>




<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
			  <div class="box-header">
				<h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
			  </div>


			<form action="{{ route('update-product-thamdnail') }}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{ $product->id }}">
				<input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">

			  <div class="row row-sm">
			  	<div class="col-md-3">
			  		<div class="card">
					  <img src="{{ asset($product->product_thambnail) }}"  class="card-img-top" style="height: 170px; width: 280px;">

					  <div class="card-body">
					    
					    <p class="card-text">
					    	<div class="form-group">
					    		<label class="form-control-label">Change Image<span class="text-danger">*</span></label>
					    		<input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" required>
								<img src="" id="mainThmb"> 
					    	</div>
					    </p>
					    
					  </div>
					</div>
			  	</div>

			  </div>
			  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
			  <br><br>
			</form>

			  
			</div>
		</div>
	</div>
</section>





	  </div>
<script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                    	$('select[name="subsubcategory_id"]').html('');
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_eng + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });





        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d = $('select[name="subsubcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.sub_subcategory_name_eng + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });







    });
</script>



<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src', e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
</script>

@endsection