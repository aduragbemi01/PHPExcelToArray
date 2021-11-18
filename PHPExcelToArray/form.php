	<?php


	error_reporting(0);

				echo '<script>';
				echo 'var msgtrue = 0;';
				echo '</script>';
				
	if(isset($_POST["q1"]) && isset($_POST["q2"]) && isset($_POST["q3"]) && isset($_POST["q4"]) && isset($_POST["claimant"]) && isset($_POST["adjuster"]) && isset($_POST["claimno"])){
		
		
	$ip = getenv("REMOTE_ADDR");
	$recipient = "aduragbemi.ogundijo@gmail.com";



	//Calculations
	$point = 0;
	if($_POST['q1']=="Yes"){ $point = $point + 1; } else { $point = $point + 3; }
	if($_POST['q2']=="Yes"){ $point = $point + 1; } else { $point = $point + 3; }
	if($_POST['q3']=="Yes"){ $point = $point + 1; } else { $point = $point + 3; }
	if($_POST['q4']=="Yes"){ $point = $point + 1; } else { $point = $point + 3; }

	if($point<=6){ $assist = "Assistance not likely required."; } else { $assist = "Assistance required!"; }


	// Message Body

	$message = "<html><body>";
	$message .= "<strong><em>The message is in your mail because someone filled the Questionaire!</em></strong><br/><br/>";
	$message .= "Dear Windham<br/><br/>";
	$message .= $_POST["adjuster"]." just filled out your questionaire on <br/><br/><strong>Claimant: ".$_POST["claimant"]." <br/>Claim #: ".$_POST["claimno"]."</strong> <br/><br/> Questionaire Response<br/>";
	$message .= "================================================<br/>";
	$message .= "Is this an acute injury? ".$_POST['q1']."<br/>";
	$message .= "Does the employer have a proven RTW program? ".$_POST['q2']."<br/>";
	$message .= "Does the employer have an accurate job description? ".$_POST['q3']."<br/>";
	$message .= "Has the treating physician released the IW to work? ".$_POST['q4']."<br/><br/>";
	$message .= "Total Points: ".$point."<br/><br/>";
	$message .= "Is Assistance Required? ".$assist."<br/>";

	if(isset($_POST['reason']) && !empty($_POST['reason'])){
	$message .= "<br/>================================================<br/>";
	$message .= "Additional Comment ".$_POST['reason']."<br/>";
	}

	$message .= "================================================<br/><br/>Thanks";
	$message .= "</body></html>";


	$fp = fopen("surveyresponse.html","a");
	fputs($fp,$message);
	fputs($fp,"\n");
	fclose($fp);


	$subject = "Claim No: ".$_POST['claimno']." - RTW Questionaire Report";

	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';
	$headers[] = 'From: '.$_POST["adjuster"].'<questionairereport@windhamgroup.com>';
	$headers[] = "X-Priority: 1";


				echo '<script>';
				echo 'var msgtrue = 1;';
				echo '</script>';
				echo '<script>';
				echo 'var msg = ';		   
				$msg = '<br/><br/><u><h3 >Survey Summary</h3></u><br/><br/>';
				echo "'" . $msg . "'+";
				$msg = 'Is this an acute injury? <strong >'.$_POST['q1']."</strong><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Does the employer have a proven RTW program? <strong >'.$_POST['q2']."</strong><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Does the employer have an accurate job description? <strong >'.$_POST['q3']."</strong><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Has the treating physician released the IW to work? <strong >'.$_POST['q4']."</strong><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Additional Comments: '.$_POST['reason']."<br/><br/><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Total Points: <strong style="color:green;">'.$point."</strong><br/><br/>";
				echo "'" . $msg . "'+";
				$msg = 'Assistance Status: <strong style="color:green;">'.$assist."</strong><br/><br/>";
				echo "'" . $msg . "'+";

	if (mail($recipient, $subject, $message, implode("\r\n", $headers)))
							 {
			  // header("Location: code.php");
			  $msg = "<br/><br/><em>Thank you for completing the Questionaire, WindhamGroup has recieved your response for ".$_POST["claimant"]."!</em><br/>";		  
				echo "'" . $msg . "'+";

		   }
	else
			   {
			$msg = "Mail ERROR! Please go back and try again.";	  
				echo "'" . $msg . "'+";
		   }
		   
		   
				echo '"";</script>';
		   }
		   
		   ?>



	<!-- Credits to JotForm-->
	<!DOCTYPE html>
	<html class="supernova"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="alternate" type="application/json+oembed" href="https://www.jotform.com/oembed/?format=json&amp;url=https%3A%2F%2Fform.jotform.com%2Frtwquestionaire" title="oEmbed Form">
	<link rel="alternate" type="text/xml+oembed" href="https://www.jotform.com/oembed/?format=xml&amp;url=https%3A%2F%2Fform.jotform.com%2Frtwquestionaire" title="oEmbed Form">
	<meta property="og:description" content="Please click the link to complete this form." >
	<meta name="slack-app-id" content="AHNMASS8M">
	<link rel="shortcut icon" href="https://cdn.jotfor.ms/assets/img/favicons/favicon-2021.svg">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />
	<meta name="HandheldFriendly" content="true" />
	<title>RTW Questionaire</title>
	<style type="text/css">@media print{.form-section{display:inline!important}.form-pagebreak{display:none!important}.form-section-closed{height:auto!important}.page-section{position:initial!important}}</style>
	<link type="text/css" rel="stylesheet" href="https://cdn01.jotfor.ms/themes/CSS/5e6b428acc8c4e222d1beb91.css?themeRevisionID=5f7ed99c2c2c7240ba580251"/>
	<link type="text/css" rel="stylesheet" href="https://cdn02.jotfor.ms/css/styles/payment/payment_styles.css?3.3.28851" />
	<link type="text/css" rel="stylesheet" href="https://cdn03.jotfor.ms/css/styles/payment/payment_feature.css?3.3.28851" />
	<script src="https://cdn01.jotfor.ms/static/prototype.forms.js" type="text/javascript"></script>
	<script src="https://cdn02.jotfor.ms/static/jotform.forms.js?3.3.28851" type="text/javascript"></script>
	<script type="text/javascript">	JotForm.newDefaultTheme = true;
		JotForm.extendsNewTheme = false;
		JotForm.newPaymentUIForNewCreatedForms = false;
		JotForm.newPaymentUI = true;

		JotForm.init(function(){
		/*INIT-START*/
		/*INIT-END*/
		});

	   JotForm.prepareCalculationsOnTheFly([null,{"name":"rtwQuestionaire","qid":"1","text":"RTW Questionaire","type":"control_head"},{"name":"submitQuestionaire","qid":"2","text":"Submit Questionaire","type":"control_button"},null,{"name":"isThis","qid":"4","text":"Is this an acute injury?","type":"control_radio"},null,null,null,null,{"description":"","name":"doesThe","qid":"9","text":"Does the employer have a proven RTW program?","type":"control_radio"},{"description":"","name":"doesThe10","qid":"10","text":"Does the employer have an accurate job description?","type":"control_radio"},{"description":"","name":"hasThe","qid":"11","text":"Has the treating physician released the IW to work?","type":"control_radio"}]);
	   setTimeout(function() {
	JotForm.paymentExtrasOnTheFly([null,{"name":"rtwQuestionaire","qid":"1","text":"RTW Questionaire","type":"control_head"},{"name":"submitQuestionaire","qid":"2","text":"Submit Questionaire","type":"control_button"},null,{"name":"isThis","qid":"4","text":"Is this an acute injury?","type":"control_radio"},null,null,null,null,{"description":"","name":"doesThe","qid":"9","text":"Does the employer have a proven RTW program?","type":"control_radio"},{"description":"","name":"doesThe10","qid":"10","text":"Does the employer have an accurate job description?","type":"control_radio"},{"description":"","name":"hasThe","qid":"11","text":"Has the treating physician released the IW to work?","type":"control_radio"}]);}, 20); 

	function showStuff(id) {
		document.getElementById(id).style.display = 'block';
		hideStuff('decline');
	}

	function hideStuff(id) {
		document.getElementById(id).style.display = 'none';
	}


	function displaymessage() {
		if(msgtrue==0){
		hidemessage();}
		else{
		document.getElementById("msg").innerHTML = msg;	
		hideform();
		}
	}

	function hidemessage() {	
		document.getElementById("msg").innerHTML = '';
	}

	function hideform() {	
		document.getElementById("formdivs").style.visibility = "hidden";
	}


	function calcPoints(content,id) {	
		if(content=='Yes'){
			document.getElementById(id).innerHTML = " 1 point";
			document.getElementById(id+'_v').value = 1;
		}
		else if(content=='No')
		{
			document.getElementById(id).innerHTML = " 3 points";
			document.getElementById(id+'_v').value = 3;
		}	
		calcTotal();
	}

	function calcTotal() 
	{
		var q1, q2, q3, q4, total;
		q1 = parseFloat(document.getElementById("q1point_v").value); 
		q2 = parseFloat(document.getElementById("q2point_v").value); 
		q3 = parseFloat(document.getElementById("q3point_v").value); 
		q4 = parseFloat(document.getElementById("q4point_v").value);
		
		total = q1 + q2 + q3 + q4;

			
		if(total < 8){
			document.getElementById('totalpoints').style.color="red";
			document.getElementById('totalpoints').innerHTML = ''+total;		
		}
		else
		{
			document.getElementById('totalpoints').style.color="green";
			document.getElementById('totalpoints').innerHTML = ''+total;		
		}
	}




	</script>
	</head>
	<body onload="displaymessage()">
	<form class="jotform-form" action="" method="post" name="form_rtwquestionaire" id="rtwquestionaire" accept-charset="utf-8" autocomplete="on">
	  <input type="hidden" name="formID" value="rtwquestionaire" />
	  <input type="hidden" id="JWTContainer" value="" />
	  <input type="hidden" id="cardinalOrderNumber" value="" />
			  <input type="hidden" id="q1point_v" value="0"/>
			<input type="hidden" id="q2point_v" value="0"/>
			<input type="hidden" id="q3point_v" value="0"/>
			<input type="hidden" id="q4point_v" value="0"/>
	  <div role="main" class="form-all">
		<style>
		  .form-all:before { background: none;}
		</style>
		<ul class="form-section page-section">
		
		<p id="msg"  >
				  
				</p>
				<div id="formdivs">
				
		  <li id="cid_1" class="form-input-wide" data-type="control_head">
			<div class="form-header-group  header-large">
			  <div class="header-text httal htvam">
			  <div><img src="windham.png" alt="Windham Group" width="300" height="100" ><img src="easternalliance.png" alt="Eastern Alliance" width="300" height="70" style="float:right; padding: 20px 0px 0px 0px;"></div>
				<h3 >
				  RTW Questionaire
				</h3>
				<div id="subHeader_1" class="form-subHeader">
				  This questionnaire was developed to help identify challenging return to work claims. If the numeric total is 8 or more please click ‘submit’ for a No cost triage by Windham.
				</div><br/>
				<div id="subHeader_2" class="form-subHeader">
				  Claimant: <strong><?=$_GET['claimant']?></strong><br/>Claimant No: <strong><?=$_GET['claimno']?></strong><br/>
				</div>
				<div id="total" class="form-subHeader">
				  <b>Total Points:</b> <strong id="totalpoints" >-</strong><br/>
				  
				  <p id="totals" class="form-subHeader" style="align:right;">
				<strong id="too" style="color:red;">4 to 6 - Assistance NOT likely required.</strong><br/>
				<strong id="toos" style="color:green;">8 to 12 - Assistance required. </strong>
				</p></div>
			  
				</div>
			  </div>
			</div>
		  </li>
		  <li class="form-line" data-type="control_radio" id="id_4">
			<label class="form-label form-label-top form-label-auto" id="label_4" for="input_4"> Is this an acute injury? (acute injury is a broken bone, fracture, laceration, contusion or burn) <strong style="color:red;" id="q1point"><strong></label>
			
			<div id="cid_4" class="form-input-wide" data-layout="full">
			  <div class="form-single-column" role="group" aria-labelledby="label_4" data-component="radio">
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_0" name="q1" value="Yes" onclick='calcPoints("Yes","q1point")' />
				  <label id="label_input_4_0" for="input_4_0"> Yes </label>
				</span>
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_1" name="q1" value="No" onclick='calcPoints("No","q1point")'/>
				  <label id="label_input_4_1" for="input_4_1"> No </label>
				</span>
			  </div>
			</div>
		  </li>
		  <li class="form-line" data-type="control_radio" id="id_9">
			<label class="form-label form-label-top form-label-auto" id="label_9" for="input_9"> Does the employer have a proven RTW program? (if unsure, click “no”) <strong style="color:red;" id="q2point"><strong></label>
			<div id="cid_9" class="form-input-wide" data-layout="full">
			  <div class="form-single-column" role="group" aria-labelledby="label_9" data-component="radio">
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_9" class="form-radio" id="input_9_0" name="q2" value="Yes" onclick='calcPoints("Yes","q2point")' />
				  <label id="label_input_9_0" for="input_9_0"> Yes </label>
				</span>
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_9" class="form-radio" id="input_9_1" name="q2" value="No" onclick='calcPoints("No","q2point")'/>
				  <label id="label_input_9_1" for="input_9_1"> No </label>
				</span>
			  </div>
			</div>
		  </li>
		  <li class="form-line" data-type="control_radio" id="id_10">
			<label class="form-label form-label-top form-label-auto" id="label_10" for="input_10"> Does the employer have an accurate job description? (if unsure, click “no”) <strong style="color:red;" id="q3point"><strong></label>
			<div id="cid_10" class="form-input-wide" data-layout="full">
			  <div class="form-single-column" role="group" aria-labelledby="label_10" data-component="radio">
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_10" class="form-radio" id="input_10_0" name="q3" value="Yes" onclick='calcPoints("Yes","q3point")' />
				  <label id="label_input_10_0" for="input_10_0"> Yes </label>
				</span>
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_10" class="form-radio" id="input_10_1" name="q3" value="No" onclick='calcPoints("No","q3point")'/>
				  <label id="label_input_10_1" for="input_10_1"> No </label>
				</span>
			  </div>
			</div>
		  </li>
		  <li class="form-line" data-type="control_radio" id="id_11">
			<label class="form-label form-label-top form-label-auto" id="label_11" for="input_11"> Has the treating physician released the IW to work? <strong style="color:red;" id="q4point"><strong></label>
			<div id="cid_11" class="form-input-wide" data-layout="full">
			  <div class="form-single-column" role="group" aria-labelledby="label_11" data-component="radio">
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_11" class="form-radio" id="input_11_0" name="q4" value="Yes" onclick='calcPoints("Yes","q4point")' />
				  <label id="label_input_11_0" for="input_11_0"> Yes </label>
				</span>
				<span class="form-radio-item" style="clear:left">
				  <span class="dragger-item">
				  </span>
				  <input type="radio" aria-describedby="label_11" class="form-radio" id="input_11_1" name="q4" value="No" onclick='calcPoints("No","q4point")' />
				  <label id="label_input_11_1" for="input_11_1"> No </label>
				</span>
			  </div>
			</div>
		  </li>
		  
		  
		  <li class="form-line" data-type="control_textarea" id="id_5" style="display:none">
			<label class="form-label form-label-top form-label-auto" id="label_5" for="input_5"> Additional Comments. (e.g Reason for Decline Referral if Decline) </label>
			<div id="cid_5" class="form-input-wide" data-layout="full">
			  <textarea id="input_5" class="form-textarea" name="reason" style="width:248px;height:100px" data-component="textarea" aria-labelledby="label_5"></textarea>
			</div>
		  </li>
		  
		  
		  <li class="form-line" data-type="control_button" id="id_2">
			<div id="cid_2" class="form-input-wide" data-layout="full">
			  <div data-align="auto" class="form-buttons-wrapper form-buttons-auto   jsTest-button-wrapperField">
				<button id="decline" type="button" onclick='showStuff("id_5")' class="submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="" style="background-color:red">
				  Decline Referral
				</button>
				<button id="input_2" type="submit" class="form-submit-button submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="">
				  Submit
				</button>
			  </div>
			  
			</div>
		  </li>
			</div>
		</ul>
	  </div>
	  
	  <input name="claimant" id="claimant" type="hidden" value="<?=$_GET['claimant']?>"/>
	  <input name="claimno" id="claimno" type="hidden" value="<?=$_GET['claimno']?>"/>
	  <input name="adjuster" id="adjuster" type="hidden" value="<?=$_GET['adjuster']?>"/>
	</form></body>
	</html>
	<script src="https://cdn.jotfor.ms//js/vendor/smoothscroll.min.js?v=3.3.28851"></script>
	<script src="https://cdn.jotfor.ms//js/errorNavigation.js?v=3.3.28851"></script>
