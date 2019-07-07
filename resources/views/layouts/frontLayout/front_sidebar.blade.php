<?php use App\Product; ?>
<form action="{{ url('/products-filter') }}" method="post">{{ csrf_field() }}
	@if(!empty($url))
	<input name="url" value="{{ $url }}" type="hidden">
	@endif 
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian">
			@foreach($categories as $cat)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
								<span class="badge pull-right"><i class="fa fa-plus"></i></span>
								{{$cat->name}}
							</a>
						</h4>
					</div>
					<div id="{{$cat->id}}" class="panel-collapse collapse">
						<div class="panel-body">
							<ul>
								@foreach($cat->categories as $subcat)
									<?php $productCount = Product::productCount($subcat->id); ?>
									@if($subcat->status==1)
									<li><a href="{{ asset('products/'.$subcat->url) }}">{{$subcat->name}} </a> ({{ $productCount }})</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		@if(!empty($url))
		
			<h2>Colors</h2>	
			<div class="panel-group">
				@foreach($colorArray as $color)
					@if(!empty($_GET['color']))
						<?php $colorArr = explode('-',$_GET['color']) ?>
						@if(in_array($color,$colorArr))
							<?php $colorcheck="checked"; ?>	
						@else
							<?php $colorcheck=""; ?>
						@endif		
					@else
						<?php $colorcheck=""; ?>
					@endif
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input name="colorFilter[]" onchange="javascript:this.form.submit();" id="{{ $color }}" value="{{ $color }}" type="checkbox" {{ $colorcheck }}>&nbsp;&nbsp;<span class="products-colors">{{ $color }}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>

			<div>&nbsp;</div>

			<h2>Sleeve</h2>	
			<div class="panel-group">
				@foreach($sleeveArray as $sleeve)
					@if(!empty($_GET['sleeve']))
						<?php $sleeveArr = explode('-',$_GET['sleeve']) ?>
						@if(in_array($sleeve,$sleeveArr))
							<?php $sleevecheck="checked"; ?>	
						@else
							<?php $sleevecheck=""; ?>
						@endif		
					@else
						<?php $sleevecheck=""; ?>
					@endif
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input name="sleeveFilter[]" onchange="javascript:this.form.submit();" id="{{ $sleeve }}" value="{{ $sleeve }}" type="checkbox" {{ $sleevecheck }}>&nbsp;&nbsp;<span class="products-sleeves">{{ $sleeve }}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>

			<div>&nbsp;</div>

			<h2>Pattern</h2>	
			<div class="panel-group">
				@foreach($patternArray as $pattern)
					@if(!empty($_GET['pattern']))
						<?php $patternArr = explode('-',$_GET['pattern']) ?>
						@if(in_array($pattern,$patternArr))
							<?php $patterncheck="checked"; ?>	
						@else
							<?php $patterncheck=""; ?>
						@endif		
					@else
						<?php $patterncheck=""; ?>
					@endif
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input name="patternFilter[]" onchange="javascript:this.form.submit();" id="{{ $pattern }}" value="{{ $pattern }}" type="checkbox" {{ $patterncheck }}>&nbsp;&nbsp;<span class="products-patterns">{{ $pattern }}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>

			<div>&nbsp;</div>

			<h2>Size</h2>	
			<div class="panel-group">
				@foreach($sizesArray as $size)
					@if(!empty($_GET['size']))
						<?php $sizeArr = explode('-',$_GET['size']) ?>
						@if(in_array($size,$sizeArr))
							<?php $sizecheck="checked"; ?>	
						@else
							<?php $sizecheck=""; ?>
						@endif		
					@else
						<?php $sizecheck=""; ?>
					@endif
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<input name="sizeFilter[]" onchange="javascript:this.form.submit();" id="{{ $size }}" value="{{ $size }}" type="checkbox" {{ $sizecheck }}>&nbsp;&nbsp;<span class="products-sizes">{{ $size }}</span>
							</h4>
						</div>
					</div>
				@endforeach
			</div>

			<div>&nbsp;</div>

		@endif
		
	</div>
</form>