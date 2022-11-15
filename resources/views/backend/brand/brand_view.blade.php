@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Brand List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Brand Eng</th>
								<th>Brand Ban</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($brands as $item)
							<tr>
								<td>{{ $item->brand_name_en }}</td>
								<td>{{ $item->brand_name_ban }}</td>
								<td>
									<img src="{{ asset($item->brand_image) }}" style="width: 40px; height: 70px;">
								</td>
								<td>
									<a href="{{ url('brand/edit',$item->id) }}" class="btn btn-info">Edit</a>
									<a href="{{ url('brand/delete', $item->id)}}" class="btn btn-danger" >Delete</a>
								</td>
							</tr>
							@endforeach	
							
					</table>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  




<!-- ..............Add New Brand............ -->



<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
						@csrf					
								<div class="form-group">
									<h5>Brand Name English <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="brand_name_en" class="form-control"\> <div class="help-block"></div></div>
										@error('brand_name_en')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Brand Name Bangla <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="brand_name_ban" class="form-control" \> <div class="help-block"></div></div>
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