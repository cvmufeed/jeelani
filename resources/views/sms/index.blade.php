@extends('layouts.app')

@section('content')
<!-- reference:http://www.oodlestechnologies.com/blogs/How-to-Create-Responsive-SMS-BOX-With-Bootstrap --><span style="font-size:16px;"><span style="font-family:arial,helvetica,sans-serif;"><style type="text/css">.help-block .test-danger{
	color:red;
}
.input-sm {
	border-radius: 0 !important;
}
.input-group .form-control {
	border-radius: 0;
	box-shadow: none;  
}
.form-control{
	box-shadow: none !important;
	border-radius: 0;
}
.j-loader {
  position:absolute;
  z-index: 10000;
  top: 50%;
  left: 50%;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.j-mask {
	position: absolute;
    width: 100%;
    height: 100%;
    z-index: 100;
    background: #000;
    opacity: 0.5;
}
.j-loader-message {
	position: absolute;
    z-index: 10000;
    top: 50%;
    left: 50%;
    margin-top: 137px;
    margin-left: 15px;
    font-size: 26px;
}
</style>


</span></span>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Send SMS</div>
					</div>     
					<div class="panel-body">
						<div class="j-loader" style="display: none;"></div>
						<div class="j-loader-message" style="display: none;">Sending ...</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											+91
										</span>
										<input type="text" class="form-control borderRadius" name="phone" value="{{$sms_number}}" id="phone_no" placeholder="Enter Your Mobile Number">                                        
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<textarea class="form-control input-sm borderRadius " type="textarea" id="message" maxlength="140" rows="7">{{$sms_template}}</textarea>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								<span class="help-block">
									<p id="characterlimit" class="help-block ">Left&nbsp;</p>
									<span id="sms_balance"><strong>{{$sms_balance}}</strong></span>&nbsp;SMS Remaining&nbsp;
								</span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" align="right">
								<button class="btn btn-success" id="btnSubmit" name="btnSubmit" type="button">Send SMS</button>                                        
							</div>
						</div>
					</div>                     
					<div class="alert alert-danger" id="alert_danger" style="display:none;">
						<strong>Error!</strong>
						<span class="message">The mobile number should be number</span>
						<button type="button" class="close" onclick="close_alert('alert_danger')">×</button>
					</div>
					<div class="alert alert-success" id="alert_success" style="display:none;">
						<strong>Success!</strong>
						<span class="message">Successfully sent SMS</span>
						<button type="button" class="close" onclick="close_alert('alert_success')">×</button>
					</div>
				</div>  
			</div>    
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	function close_alert(id) {
		$("#"+id).hide();
	}
	$(document).ready(function(){
		$('#characterlimit').text('160 Characters limt');
		$('#message').keydown(function () {
			var max = 160;
			var len = $(this).val().length;
			if (len >= max) {
				$('#characterlimit').text('Left 0');
				$('#characterlimit').addClass('test-danger');
				$('#btnSubmit').addClass('disabled');           
			}
			else {
				var ch = max - len;
				$('#characterlimit').text(ch + ' characters left');
				$('#btnSubmit').removeClass('disabled');
				$('#characterlimit').removeClass('test-danger');           
			}
		});
		$("#btnSubmit").click(function(){
			if (validate_sms()) {
				activateSmsLoader();
			    $.ajax({
			    	url: "/sms",
			    	type: "POST",
			    	data: {
			    		phone:$("#phone_no").val(),
			    		message: $("#message").val(),
			    		_token: "{{csrf_token()}}",
			    	}, 
			    	success: function(result){
			    		result = JSON.parse(result);
			    		if (result.type == "success") {
			    			$("#alert_danger").hide();
			    			$("#alert_success").show();
			    			$("#alert_success > .message").text(result.message);
			    		}
			    		else if (result.type == "error") {
			    			$("#alert_success").hide();
			    			$("#alert_danger").show();
			    			$("#alert_danger > .message").text(result.message);
			    		}
			    		$("#sms_balance").html("<strong>"+result.balance+"</strong>")
			        	deactivateSmsLoader();
			    	},
			    	error: function(result){
			    		deactivateSmsLoader();
			    		$("#alert_success").hide();
		    			$("#alert_danger").show();
		    			$("#alert_danger > .message").text("Some Error Occured. Try again after some time");
			    	}
			    });
			}
		});
		function validate_sms() {
			flag = true;
			if(isNaN($("#phone_no").val())) {
				flag = false;
				$("#alert_danger").show();
			}
			if($("#phone_no").val() < 1000000000) {
				flag = false;
				$("#alert_danger > .message").text("The number should have 10 numbers");
				$("#alert_danger").show();
			}
			if($("#message").val() == "") {
				flag = false;
				$("#alert_danger > .message").text("The message cannot be empty");
				$("#alert_danger").show();
			}
			return flag;
		}
		function activateSmsLoader() {
			if($(".j-mask").length == 0) {
				$("body").prepend('<div class="j-mask" style="display: none;"></div>');
			}
			$(".j-mask").show();
			$(".j-loader").show();
			$(".j-loader-message").show();
		}
		function deactivateSmsLoader() {
			$(".j-mask").hide();
			$(".j-loader").hide();
			$(".j-loader-message").hide();
		}   
	});
</script>
@endsection