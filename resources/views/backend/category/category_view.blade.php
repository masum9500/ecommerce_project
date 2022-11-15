@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped text-center">
						<thead>
							<tr>

								<th>Icon</th>
								<th>Category Eng</th>
								<th>Category Ban</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($categories as $item)
							<tr>
								<td width="10%"><i class="{{ $item->category_icon }} "></i></td>
								<td width="30%">{{ $item->category_name_eng }}</td>
								<td width="30%">{{ $item->category_name_ban }}</td>
								
								<td width="30%">
									<a href="{{ url('edit',$item->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
									<a href="{{ url('delete', $item->id)}}" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
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
		  




<!-- ..............Add New Category............ -->



<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('category.store') }}" method="POST">
						@csrf					
								<div class="form-group">
									<h5>Category Name English <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_name_eng" class="form-control"\> <div class="help-block"></div></div>
										@error('category_name_eng')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Category Name Bangla <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_name_ban" class="form-control" \> <div class="help-block"></div></div>
										@error('category_name_ban')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								<div class="form-group">
									<h5>Category Icon <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_icon" class="form-control" \> <div class="help-block"></div></div>
										@error('category_icon')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Category">
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