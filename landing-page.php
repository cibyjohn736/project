<?php

$frmContact_name 		= "";
$frmContact_phone 		= "";
$frmContact_email 		= "";
$frmContact_address 	= "";
$frmContact_details 	= "";
$frmContact_date	 	= "";
$frmContact_service 	= "";
$frmContact_id 			= "";
$msg 		= "";
$msgName 	= "";
$msgPhone 	= "";
$msgEmail 	= "";
$msgaddress	= "";
$msgdetails	= "";
$msgdate	= "";
$msgservice	= "";
$msgid	 	= "";
$isValid 	= TRUE;
if (isset($_REQUEST['param']) && $_REQUEST['param']=='care'){
	$msg = "<p>Thank you for your message! We will get in touch with you shortly.</p>";
}
if (isset($_POST["btnSubmit"])){
    $name = "";
    //print_r($_REQUEST);
    $frmContact_name = trim($_POST["_frm_req_str_Name"]);
    $frmContact_phone = trim($_POST["_frm_req_str_Phone"]);
    $frmContact_email = trim($_POST["_frm_req_str_Email"]);
   // $frmContact_address = trim($_POST["_frm_req_str_address"]);
   // $frmContact_details = trim($_POST["_frm_req_str_details"]);
   // $frmContact_date = trim($_POST["_frm_req_str_date"]);
   // $frmContact_service = trim($_POST["_frm_req_str_Service"]); 
    #SERVER SIDE VALIDATION	
    $regex = '/^[0-9- ]+$/';
    $regexEmail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    $regexName = "/[\^*#@><()|]/";
    $regexSpecialCharacters = "/[\><()]/";
    if (strlen($frmContact_name) == 0 || $frmContact_name == "First Name") {
		$msgName = "Please enter name.";
		$isValid = FALSE;
    } else {
		if (preg_match($regexName, $frmContact_name)) {
			$msgName = "Please avoid special characters.";
			$isValid = FALSE;
		} 
		else {
			$arrName = explode(" ", preg_replace('/\s+/', ' ',$frmContact_name));
			if (count($arrName) > 1) {
			$i = 0;
			do {
				$frmContact_name = $frmContact_name ;
				$i++;
			} while ($i < (count($arrName)-1));
			$frmContact_name = trim($frmContact_name);
		}
		}
	}
    if (strlen($frmContact_phone) == 0 || $frmContact_phone == "Phone") {
	$msgPhone = "Please enter your phone/mobile number.";
	$isValid = FALSE;
    } else if (strlen($frmContact_phone) != 0 && $frmContact_phone != "Phone" && !preg_match($regex, $frmContact_phone)) {
	$msgPhone = "Please enter a valid phone/mobile number.";
	$isValid = FALSE;
    }
    if (strlen($frmContact_email) == 0 || $frmContact_email == "Mail ID") {
	$msgEmail = "Please enter your email address.";
	$isValid = FALSE;
    } else if (strlen($frmContact_email) != 0 && $frmContact_email != "Email Address" && !preg_match($regexEmail, $frmContact_email)) {
	$msgEmail = "Please enter a valid email address.";
	$isValid = FALSE;
    } 
    $_SESSION["success_fixed_message"] = "error-msg"; 
    #END VALIDATION
    if ( $isValid == 1) 
	{
		 $from_address = "cochin@caremarkindia.in";
		 $subject = "Caremark India - Reach Us".' '.$frmContact_name.' '.' ,'.' '.$frmContact_phone;
	// To send HTML mail, the Content-type header must be set

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

// Create email headers

$headers .= 'From: '.$from."\r\n".

    'Reply-To: '.$from."\r\n" .

    'X-Mailer: PHP/' . phpversion();



		 $body = "<html><body>";



		 $body .=  "<br> Dear Administrator,<br><br>";



		 $body .= " There is an enquiry from the website's Reach Us form.<br> Please find the contact details below:<hr /><table>";



		 $body .= " <tr><td width='40%' style='font-weight: bold;'>Name:</td><td width='60%'>". $frmContact_name ."</td></tr>";



		 $body .= "<tr><td style='font-weight: bold;'>Phone Number:</td><td>". $frmContact_phone ."</td></tr>";



		 $body .= "<tr><td style='font-weight: bold;'>Mail ID:</td><td>". $frmContact_email ."</td></tr>";



		// $body .= "<tr><td style='font-weight: bold;' valign='top'>Address:</td><td>". $frmContact_address ."</td></tr>";



		// $body .= "<tr><td style='font-weight: bold;'>Service:</td><td>". $frmContact_service . "</td></tr>";



		// $body .= "<tr><td style='font-weight: bold;'>Date and Time:</td><td>". $frmContact_date . "</td></tr>";



		// $body .= "<tr><td style='font-weight: bold;' valign='top'>Details:</td><td>". $frmContact_details ."</td></tr>";



		 $body .= "</table><hr />";



		 $body .= "<em>This email was sent via the callback form on the Caremark India.</em>";



		 $body .= "</body></html>";



        $to = 'cibyjohn736@gmail.com';

		// $sendmail = mail("caremarkindia@gmail.com",$subject,$body,$headers);
		 
		$sendmail = mail( $to,$subject,$body,$headers);

		 

		 sendMail($from_address,"","","cibyjohn736@gmail.com",$subject, $body);



	



		 if ($sendmail == true) {	



			/*unset($_POST);



			 



			$msg = "Thank you for your message! We will get in touch with you shortly.";



			$frmContact_name = "";



			$frmContact_phone = "";



			$frmContact_email = "";



			$frmContact_id = "";



			$frmContact_address = "";	*/	



			header('Location: thank-you.html');



			}else {	



			 	$msg	= "Oops! Something went wrong. Please try again later."; 



			$frmContact_name = "";



			$frmContact_phone = "";



			$frmContact_email = "";



			$frmContact_address = "";	



			$frmContact_details = "";



			$frmContact_address = "";



		 }



	}



}
	function sendMail( $to, $replyto, $cc, $bcc,  $subject , $email_message )



	{



		require_once("files/class.phpmailer.php");



		require_once("files/class.smtp.php");



		



		$mail = new PHPMailer();



		$mail->SetLanguage("en", "lib/");



		$mail->IsSMTP();



		$mail->SMTPSecure 	= "ssl"; //SSL should be enabled for mailgun



		$mode				= "html";



	



		$mail->Host		= "smtp.mailgun.org";



		$mail->SMTPAuth	= true;



		$mail->Port		= 465;



		



		$mail->Username	= "postmaster@sandboxaec8733709eb4402adae5693f2556a82.mailgun.org";



		$mail->Password	= "192ac0865g02";



		



		$mail->From		= "cibyjohn736@gmail.com";



		$mail->FromName	= "Landing Page";



	



		if ( strpos($to , ";") > -1 )



		{



			$strTo = explode(';',$to);



			



			foreach( $strTo as &$value){



				



				if ( trim($value) != "" )



					$mail->AddAddress($value);



			}



		}



		else



		{



			if ( trim($to) != "" )



				$mail->AddAddress($to);		



		}



		



		if ( strpos($cc,";") > -1 )



		{



			$strCC = explode(';',$cc);



	



			foreach( $strCC as &$value)



			{



				if ( trim($value) != "" )



					$mail->AddCC($value);		



			}



		}



		else



		{



			if ( trim($cc) != "" )



				$mail->AddCC($cc);		



		}



			



		if ( strpos($bcc,";") > -1)



		{



			$strBCC = explode(';',$bcc);



			foreach( $strBCC as &$value)



			{



				if ( trim($value) != "" )			



					$mail->AddBCC($value);		



			}



		}	



		else



		{



			if ( trim($bcc) != "" )



				$mail->AddBCC($bcc);		



		}	



		



		if ( $replyto != "")



		{



			$mail->AddReplyTo($replyto);		



		}	



		



		$mail->Subject = $subject;



		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';	 



		$mail->MsgHTML( $email_message );



		



		if( $mail->Send())



		{



			return true;



		}



		else



		{



			return false;



		}



	}



