@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">



<!-- ..............Edit New SubCategory............ -->



<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit SubCategory</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('subcategory.update') }}" method="POST">
						@csrf
						<input type="hidden" name="sub_cat_id" value="{{ $subcategories->id }}">					
						<div class="form-group">
							<h5>Category Select <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="category_id" class="form-control">
									<option value="" selected="" disabled>Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ $category->id == $subcategories->category_id ? 'selected' : ''}}>{{ $category->category_name_eng }}</option>
									@endforeach

								</select>
								@error('category_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							<div class="help-block"></div></div>
						</div>
						<div class="form-group">
							<h5>SubCategory Name English <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="subcategory_name_eng" class="form-control" value="{{ $subcategories->subcategory_name_eng }}" \> <div class="help-block"></div></div>
								@error('subcategory_name_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						</div>
						<div class="form-group">
							<h5>SubCategory Name Bangla <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="subcategory_name_ban" class="form-control" value="{{ $subcategories->subcategory_name_ban }}"\> <div class="help-block"></div></div>
								@error('subcategory_name_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update SubCategory">
					</form>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->          
			</div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
	  </div>



@endsection