@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

<!-- ..............Update Category............ -->



<div class="col-md-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Update Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('category.update') }}" method="POST">
						@csrf	
						<input type="hidden" name="id" value="{{ $category->id }}">			
								<div class="form-group">
									<h5>Category Name English <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_name_eng" class="form-control" value="{{ $category->category_name_eng }}" \> <div class="help-block"></div></div>
										@error('category_name_eng')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Category Name Bangla <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_name_ban" class="form-control" value="{{ $category->category_name_ban }}" \> <div class="help-block"></div></div>
										@error('category_name_ban')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Brand Image <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_icon" class="form-control" value="{{ $category->category_icon }}" \> <div class="help-block"></div></div>
										@error('category_icon')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Category">
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