?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<title>Welcome to Landing Page</title>

<!-- Bootstrap -->

<!--<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/responsive-tabs.css" rel="stylesheet">-->

<!-- Custom-->
  
<!--<link href="css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DateTimePicker.css" />
<script src="js/placeholders.min.js" type="text/javascript"></script>
<script src="js/testimonial-slider.js" type="text/javascript"></script>

 <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
 <script type="text/javascript" src="js/carousels.js"></script>-->


<!-- Favicon -->

<!--<link rel="icon" type="image/x-icon" href="images/favicon.ico"/>-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>



      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>



      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>



    <![endif]-->

<script type="text/javascript" >

  function limitText(limitField, limitNum) {

            if (limitField.value.length > limitNum) {

                limitField.value = limitField.value.substring(0, limitNum);

            }
        }

	function validate(){
		var name = document.getElementById('_frm_req_str_Name').value;

		var email = document.getElementById('_frm_req_str_Email').value;

		var phone = document.getElementById('_frm_req_str_Phone').value;

		//var address = document.getElementById('_frm_req_str_address').value;

		//var date = document.getElementById('_frm_req_str_date').value;

		//var service = document.getElementById('_frm_req_str_Service').value;
		
		//var namefilter = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
		var namefilter = /^[a-zA-Z ]+$/;
          $("#error_name").html('');
		  $("#error_phone").html('');
		  $("#error_email").html('');
			
		if(name==""){

		document.getElementById('_frm_req_str_Name').style.border="1px solid red";

		document.getElementById('_frm_req_str_Name').focus();
         $("#error_name").html('Please fill in your name.');
		return false;

	}

	else if (!namefilter.test(name))

	{

		document.getElementById('_frm_req_str_Name').style.border="1px solid red";

		document.getElementById('_frm_req_str_Name').focus();
         $("#error_name").html('Please enter a valid name.');
		return false;

	}else{

		document.getElementById('_frm_req_str_Name').style.border="";
        $("#error_name").html('');
	}


	var phonefilter = /^[0-9- ]+$/;

	if(phone==""){

		document.getElementById('_frm_req_str_Phone').style.border="1px solid red";

		document.getElementById('_frm_req_str_Phone').focus();
         $("#error_phone").html('Please fill in your phone number.');
		return false;


	}else if (!phonefilter.test( phone )){
         
		document.getElementById('_frm_req_str_Phone').style.border="1px solid red";

		document.getElementById('_frm_req_str_Phone').focus();
         $("#error_phone").html('Please enter a valid phone number.');
		return false;

	}else if(phone.length < 10){
		document.getElementById('_frm_req_str_Phone').style.border="1px solid red";

		document.getElementById('_frm_req_str_Phone').focus();
         $("#error_phone").html('Please enter a valid phone number.');
		return false;
	}else{
		document.getElementById('_frm_req_str_Phone').style.border="";
		 $("#error_phone").html('');

	}

	var emailfilter = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;


	if(email==""){



		document.getElementById('_frm_req_str_Email').style.border="1px solid red";



		document.getElementById('_frm_req_str_Email').focus();

          $("#error_email").html('Please fill in your email address.');

		return false;



	}else if (!emailfilter.test( email )){



		document.getElementById('_frm_req_str_Email').style.border="1px solid red";



		document.getElementById('_frm_req_str_Email').focus();

         $("#error_email").html('Please enter a valid email adrress.');

		return false;



	}else{



	document.getElementById('_frm_req_str_Email').style.border="";

    $("#error_email").html('');

	}



	



	/*if(address=="" || address == null || address =='Address'){



		document.getElementById('_frm_req_str_address').style.border="1px solid red";



		document.getElementById('_frm_req_str_address').focus();



		return false;



	}else{



		document.getElementById('_frm_req_str_address').style.border="";



	}



	



	if(service=="0" || service == null){



		document.getElementById('_frm_req_str_Service').style.border="1px solid red";



		document.getElementById('_frm_req_str_Service').focus();



		return false;



	}else{



		document.getElementById('_frm_req_str_Service').style.border="";



	}



	



	if(date=="" || date == null){



		document.getElementById('_frm_req_str_date').style.border="1px solid red";



		document.getElementById('_frm_req_str_date').focus();



		return false;



	}else{



		document.getElementById('_frm_req_str_date').style.border="";


	}*/

}


