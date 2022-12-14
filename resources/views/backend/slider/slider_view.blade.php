@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-8">

	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Slider List</h3>
		</div>
		<!-- /.box-header -->
<div class="box-body">
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Slider Img</th>
			<th>Title</th>
			<th>Descroption</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($sliders as $item)
		<tr>
			<td><img src="{{ asset($item->slider_img) }}" style="width: 70px; height: 40px;"></td>
			<td>
				@if($item->title == NULL)
				<span class="badge badge-pill badge-danger">No Title</span>
				@else
				{{ $item->title }}
				@endif
			</td>
			<td width="20%">
				{{ substr($item->description,0,20)}}
			</td>
			<td width="10%">
				@if($item->status == 1)
				<span class="badge badge-pill badge-success">Active</span>
				@else
				<span class="badge badge-pill badge-danger">Inactive</span>
				@endif
			</td>
			<td width="30%">
				<a href="{{ route('slider-edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Now"><i class="fa fa-pencil"></i></a>
				<a href="{{ route('slider-delete',$item->id) }}" class="btn btn-danger btn-sm" title="Delete Now" ><i class="fa fa-trash"></i></a>


				@if($item->status == 1)
				<a href="{{ route('slider-inactive',$item->id) }}" class="btn btn-warning btn-sm" title="Inactive Now" ><i class="fa fa-arrow-down"></i></a>
				@else
				<a href="{{ route('slider-active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now" ><i class="fa fa-arrow-up"></i></a>
				@endif
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
<h3 class="box-title">Add Slider</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<div class="table-responsive">
  <form action="{{ route('slider-store') }}" method="POST" enctype="multipart/form-data">
	@csrf					
	<div class="form-group">
		<h5>Slider Title <span class="text-danger">*</span></h5>
		<div class="controls">
			<input type="text" name="title" class="form-control"\> <div class="help-block"></div></div>
			
	</div>
	<div class="form-group">
		<h5>Slider Description <span class="text-danger">*</span></h5>
		<div class="controls">
			<input type="text" name="description" class="form-control" \> <div class="help-block"></div></div>
			
	</div>
	<div class="form-group">
		<h5>Slider Image <span class="text-danger">*</span></h5>
		<div class="controls">
			<input type="file" name="slider_img" class="form-control" \> <div class="help-block"></div></div>
			@error('slider_img')
				<span class="text-danger">{{ $message }}</span>
			@enderror
	</div>
			
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Slider">
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