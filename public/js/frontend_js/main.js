/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});



$(document).ready(function(){

	// Change Price with Size
	$("#selSize").change(function(){
		var idsize = $(this).val();
		if(idsize==""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idsize:idsize},
			success:function(resp){
				var arr = resp.split('#');
				var arr1 = arr[0].split('-');
				$("#getPrice").html("INR "+arr1[0]+"<br><h2>USD "+arr1[1]+"<br>GBP "+arr1[2]+"<br>EUR "+arr1[3]+"</h2>");
				$("#price").val(arr[0]);
				if(arr[1]==0){
					$("#cartButton").hide();
					$("#Availability").text("Out Of Stock");
				}else{
					$("#cartButton").show();
					$("#Availability").text("In Stock");
				}
				
				
			},error:function(){
				alert("Error");
			}
		});
	});

	// Change Image
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		$("#mainImg").attr("src", image);
		/*$("#mainImgLarge").attr("href", image);*/
	});

	// Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });

});


$().ready(function(){
	// Validate Register form on keyup and submit
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email"
			}
		},
		messages:{
			name:{ 
				required:"Please enter your Name",
				minlength: "Your Name must be atleast 2 characters long",
				accept: "Your Name must contain letters only"		
			}, 
			password:{
				required:"Please provide your Password",
				minlength: "Your Password must be atleast 6 characters long"
			},
			email:{
				required: "Please enter your Email",
				email: "Please enter valid Email",
				remote: "Email already exists!"
			}
		}
	});

	// Validate Register form on keyup and submit
	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			address:{
				required:true,
				minlength:6
			},
			city:{
				required:true,
				minlength:2
			},
			state:{
				required:true,
				minlength:2
			},
			country:{
				required:true
			}
		},
		messages:{
			name:{ 
				required:"Please enter your Name",
				minlength: "Your Name must be atleast 2 characters long",
				accept: "Your Name must contain letters only"		
			}, 
			address:{
				required:"Please provide your Address",
				minlength: "Your Address must be atleast 10 characters long"
			},
			city:{
				required:"Please provide your City",
				minlength: "Your City must be atleast 2 characters long"
			},
			state:{
				required:"Please provide your State",
				minlength: "Your State must be atleast 2 characters long"
			},
			country:{
				required:"Please select your Country"
			},
		}
	});

	// Validate Login form on keyup and submit
	$("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true
			}
		},
		messages:{
			email:{
				required: "Please enter your Email",
				email: "Please enter valid Email"
			},
			password:{
				required:"Please provide your Password"
			}
		}
	});

	$("#passwordForm").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Check Current User Password
	$("#current_pwd").keyup(function(){
		var current_pwd = $(this).val();
		$.ajax({
			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			type:'post',
			url:'/check-user-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				/*alert(resp);*/
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});

	// Password Strength Script
	$('#myPassword').passtrength({
      minChars: 4,
      passwordToggle: true,
      tooltip: true,
      eyeImg : "/images/frontend_images/eye.svg"
    });

    // Copy Billing Address to Shipping Address Script
    $("#copyAddress").click(function(){
    	if(this.checked){
    		$("#shipping_name").val($("#billing_name").val());
    		$("#shipping_address").val($("#billing_address").val());
    		$("#shipping_city").val($("#billing_city").val());
    		$("#shipping_state").val($("#billing_state").val());
    		$("#shipping_pincode").val($("#billing_pincode").val());
    		$("#shipping_mobile").val($("#billing_mobile").val());
    		$("#shipping_country").val($("#billing_country").val());
    	}else{
    		$("#shipping_name").val('');
    		$("#shipping_address").val('');
    		$("#shipping_city").val('');
    		$("#shipping_state").val('');
    		$("#shipping_pincode").val('');
    		$("#shipping_mobile").val('');
    		$("#shipping_country").val('');
    	}
    });

});

function selectPaymentMethod(){
	if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
		/*alert("checked");*/
	}else{
		alert("Please select Payment Method");
		return false;
	}
}

function checkPincode(){
	var pincode = $("#chkPincode").val();
	if(pincode==""){
		alert("Please enter Pincode"); return false;	
	}
	$.ajax({
		type:'post',
		data:{pincode:pincode},
		url:'/check-pincode',
		success:function(resp){
			if(resp>0){
				$("#pincodeResponse").html("<font color='green'>This pincode is available for delivery</font>");
			}else{
				$("#pincodeResponse").html("<font color='red'>This pincode is not available for delivery</font>");	
			}
		},error:function(){
			alert("Error");
		}
	});
}