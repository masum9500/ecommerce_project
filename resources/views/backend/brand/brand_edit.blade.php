@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

<!-- ..............Update Brand............ -->



<div class="col-md-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Update Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
						@csrf	
						<input type="hidden" name="id" value="{{ $brand->id }}">				
						<input type="hidden" name="old_image" value="{{ $brand->brand_image }}">				
								<div class="form-group">
									<h5>Brand Name English <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="brand_name_en" class="form-control" value="{{ $brand->brand_name_en }}" \> <div class="help-block"></div></div>
										@error('brand_name_en')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Brand Name Bangla <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="brand_name_ban" class="form-control" value="{{ $brand->brand_name_ban }}" \> <div class="help-block"></div></div>
										@error('brand_name_ban')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Brand Image <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="file" name="brand_image" class="form-control" \> <div class="help-block"></div></div>
										@error('brand_image')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Brand">
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