</script>

<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/contact-buttons.css"> -->
	

	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MHRXW8J');</script>
<!-- End Google Tag Manager -->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHRXW8J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<div class="banner-background">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
        <h1> CARE WITH A PERSONAL TOUCH </h1>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 contact-form">
       <a name="contact"></a> 
        <form role="form" class="main-form"  name="contact_srtform" method="post">
          <h3>Reach Us</h3>
          <div id="divSuccessMessage"> <?php echo $msg; ?> </div>
          <div class="clearfix"></div>
          <div class="form-group"> 
            
            <!--Name-->
            
            <input type="text" class="form-control" maxlength="100" name="_frm_req_str_Name" id="_frm_req_str_Name"    value="<?php echo htmlentities (  $frmContact_name); ?>" title="Name" placeholder="Name" required/>
            <span class="errorMsg" <?php if (strlen($msgName) == 0) echo "style='display:none;'";?>><?php echo $msgName; ?></span>
            <span id="error_name"></span>
          </div>
          
          <!--Phone Number-->
          
          <div class="form-group">
            <input type="tel" class="form-control" maxlength="50" name="_frm_req_str_Phone" min="10" id="_frm_req_str_Phone"  value="<?php echo htmlentities (  $frmContact_phone); ?>" title="Phone Number" placeholder="Phone Number" required/>
            <span class="errorMsg" <?php if (strlen($msgPhone) == 0) echo "style='display:none;'";?>><?php echo $msgPhone; ?></span>
            <span id="error_phone"></span>
          </div>
          
          <!--Mail ID-->
          
          <div class="form-group">
            <input type="text" class="form-control" maxlength="100" name="_frm_req_str_Email" id="_frm_req_str_Email"  value="<?php echo htmlentities (  $frmContact_email); ?>" title="Mail ID" placeholder="Mail ID" required/>
            <span class="errorMsg" <?php if (strlen($msgEmail) == 0) echo "style='display:none;'";?>><?php echo $msgEmail; ?></span>
             <span id="error_email"></span>
          </div>
          
          <!--Address-->
          
          
          
          <!--Service-->
          
          
        <!--  <p>Convenient date and time for initial assessment</p> -->
          
          
          <!--Details-->
          
     
            
          <button class="btn btn-lg btn-blue pull-right" type="submit"  onclick="return validate();" name="btnSubmit" id="btnSubmit">Submit</button>
          <div class="clearfix"></div>
          
          <!--<input type="submit" class="btn-submit" style="float:left;"  onclick="return validate();" value="SUBMIT" name="btnSubmit" id="btnSubmit"> -->
          
        </form>
      </div>
    </div>
  </div>
</div>






<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 


<script>



		$(document).ready(function() {



			RESPONSIVEUI.responsiveTabs();
			
			$("#anchor_first").click(function(){
				
			$(document).scrollTop( $(".responsive-tabs").offset().top );
			  
			});	
			$("#anchor_second").click(function(){
				
			$(document).scrollTop( $(".responsive-tabs").offset().top );
			  
			});	
			$("#anchor_third").click(function(){
				
			$(document).scrollTop( $(".responsive-tabs").offset().top );
			  
			});	
			$("#anchor_four").click(function(){
				
			$(document).scrollTop( $(".responsive-tabs").offset().top );
			  
			});	



		})



		</script> 







</body>
</html>
