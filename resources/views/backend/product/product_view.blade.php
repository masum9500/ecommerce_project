@extends('admin.admin_master')
@section('admin')




	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">

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

								<th>Image</th>
								<th>Product Name </th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Discount </th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							@foreach($products as $item)
							<tr>
								<td width=""><img src="{{ asset($item->product_thambnail) }}" style="width: 50px; height: 60px"></td>
								<td width="">{{ $item->product_name_en }}</td>
								<td width="">{{ $item->product_qty }}</td>
								<td width="">{{ $item->selling_price }}$</td>
								<td width="">
									
									@if($item->discount_price == NULL)
									<span class="badge badge-pill badge-danger">No Discount</span>
									@else
									@php
									$amount = $item->selling_price - $item->discount_price;
									$discount = ($amount/$item->selling_price) * 100;
									@endphp
									<span class="badge badge-pill badge-info">{{ round($discount) }}%</span>
									@endif
								</td>
								<td width="">
									@if($item->status == 1)
									<span class="badge badge-pill badge-success">Active</span>
									@else
									<span class="badge badge-pill badge-danger">Inactive</span>
									@endif
								</td>
								
								<td width="28%">
									<a href="{{ route('product-edit',$item->id) }}" class="btn btn-primary btn-sm" title="View Product Details"><i class="fa fa-eye"></i></a>
									<a href="{{ route('product-edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Product"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('product-delete',$item->id) }}" class="btn btn-danger btn-sm" title="Delete Product" ><i class="fa fa-trash"></i></a>


									@if($item->status == 1)
									<a href="{{ route('product-inactive',$item->id) }}" class="btn btn-warning btn-sm" title="Product Inactive" ><i class="fa fa-arrow-down"></i></a>
									@else
									<a href="{{ route('product-active',$item->id) }}" class="btn btn-success btn-sm" title="Product Active" ><i class="fa fa-arrow-up"></i></a>
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
		  


		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
	  </div>



@endsection