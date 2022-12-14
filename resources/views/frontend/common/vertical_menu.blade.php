@php
$categories = App\Models\Category::orderBy('category_name_eng', 'ASC')->get();
@endphp        
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">




            @foreach($categories as $category)
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>@if(session()->get('language') == 'bangla') {{ $category->category_name_ban }} @else {{ $category->category_name_eng }} @endif</a>
                <ul class="dropdown-menu mega-menu">
                  <li class="yamm-content">
                    <div class="row">


                @php
                $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_eng', 'ASC')->get();
                @endphp

                @foreach($subcategories as $subcategory)


                      <div class="col-sm-12 col-md-3">
                        <a href="{{ url('product/sub_cat/'.$subcategory->id.'/'.$subcategory->subcategory_slug_eng) }}">
                        <h2 class="title">
                          @if(session()->get('language') == 'bangla') {{ $subcategory->subcategory_name_ban }} @else {{ $subcategory->subcategory_name_eng }} @endif
                        </h2></a>

                        @php
                        $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)->orderBy('sub_subcategory_name_eng', 'ASC')->get();
                        @endphp


                        @foreach($subsubcategories as $subsubcategory)
                        <ul class="links list-unstyled">
                          <li><a href="{{ url('product/Sub_sub_cat/'.$subsubcategory->id.'/'.$subsubcategory->sub_subcategory_slug_eng) }}">
@if(session()->get('language') == 'bangla') {{ $subsubcategory->sub_subcategory_name_ban }} @else {{ $subsubcategory->sub_subcategory_name_eng }} @endif
                </a></li>
                        </ul>
                        @endforeach
                      </div>
                @endforeach
                      
                    </div>
                    <!-- /.row --> 
                  </li>
                  <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
            @endforeach              
          







              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a> 
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a> 
                </li>
              
              <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a> 
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              
            </ul>
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>