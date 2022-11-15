@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped text-center">
						<thead>
							<tr>

								<th>Category </th>
								<th>SubCategory Eng</th>
								<th>SubCategory Ban</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($subcategories as $item)
							<tr>
								<td width="25%">{{ $item['category']['category_name_eng'] }}</td>
								<td width="25%">{{ $item->subcategory_name_eng }}</td>
								<td width="25%">{{ $item->subcategory_name_ban }}</td>
								
								<td width="25%">
									<a href="{{ url('category/edit',$item->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
									<a href="{{ url('category/delete', $item->id)}}" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
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
		  




<!-- ..............Add New SubCategory............ -->



<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add SubCategory</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('subcategory.store') }}" method="POST">
						@csrf					
						<div class="form-group">
							<h5>Category Select <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="category_id" class="form-control">
									<option value="" selected="" disabled>Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category_name_eng }}</option>
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
								<input type="text" name="subcategory_name_eng" class="form-control" \> <div class="help-block"></div></div>
								@error('subcategory_name_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						</div>
						<div class="form-group">
							<h5>SubCategory Name Bangla <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="subcategory_name_ban" class="form-control" \> <div class="help-block"></div></div>
								@error('subcategory_name_ban')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add SubCategory">
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