@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>
<section>
		<div class="container">
			<div class="row">
			@if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#d7efe5">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
	                    <strong>{!! session('flash_message_error') !!}</strong>
	            </div>
	        @endif   
				<div class="col-sm-3">
					@include('layouts.frontLayout.front_sidebar')	
				</div>
				
				<div class="col-sm-9 padding-right">

					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a id="mainImgLarge" href="{{ asset('/images/backend_images/product/large/'.$productDetails->image) }}">
									<img style="width:300px" id="mainImg" src="{{ asset('/images/backend_images/product/medium/'.$productDetails->image) }}" alt="" />
								</a>
								</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										@if(count($productAltImages)>0)
										<div class="item active thumbnails">
												@foreach($productAltImages as $altimg)
													<a href="{{ asset('images/backend_images/product/medium/'.$altimg->image) }}" data-standard="{{ asset('images/backend_images/product/small/'.$altimg->image) }}">
										  				<img class="changeImage" style="width:80px; cursor:pointer" src="{{ asset('images/backend_images/product/small/'.$altimg->image) }}" alt="">
													</a>
												@endforeach
										</div>
										@endif
									</div>

								  <!-- Controls -->
								  <!-- <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a> -->
							</div>

						</div>
						<div class="col-sm-7">
							<form name="addtoCartForm" id="addtoCartForm" action="{{ url('add-cart') }}" method="post">{{ csrf_field() }}
		                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
		                        <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
		                        <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
		                        <input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
		                        <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
								<div class="product-information"><!--/product-information-->
									<div align="left"><?php echo $breadcrumb; ?></div>
									<div>&nbsp;</div>
									<img src="images/product-details/new.jpg" class="newarrival" alt="" />
									<h2>{{ $productDetails->product_name }}</h2>
									<p>Product Code: {{ $productDetails->product_code }}</p>
									<p>Product Color: {{ $productDetails->product_color }}</p>
									@if(!empty($productDetails->sleeve))
										<p>Sleeve: {{ $productDetails->sleeve }}</p>
									@endif
									@if(!empty($productDetails->pattern))
										<p>Pattern: {{ $productDetails->pattern }}</p>
									@endif
									<p>
										<select id="selSize" name="size" style="width:150px;" required>
											<option value="">Select</option>
											@foreach($productDetails->attributes as $sizes)
											<option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
											@endforeach
										</select>	
									</p>
									<span>
										<?php $getCurrencyRates = Product::getCurrencyRates($productDetails->price); ?>
										<span id="getPrice">
											INR {{ $productDetails->price }}<br>
											<h2>
												USD {{ $getCurrencyRates['USD_Rate'] }}<br>
												GBP {{ $getCurrencyRates['GBP_Rate'] }}<br>
												EUR {{ $getCurrencyRates['EUR_Rate'] }}<br>
											</h2>
										</span>
										<label>Quantity:</label>
										<input name="quantity" type="text" value="1" />
										@if($total_stock>0)
											<button type="submit" class="btn btn-fefault cart" id="cartButton">
												<i class="fa fa-shopping-cart"></i>
												Add to cart
											</button>
										@endif	
									</span>
									<p><b>Availability: </b><span id="Availability"> @if($total_stock>0) In Stock @else Out Of Stock @endif</span></p>
									<p><b>Condition:</b> New</p>

									<p><b>Delivery</b>
									<input type="text" name="pincode" id="chkPincode" placeholder="Check Pincode">
									<button type="button" onclick="return checkPincode();">Go</button>
									<span id="pincodeResponse"></span>
									<div style="float:left; margin-top: 10px;" class="sharethis-inline-share-buttons"></div>
						
								</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
								@if(!empty($productDetails->video))
									<li><a href="#video" data-toggle="tab">Product Video</a></li>
								@endif
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="description" >
								<div class="col-sm-12">
									<p>{{ $productDetails->description }}</p>
								</div>	
							</div>
							
							<div class="tab-pane fade" id="care" >
								<div class="col-sm-12">
									<p>{{ $productDetails->care }}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
									<p>100% Original Products <br>
									Cash on delivery might be available</p>
								</div>
							</div>

							@if(!empty($productDetails->video))
								<div class="tab-pane fade" id="video" >
									<div class="col-sm-12">
										<video controls width="640" height="480">
										  <source src="{{ url('videos/'.$productDetails->video)}}" type="video/mp4">
										</video>
									</div>
								</div>
							@endif
					
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
								<div <?php if($count==1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>	
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:200px;" src="{{ asset('images/backend_images/product/small/'.$item->image) }}" alt="" />
													<h2>INR {{ $item->price }}</h2>
													<p>{{ $item->product_name }}</p>
													<a href="{{ url('/product/'.$item->id) }}"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button></a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>	

@endsection