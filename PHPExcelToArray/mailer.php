	<?php

	//SCRIPT WRITTEN BY ADURAGBEMI OGUNDIJO
	//aduragbemi.ogundijo@gmail.com

		//READ EXCEL BY PHPSPREADSHEET
		include 'vendor/autoload.php';
		use PhpOffice\PhpSpreadsheet\IOFactory;
		use PhpOffice\PhpSpreadsheet\Spreadsheet;
	if(isset($_POST["q13_senderName"]) && isset($_POST["subject"]) && isset($_POST["q14_senderEmail"]) && !empty($_POST['q13_senderName']) && !empty($_POST['subject']) && !empty($_POST['q14_senderEmail']) && isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"])){

		//$filename = 'excel.xlsx';
		$filename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
		


	//TO UPLOAD THE FILES!

	$sendername = $_POST['q13_senderName'];
	$subject = $_POST['subject'];
	$from = $_POST['q14_senderEmail'];



	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



	// Check if file already exists
	if (file_exists($target_file)) {
	  $msg = "Sorry, file already exists.";
	  $uploadOk = 0;
	}


				echo '<script>';
				echo 'var msgtrue = 0;';
				echo '</script>';
				
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  $msg = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		  
		$msg = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded. ";
		
		
				echo '<script>';
				echo 'var msgtrue = 1;';
				echo '</script>';
		
			/* $reader = IOFactory::createReader('Xlsx');
		$spreadsheet = $reader->load($filename);
		$writer = IOFactory::createWriter($spreadsheet, 'Html');
		$message = $writer->save('php://output');
		print $message; */

		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file); 
		$sheet = $spreadsheet->getActiveSheet(); 
		$data = $sheet->toArray(null,true,true,true);
		$i=0;
		$array = [];
		
		//use excel spreadsheet
		foreach ($data as $val=>$s){
			if($i == 0){
				foreach($s as $label)
				$column_name[] = $label;
			}
			else
			{
				$j = count($column_name);
				$k = 0;			
				$narr = [];
				foreach($s as $label=>$a)
				{
					if($k < $j){
						array_push($narr, $a);
						$k++;
						if($j == $k - 1){
							$k = 0;
						}
					}
				}
				array_push($array, $narr);
			}
			$i++;
		}
		
		
				echo '<script>';
				echo 'var msg = ';
		$count = count($array) - 1;
		for($j = 0; $j < $count; $j++)
		{
			$ndata = array_combine($column_name, $array[$j]);
			
			$host_name = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
			
			
			$questionairelink = $host_name."/Windham/form.php?claimant=".$ndata['Claimant Name']."&claimno=".$ndata['Claim Number']."&adjuster=".$ndata['Adjuster Name'];
			
			//ACTION TO CUSTOMIZE MESSAGE FOR EACH ROW
			$message = "<html><body>";
			$message .= '<section><div><img src="'.$host_name.'/Windham/windham.png" height="60px" width="250px">
			<img src="'.$host_name.'/Windham/easternalliance.png" width="200px" height="40px" ></div><br/>

	<div><p>Dear '.$ndata['Adjuster Name'].' <br/><br/>

	Eastern Alliance Insurance Company has partnered with Windham to assist you with increasing return to work (RTW) outcomes. <br/><br/>

	The injured worker with the claim number below meets the data triggers for our questionnaire. <br/><br/>

	Click <a href="'.$questionairelink.'" target="blank">here</a> to complete the brief questionnaire.<br/><br/>
	 
	Eastern Alliance has requested that we share the response activity of this questionnaire with Management, so that we can continue to provide the most efficient service trigger possible. <br/><br/>

	The entire team at Windham looks forward to assisting you.<br/><br/>

	Injured Worker: '.$ndata['Claimant Name'].'<br/>
	Claim #: '.$ndata['Claim Number'].'<br/>
	Claim Representative: '.$ndata['Adjuster Name'].'<br/><br/>


	Thank you,<br/>
	Kristy

	</p>
	</div></section>';
	$message .= "</body></html>";

	//echo $message;
		$to= $ndata['Adjuster Email'];	
		$supervisoremail = $ndata['Supervisor Email'];




	$message = rawurlencode($message);
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: $sendername<".strip_tags($from).">\r\n";
	$headers .= "Cc: ".strip_tags($supervisoremail)."\r\n";
	$headers .= "X-Priority: 1\r\n";




	if (mail($to, $subject, rawurldecode($message), $headers))
	{
		$msg = 'eMailed to <strong style="color:green;">'.$to."</strong> & CC: ".$supervisoremail."<br/>";
		echo "'" . $msg . "'+";
	}
		   
		   
	else
			   {
			$msg = 'Mail ERROR! NOT sent to  <strong style="color:red;">'.$to."</strong><br/>";
			echo "'" . $msg . "'+";
		   }
			

			
			//$final_data[$j] = $ndata;
		}
		
		
		
		//END OF PHPSPREADSHEET
		
		
		

	//delete the uploaded file
	unlink($target_file);
		
		
	  } else {
		echo "Sorry, there was an error uploading your file.";
		
	  }
	  
	  
				echo '"";</script>';
	}

	}


	?>



	<!-- Credits to JotForm-->
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html class="supernova"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="alternate" type="application/json+oembed" href="https://www.jotform.com/oembed/?format=json&amp;url=https%3A%2F%2Fform.jotform.com%2Fmailer" title="oEmbed Form">
	<link rel="alternate" type="text/xml+oembed" href="https://www.jotform.com/oembed/?format=xml&amp;url=https%3A%2F%2Fform.jotform.com%2Fmailer" title="oEmbed Form">
	<meta name="slack-app-id" content="AHNMASS8M">
	<link rel="shortcut icon" href="#">
	<link rel="canonical" href="#" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />
	<meta name="HandheldFriendly" content="true" />
	<title>Windham Group Automailer</title>
	<style type="text/css">@media print{.form-section{display:inline!important}.form-pagebreak{display:none!important}.form-section-closed{height:auto!important}.page-section{position:initial!important}}</style>
	<link type="text/css" rel="stylesheet" href="https://cdn01.jotfor.ms/themes/CSS/5e6b428acc8c4e222d1beb91.css?themeRevisionID=5f7ed99c2c2c7240ba580251"/>
	<link type="text/css" rel="stylesheet" href="https://cdn02.jotfor.ms/css/styles/payment/payment_styles.css?3.3.28871" />
	<link type="text/css" rel="stylesheet" href="https://cdn03.jotfor.ms/css/styles/payment/payment_feature.css?3.3.28871" />
	<style type="text/css" id="form-designer-style">
	input[type="file"] {
		display: none;
	}
	.custom-file-upload {
		border: 1px solid #ccc;
		display: inline-block;
		padding: 6px 12px;
		cursor: pointer;
		}
		
		
		
		/* Injected CSS Code */
	/*PREFERENCES STYLE*/
		.form-all {
		  font-family: Inter, sans-serif;
		}
		.form-all .qq-upload-button,
		.form-all .form-submit-button,
		.form-all .form-submit-reset,
		.form-all .form-submit-print {
		  font-family: Inter, sans-serif;
		}
		.form-all .form-pagebreak-back-container,
		.form-all .form-pagebreak-next-container {
		  font-family: Inter, sans-serif;
		}
		.form-header-group {
		  font-family: Inter, sans-serif;
		}
		.form-label {
		  font-family: Inter, sans-serif;
		}
	  
		.form-label.form-label-auto {
		  
		display: block;
		float: none;
		text-align: left;
		width: 100%;
	  
		}
	  
		.form-line {
		  margin-top: 12px 36px 12px 36px px;
		  margin-bottom: 12px 36px 12px 36px px;
		}
	  
		.form-all {
		  max-width: 752px;
		  width: 100%;
		}
	  
		.form-label.form-label-left,
		.form-label.form-label-right,
		.form-label.form-label-left.form-label-auto,
		.form-label.form-label-right.form-label-auto {
		  width: 230px;
		}
	  
		.form-all {
		  font-size: 16px
		}
		.form-all .qq-upload-button,
		.form-all .qq-upload-button,
		.form-all .form-submit-button,
		.form-all .form-submit-reset,
		.form-all .form-submit-print {
		  font-size: 16px
		}
		.form-all .form-pagebreak-back-container,
		.form-all .form-pagebreak-next-container {
		  font-size: 16px
		}
	  
		.supernova .form-all, .form-all {
		  background-color: #fff;
		}
	  
		.form-all {
		  color: #2C3345;
		}
		.form-header-group .form-header {
		  color: #2C3345;
		}
		.form-header-group .form-subHeader {
		  color: #2C3345;
		}
		.form-label-top,
		.form-label-left,
		.form-label-right,
		.form-html,
		.form-checkbox-item label,
		.form-radio-item label {
		  color: #2C3345;
		}
		.form-sub-label {
		  color: #464d5f;
		}
	  
		.supernova {
		  background-color: #ecedf3;
		}
		.supernova body {
		  background: transparent;
		}
	  
		.form-textbox,
		.form-textarea,
		.form-dropdown,
		.form-radio-other-input,
		.form-checkbox-other-input,
		.form-captcha input,
		.form-spinner input {
		  background-color: #fff;
		}
	  
		.supernova {
		  background-image: none;
		}
		#stage {
		  background-image: none;
		}
	  
		.form-all {
		  background-image: none;
		}
	  
		.form-all {
		  position: relative;
		}
		.form-all:before {
		  content: "";
		  background-image: url("https://media-exp1.licdn.com/dms/image/C561BAQEubvMdVuzrxw/company-background_10000/0/1631732288123?e=1636084800&v=beta&t=wTm6k4YzYOfOcXWymgZIfNFm9SfLnt5bvg5dtOpz2BA");
		  display: inline-block;
		  height: 100px;
		  position: absolute;
		  background-size: 400px 100px;
		  background-repeat: no-repeat;
		  width: 100%;
		}
		.form-all {
		  margin-top: 120px !important;
		}
		.form-all:before {
		  top: -110px;
		  left: 0;
		  background-position: top left;
		}
			   
	  .ie-8 .form-all:before { display: none; }
	  .ie-8 {
		margin-top: auto;
		margin-top: initial;
	  }
	  
	  /*PREFERENCES STYLE*//*__INSPECT_SEPERATOR__*/
		/* Injected CSS Code */
	</style>

	<script src="https://cdn01.jotfor.ms/static/prototype.forms.js" type="text/javascript"></script>
	<script src="https://cdn02.jotfor.ms/static/jotform.forms.js?3.3.28871" type="text/javascript"></script>
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/punycode/1.4.1/punycode.js"></script>
	<script src="https://cdn03.jotfor.ms/js/vendor/imageinfo.js?v=3.3.28871" type="text/javascript"></script>
	<script src="https://cdn01.jotfor.ms/file-uploader/fileuploader.js?v=3.3.28871"></script>
	<script type="text/javascript">	JotForm.newDefaultTheme = true;
		JotForm.extendsNewTheme = false;
		JotForm.newPaymentUIForNewCreatedForms = false;
		JotForm.newPaymentUI = true;

		JotForm.init(function(){
		/*INIT-START*/
	if (window.JotForm && JotForm.accessible) $('input_13').setAttribute('tabindex',0);
	if (window.JotForm && JotForm.accessible) $('input_16').setAttribute('tabindex',0);
		  JotForm.setCustomHint( 'input_16', 'Type here...' );
		  setTimeout(function() {
			  JotForm.initMultipleUploads();
		  }, 2);
		/*INIT-END*/
		});

	   JotForm.prepareCalculationsOnTheFly([null,{"name":"rtwMailer","qid":"1","text":"RTW Mailer","type":"control_head"},{"name":"sendMessage","qid":"2","text":"Send Message","type":"control_button"},null,null,null,null,null,null,null,null,null,null,{"description":"","name":"senderName","qid":"13","subLabel":"Your name as you want it displayed!","text":"Sender Name","type":"control_textbox"},{"description":"","name":"senderEmail","qid":"14","subLabel":"e.g jlovett@windhamgroup.com","text":"Sender Email","type":"control_email"},{"description":"","name":"uploadExcelfile","qid":"15","subLabel":"Make sure it follows same format as in this example","text":"Upload ExcelFile","type":"control_fileupload"},{"description":"","name":"messagePreview","qid":"16","subLabel":"Click here to see what the message will look like","text":"Message Preview","type":"control_textarea"}]);
	   setTimeout(function() {
	JotForm.paymentExtrasOnTheFly([null,{"name":"rtwMailer","qid":"1","text":"RTW Mailer","type":"control_head"},{"name":"sendMessage","qid":"2","text":"Send Message","type":"control_button"},null,null,null,null,null,null,null,null,null,null,{"description":"","name":"senderName","qid":"13","subLabel":"Your name as you want it displayed!","text":"Sender Name","type":"control_textbox"},{"description":"","name":"senderEmail","qid":"14","subLabel":"e.g jlovett@windhamgroup.com","text":"Sender Email","type":"control_email"},{"description":"","name":"uploadExcelfile","qid":"15","subLabel":"Make sure it follows same format as in this example","text":"Upload ExcelFile","type":"control_fileupload"},{"description":"","name":"messagePreview","qid":"16","subLabel":"Click here to see what the message will look like","text":"Message Preview","type":"control_textarea"}]);}, 20); 


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
		else
		document.getElementById("msg").innerHTML = msg;	
	}

	function hidemessage() {	
		document.getElementById("msg").innerHTML = '';
	}

	</script>
	</head>
	<body onload="displaymessage()">
	<form id="sendform" class="jotform-form" action="" method="post" enctype="multipart/form-data" name="form_mailer" id="mailer" accept-charset="utf-8" autocomplete="on">
	  <input type="hidden" name="formID" value="mailer" />
	  <input type="hidden" id="JWTContainer" value="" />
	  <input type="hidden" id="cardinalOrderNumber" value="" />
	  <div role="main" class="form-all">
		<div class="formLogoWrapper Left">
		  <img loading="lazy" class="formLogoImg" src="windham.png" height="100" width="400" onload="displaymessage(msg,ok)">
		</div>
		<style>
		  .formLogoWrapper { display:inline-block; position: absolute; width: 100%;} .form-all:before { background: none !important;} .formLogoWrapper.Left { top: -110px; left: 0; text-align: left;}
		</style>
		<ul class="form-section page-section">
	   <!--   <li id="cid_1" class="form-input-wide" data-type="control_head">
			<div class="form-header-group  header-large">
			  <div class="header-text httal htvam">
				<h1 id="header_1" class="form-header" data-component="header">
				  RTW Mailer
				</h1>
				<div id="subHeader_1" class="form-subHeader">
				  Windham Group Automailer
				</div>
			  </div>
			</div>
		  </li>-->
		  <p id="msg"  >
				  
				</p>
		  <li class="form-line" data-type="control_textbox" id="id_13">
			<label class="form-label form-label-top form-label-auto" id="label_13" for="input_13"> Sender Name </label>
			<div id="cid_13" class="form-input-wide" data-layout="half">
			  <span class="form-sub-label-container" style="vertical-align:top">
				<input type="text" id="input_13" name="q13_senderName" data-type="input-textbox" class="form-textbox" data-defaultvalue="" style="width:310px" size="310" value="<?php if(isset($_POST['q13_senderName'])){ echo $_POST['q13_senderName'];}?>" data-component="textbox" aria-labelledby="label_13 sublabel_input_13" required="required"/>
				<label class="form-sub-label" for="input_13" id="sublabel_input_13" style="min-height:13px" aria-hidden="false"> Your name as you want it displayed! </label>
			  </span>
			</div>
		  </li>
		  <li class="form-line" data-type="control_email" id="id_14">
			<label class="form-label form-label-top form-label-auto" id="label_14" for="input_14"> Sender Email </label>
			<div id="cid_14" class="form-input-wide" data-layout="half">
			  <span class="form-sub-label-container" style="vertical-align:top">
				<input type="email" id="input_14" name="q14_senderEmail" class="form-textbox validate[Email]" data-defaultvalue="" style="width:310px" size="310" value="<?php if(isset($_POST['q14_senderEmail'])){ echo $_POST['q14_senderEmail'];}?>" data-component="email" aria-labelledby="label_14 sublabel_input_14" required="required" />
				<label class="form-sub-label" for="input_14" id="sublabel_input_14" style="min-height:13px" aria-hidden="false"> e.g jlovett@windhamgroup.com </label>
			  </span>
			</div>
		  </li>
		  
		  
			<li class="form-line" data-type="control_textbox" id="id_subject">
			<label class="form-label form-label-top form-label-auto" id="label_subject" for="input_subject"> Subject </label>
			<div id="cid_subject" class="form-input-wide" data-layout="half">
			  <span class="form-sub-label-container" style="vertical-align:top">
				<input type="text" id="input_subject" name="subject" data-type="input-textbox" class="form-textbox" data-defaultvalue="" style="width:310px" size="310" value="<?php if(isset($_POST['subject'])){ echo $_POST['subject'];}?>" data-component="textbox" aria-labelledby="label_13 sublabel_input_13" required="required"/>
				<label class="form-sub-label" for="input_subject" id="sublabel_input_subject" style="min-height:13px" aria-hidden="false"> Enter Subject of the Email Message</label>
			  </span>
			</div>
		  </li>
		  

		  <li class="form-line" data-type="control_fileupload" id="id_15">
			<label class="form-label form-label-top form-label-auto" id="label_15" for="input_15"> Upload Excel File </label>
			<div id="cid_15" class="form-input-wide" data-layout="full">
			  <div class="jfQuestion-fields" data-wrapper-react="true">
				<div class="jfField isFilled">
				  
				  
				  <label for="file-upload" class="custom-file-upload">
		<i class="fa fa-cloud-upload"></i> Excel File Upload
	</label>
	<input id="file-upload" type="file" name="fileToUpload" required="required"/>


				  <span class="form-sub-label-container" style="vertical-align:top">
					<label class="form-sub-label" for="input_15" id="sublabel_input_15" style="min-height:13px" aria-hidden="false"> Make sure it follows same format as in this <a href="excel.xlsx" target="_blank">example</a> </label>
				  </span>
				</div>
			
			  </div>
			</div>
		  </li>
		  <li class="form-line" data-type="control_textarea" id="id_16" style="display:none">
			<label class="form-label form-label-top form-label-auto" id="label_16" for="input_16"> Message Preview </label>
			<div id="cid_16" class="form-input-wide" data-layout="full">
			  <span class="form-sub-label-container" style="vertical-align:top">
				<textarea id="input_16" class="form-textarea" name="q16_messagePreview" style="width:648px;height:163px" data-component="textarea" aria-labelledby="label_16 sublabel_input_16"></textarea>
				<label class="form-sub-label" for="input_16" id="sublabel_input_16" style="min-height:13px" aria-hidden="false"> Click here to see what the message will look like </label>
			  </span>
			</div>
		  </li>
		  <li class="form-line" data-type="control_button" id="id_2">
			<div id="cid_2" class="form-input-wide" data-layout="full">
			  <div data-align="auto" class="form-buttons-wrapper form-buttons-auto   jsTest-button-wrapperField">
			  
			  <button id="preview" type="submit" class="form-submit-button submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="" >
				  Send Message
				</button>
				
				
				<button id="input_2" type="submit" class="form-submit-button submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="" style="display:none">
				  Send Message
				</button>
			  </div>
			  
			</div>
		  </li>
		  <li style="display:none">
			Should be Empty:
			<input type="text" name="website" value="" />
		  </li>
		</ul>
	  </div>

	  
	</form></body>
	</html>
	<script src="https://cdn.jotfor.ms//js/vendor/smoothscroll.min.js?v=3.3.28871"></script>
	<script src="https://cdn.jotfor.ms//js/errorNavigation.js?v=3.3.28871"></script>
