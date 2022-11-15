@extends('admin.admin_master')
@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub->SubCategory List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped text-center">
						<thead>
							<tr>

								<th>Category </th>
								<th>Sub Category </th>
								<th>Sub-Category Eng</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($subsubcategories as $item)
							<tr>
								<td width="">{{ $item['category']['category_name_eng'] }}</td>
								<td width="">{{ $item['subcategory']['subcategory_name_eng'] }}</td>
								<td width="">{{ $item->sub_subcategory_name_eng }}</td>
								
								<td width="25%">
									<a href="{{ route('subsubcategory.edit',$item->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('subsubcategory.delete',$item->id) }}" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add Sub SubCategory</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('subsubcategory.store') }}" method="POST">
						@csrf					
<div class="form-group">
	<h5>Category Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="category_id" class="form-control"  >
			<option value="" selected="" disabled="">Select Category</option>
			@foreach($categories as $category)
			<option value="{{ $category->id }}">{{ $category->category_name_eng }}</option>	
			@endforeach
		</select>
		@error('category_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>


		  <div class="form-group">
	<h5>SubCategory Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="subcategory_id" class="form-control"  >
			<option value="" selected="" disabled="">Select SubCategory</option>
			 
		</select>
		@error('subcategory_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>
						<div class="form-group">
							<h5>SubSubCategory Name English <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="sub_subcategory_name_eng" class="form-control" \> <div class="help-block"></div></div>
								@error('sub_subcategory_name_eng')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						</div>
						<div class="form-group">
							<h5>SubSubCategory Name Bangla <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="sub_subcategory_name_ban" class="form-control" \> <div class="help-block"></div></div>
								@error('sub_subcategory_name_ban')
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
    });
    </script>






@endsection