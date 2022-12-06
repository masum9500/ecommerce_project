@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

<!-- ..............Update Brand............ -->



<div class="col-md-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Update Slider</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <form action="{{ route('slider-update') }}" method="POST" enctype="multipart/form-data">
						@csrf	
						<input type="hidden" name="id" value="{{ $slider->id }}">				
						<input type="hidden" name="old_image" value="{{ $slider->slider_img }}">				
								<div class="form-group">
									<h5>Slider Title <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="title" class="form-control" value="{{ $slider->title }}" \> <div class="help-block"></div></div>
								</div>
								<div class="form-group">
									<h5>Slider Description <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="description" class="form-control" value="{{ $slider->description }}" \> <div class="help-block"></div></div>
										
								</div>
								<div class="form-group">
									<h5>Slider Image</h5>
									<div class="controls">
										<img src="{{ asset($slider->slider_img) }}" style="width: 270px; height: 180px;"> 
										
								</div>
								<div class="form-group">
									<h5>Slider Image <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="file" name="slider_img" class="form-control" onChange="mainThamUrl(this)"> <div class="help-block"></div></div>
										<img src="" id="mainThmb"> 
										@error('slider_img')
											<span class="text-danger">{{ $message }}</span>
										@enderror
								</div>
								
					<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Slider">
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

@endsection