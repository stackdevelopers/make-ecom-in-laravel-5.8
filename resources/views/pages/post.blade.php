@extends('layouts.frontLayout.front_design')
@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>	
			<div class="col-sm-9 padding-right">
				<div class="features_items" id="app"><!--features_items-->
					<h2 class="title text-center">@{{ testmsg }}</h2>
					<h2 class="title text-center">@{{ responsemsg }}</h2>
					@if(Session::has('flash_message_success'))
			            <div class="alert alert-success alert-block">
			                <button type="button" class="close" data-dismiss="alert">×</button> 
			                    <strong>{!! session('flash_message_success') !!}</strong>
			            </div>
			        @endif
			        @if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<div class="contact-form">
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" v-on:submit.prevent="addPost">{{ csrf_field() }}
				            <div class="form-group col-md-6">
				                <input type="text" v-model="name" class="form-control" placeholder="Name" required="">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" v-model="email" class="form-control" placeholder="Email" required="">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" v-model="subject" class="form-control" placeholder="Subject" required="">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea v-model="message" id="message" class="form-control" rows="8" placeholder="Your Message Here" required=""></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <button type="submit" class="btn btn-primary pull-right">Submit</button>
				            </div>
				        </form>
	    			</div>
				</div><!--features_items-->
			</div>
		</div>
	</div>
</section>

@endsection