<?
class Contact_Form
{
	// Visible Fields and settings
	public $lang       = 'he';
	public $company = false;
	public $fullname   = true;
	public $email      = true;
	public $phone      = true;
	public $cell       = false;
	public $fax        = false;
	public $address    = false;
	public $city       = false;
	public $code       = false;
	public $subject    = true;
	public $content    = true;
	public $captcha	   = true;
	public $btn1 	   = true;
	public $newsletter = 'off';
	public $form_email;
	public $form_site_name   = 'Contact Form';
	public $form_email_first = 'info';
	public $form_to          = 'israel@best-com.co.il';
	public $form_require1 = 'שדה חובה';
	public $form_require2 = '';
	public $form_require3 = 'קוד שגוי.';
	public $error = array();
	public $validated = false;
	public $successMessage='';
	public $successPage = '';
	
	//checkboxes
	public $cb1 = false;
	public $cb2 = false;
	public $cb3 = false;
	public $cb4 = false;
	public $cb5 = false;
	// require Fields
	public $r_company    = false;
	public $r_fullname   = true;
	public $r_email      = true;
	public $r_phone      = false;
	public $r_cell       = false;
	public $r_fax        = false;
	public $r_address    = false;
	public $r_city       = false;
	public $r_code       = false;
	public $r_subject    = false;
	public $r_content    = false;
	public $r_cb1 		 = false;
	public $r_cb2 		 = false;
	public $r_cb3		 = false;
	public $r_cb4 		 = false;
	public $r_cb5 		 = false;
	
	
	public function SendForm($lang="he") {

		global $database;
		$this->lang = $lang;
		$this->localize();

		if (isset($_POST['send'])) {
			$company    = $database->mysql_prep($_POST['company']);
			$name       = $database->mysql_prep($_POST['fullname']);
			$email      = $database->mysql_prep($_POST['email']);
			$phone      = $database->mysql_prep($_POST['phone']);
			$cell       = $database->mysql_prep($_POST['cell']);
			$fax        = $database->mysql_prep($_POST['fax']);
			$address    = $database->mysql_prep($_POST['address']);
			$city       = $database->mysql_prep($_POST['city']);
			$code       = $database->mysql_prep($_POST['code']);
			$subject    = $database->mysql_prep($_POST['subject']);
			$content    = $database->mysql_prep($_POST['content']);
			$captcha    = $database->mysql_prep($_POST['captcha']);
			//checkboxes
			$cb1_quan = $database->mysql_prep($_POST['cb1_quan']);
			$cb2_quan = $database->mysql_prep($_POST['cb2_quan']);
			$cb3_quan = $database->mysql_prep($_POST['cb3_quan']);
			$cb4_quan = $database->mysql_prep($_POST['cb4_quan']);
			$cb5_quan = $database->mysql_prep($_POST['cb5_quan']);
			
				
			if ($this->r_fullname == true && $name != $this->form_require1 && $name!='') { 
				$v1 = true;
			} elseif (($this->r_fullname == true && $name=='') || $name == $this->form_require1) {
				$v1 = false;
				$this->error[1] = $this->form_require1;
				unset($_POST['fullname']);
			} else {
				$v1 = true;
			}
			
			if ($this->r_content == true && $content != $this->form_require1 && $content!='') { 
				$v2 = true;  
			} elseif (($this->r_content == true && $content=='') || $content == $this->form_require1) {
				$v2 = false;
				$this->error[2] = $this->form_require1;
				unset($_POST['content']);
			} else {
				$v2 = true;
			}
			
			if ($this->r_phone == true && $phone != $this->form_require1 && $phone!='') { 
				$v3 = true;  
			} elseif (($this->r_phone == true && $phone=='') || $phone == $this->form_require1) {
				$v3 = false;
				$this->error[3] = $this->form_require1;
				unset($_POST['phone']);	
			} else {
				$v3 = true;
			}
			
			if ($this->r_cell == true && $cell != $this->form_require1 && $cell!='') { 
				$v4 = true;  
			} elseif (($this->r_cell == true && $cell!='') || $cell == $this->form_require1) {
				$v4 = false;	
				$this->error[4] = $this->form_require1;
				unset($_POST['cell']);
			} else {
				$v4 = true;
			}
			
			if ($this->r_fax == true && $fax != $this->form_require1) { 
				$v5 = true;  
			} elseif ($this->r_fax == true && $fax == $this->form_require1) {
				$v5 = false;	
				$this->error[5] = $this->form_require1;
				unset($_POST['fax']);
			} else {
				$v5 = true;
			}
			
			if ($this->r_address == true && $address != $this->form_require1) { 
				$v6 = true;  
			} elseif ($this->r_address == true && $address == $this->form_require1) {
				$v6 = false;
				$this->error[6] = $this->form_require1;
				unset($_POST['address']);	
			} else {
				$v6 = true;
			}
			
			if ($this->r_city == true && $city != $this->form_require1) { 
				$v7 = true;  
			} elseif ($this->r_city == true && $city == $this->form_require1) {
				$v7 = false;	
				$this->error[7] = $this->form_require1;
				unset($_POST['city']);
			} else {
				$v7 = true;
			}
			
			if ($this->r_code == true && $code != $this->form_require1) { 
				$v8 = true;  
			} elseif ($this->r_code == true && $code == $this->form_require1) {
				$v8 = false;
				$this->error[8] = $this->form_require1;
				unset($_POST['code']);	
			} else {
				$v8 = true;
			}
			
			if ($this->r_subject == true && $subject != $this->form_require1 && $subject!='') { 
				$v9 = true;  
			} elseif (($this->r_subject == true && $subject=='') || $subject == $this->form_require1) {
				$v9 = false;
				$this->error[9]= $this->form_require1;
				unset($_POST['subject']);
			} else {
				$v9 = true;
			}
			
			if ($this->r_company == true && $company != $this->form_require1 && $subject!='') { 
				$v9 = true;  
			} elseif (($this->r_company == true && $subject=='') || $company == $this->form_require1) {
				$v10 = false;
				$this->error[10]= $this->form_require1;
				unset($_POST['company']);
			} else {
				$v10 = true;
			}
			
			if ($this->captcha == true && $captcha == $_SESSION['security_code'] && $captcha != '') { 
				$v11 = true;  
			} elseif ($this->captcha == true && $captcha != $_SESSION['security_code']) {
				$v11 = false;
				$this->error[11]= $this->form_require3;
				unset($_POST['captcha']);
			} else {
				$v11 = true;
			}
			
			if ($this->EmailValidation($email) == FALSE) {
				$this->error[12] = $this->form_require2;
				$_POST['email'] = "";		
			}	


			if ($this->EmailValidation($email) == TRUE && $v1 == true && $v2 == true && $v3 == true && $v4 == true && $v5 == true && $v6 == true && $v7 == true && $v8 == true && $v9 == true && $v10 == true && $v11 == true) {
				if ($this->newsletter=='on')
					$database->query("INSERT INTO newsletter (id,name,email) VALUES (NULL,'$name','$email')");								
				else{
					$header       = 'MIME-Version: 1.0' . "\r\n";
					$header      .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
					$header      .= $this->form_site_name;
					$header      .= "From:".$this->form_email_first."@$http \r\n";
					$mail_subject = $this->form_email_first.$this->form_site_name;
					
					if ($this->lang == 'he') {
						if (!empty($company)) { $body.="{$this->company_text}: $company \r\n\r\n"; }
						if (!empty($name))    { $body.="{$this->fullname_text}: $name \r\n\r\n"; }
						if (!empty($phone))   { $body.="{$this->phone_text}: $phone \r\n\r\n"; }
						if (!empty($cell))    { $body.="{$this->cell_text}: $cell \r\n\r\n"; }
						if (!empty($fax))     { $body.="{$this->fax_text}: $fax \r\n\r\n"; }
						if (!empty($city))    { $body.="{$this->city_text}: $city \r\n\r\n"; }
						if (!empty($address)) { $body.="{$this->address_text}: $address \r\n\r\n"; }
						if (!empty($code))    { $body.="{$this->code_text}: $code \r\n\r\n"; }
						if (!empty($email))   { $body.="{$this->email_text}: $email \r\n\r\n";}
						if (!empty($subject)) { $body.="{$this->subject_text}: $subject \r\n\r\n"; }
						if (!empty($content)) { $body.="{$this->content_text}: $content"; }
						if (!empty($cb1_quan)){ $body.="{$this->cb1_text}: $cb1_quan \r\n\r\n"; }
						if (!empty($cb2_quan)){ $body.="{$this->cb2_text}: $cb2_quan \r\n\r\n"; }
						if (!empty($cb3_quan)){ $body.="{$this->cb3_text}: $cb3_quan \r\n\r\n"; }
						if (!empty($cb4_quan)){ $body.="{$this->cb4_text}: $cb4_quan \r\n\r\n"; }
						if (!empty($cb5_quan)){ $body.="{$this->cb5_text}: $cb5_quan \r\n\r\n"; }
					} else {
						if (!empty($company)) { $body.="{$this->company_text}: $company \r\n\r\n"; }
						if (!empty($name))    { $body.="{$this->fullname_text}: $name \r\n\r\n"; }
						if (!empty($phone))   { $body.="{$this->phone_text}: $phone \r\n\r\n"; }
						if (!empty($cell))    { $body.="{$this->cell_text}: $cell \r\n\r\n"; }
						if (!empty($fax))     { $body.="{$this->fax_text}: $fax \r\n\r\n"; }
						if (!empty($city))    { $body.="{$this->city_text}: $city \r\n\r\n"; }
						if (!empty($address)) { $body.="{$this->address_text}: $address \r\n\r\n"; }
						if (!empty($code))    { $body.="{$this->code_text}: $code \r\n\r\n"; }
						if (!empty($email))   { $body.="{$this->email_text}: $email \r\n\r\n";}
						if (!empty($subject)) { $body.="{$this->subject_text}: $subject \r\n\r\n"; }
						if (!empty($content)) { $body.="{$this->content_text}: $content"; }
						if (!empty($cb1_quan)){ $body.="{$this->cb1_text}: $cb1_quan \r\n\r\n"; }
						if (!empty($cb2_quan)){ $body.="{$this->cb2_text}: $cb2_quan \r\n\r\n"; }
						if (!empty($cb3_quan)){ $body.="{$this->cb3_text}: $cb3_quan \r\n\r\n"; }
						if (!empty($cb4_quan)){ $body.="{$this->cb4_text}: $cb4_quan \r\n\r\n"; }
						if (!empty($cb5_quan)){ $body.="{$this->cb5_text}: $cb5_quan \r\n\r\n"; }
					}
						mail($this->form_to, $subject, $body, $header);
				}	
					$this->validated = true;

						
				unset($_POST);
				unset($this->error);
				
				if (!empty($this->successPage)) {		
					header("location:".$this->successPage);
							
				}

			} 
		}	
		
		
	}
	
	
	private function EmailValidation($email) {
		
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
			$email_validation = TRUE;
		} else {
			$email_validation = FALSE;
		}
		return $email_validation;
	}
	
	private function localize(){
	
		if ($this->lang == 'he') {
			if (empty($this->company_text))  {	$this->company_text            = 'שם החברה'; 		 }
			if (empty($this->fullname_text)) {  $this->fullname_text           = 'שם מלא';  }
			if (empty($this->phone_text))	 {	$this->phone_text              = 'טלפון';			 }
			if (empty($this->email_text)) 	 {	$this->email_text              = 'דוא"ל';	 	 }
			if (empty($this->cell_text)) 	 {	$this->cell_text               = 'טלפון נייד';		 }
			if (empty($this->fax_text)) 	 {	$this->fax_text                = 'פקס';	 			 }
			if (empty($this->address_text))  {	$this->address_text            = 'כתובת';			 }
			if (empty($this->city_text)) 	 {	$this->city_text               = 'עיר';	 			 }
			if (empty($this->code_text)) 	 {	$this->code_text               = 'מיקוד';			 }
			if (empty($this->subject_text))  {	$this->subject_text            = 'נושא הפניה';		 }
			if (empty($this->content_text))  {	$this->content_text            = 'תוכן הפניה';		 }
			if (empty($this->captcha_text))  {	$this->captcha_text            = 'הזן קוד אימות';    }
			if (empty($this->cb1_text))		 {	$this->cb1_text				   = 'ברצוני לקבל לדוא"ל הנ"ל מידע שיווקי מהמרכז הישראלי לשחיה'; }
			if (empty($this->cb2_text)) 	 {	$this->cb2_text				   = 'חבילת קופסאות קטנות בכמות של'; }
			if (empty($this->cb3_text)) 	 {	$this->cb3_text				   = 'גליל נייר דבק בכמות של';		 }
			if (empty($this->cb4_text)) 	 {	$this->cb4_text				   = 'גליל נייר בועות בכמות של';	 }		
			if (empty($this->cb5_text)) 	 {	$this->cb5_text				   = 'דבק חם בכמות של';				 }
			if (empty($this->form_require1)) {	$this->form_require1		   = 'שדה חובה';					 }
			if (empty($this->form_require2)) {	$this->form_require2		   = 'ערך לא חוקי, אנא הזן שוב'; 	 }
			if (empty($this->successMessage)) {
				$this->successMessage		   = 'פרטיך נקלטו בהצלחה, אחד מנציגנו יצור איתך קשר בהקדם. המשך גלישה נעימה.';
			}
		} else {
			if (empty($this->company_text))  {	$this->company_text            = 'Company name'; }
			if (empty($this->fullname_text)) {  $this->fullname_text           = 'Full Name'; }
			if (empty($this->phone_text))	 {	$this->phone_text              = 'Phone';	 }
			if (empty($this->email_text)) 	 {	$this->email_text              = 'Email';	 }
			if (empty($this->cell_text)) 	 {	$this->cell_text               = 'Mobile';	 }
			if (empty($this->fax_text)) 	 {	$this->fax_text                = 'Fax';	 	 }
			if (empty($this->address_text))  {	$this->address_text            = 'Address';	 }
			if (empty($this->city_text)) 	 {	$this->city_text               = 'City';	 }
			if (empty($this->code_text)) 	 {	$this->code_text               = 'Code';	 }
			if (empty($this->subject_text))  {	$this->subject_text            = 'Subject';	 }
			if (empty($this->content_text))  {	$this->content_text            = 'Body'; 	 }
			if (empty($this->captcha_text))  {	$this->captcha_text            = 'Security Code'; }
			if (empty($this->cb1_text))		 {	$this->cb1_text				   = 'ברצוני לקבל לדוא"ל הנ"ל מידע שיווקי מהמרכז הישראלי לשחיה'; }
			if (empty($this->cb2_text)) 	 {	$this->cb2_text				   = 'חבילת קופסאות קטנות בכמות של'; }
			if (empty($this->cb3_text)) 	 {	$this->cb3_text				   = 'גליל נייר דבק בכמות של'; 		 }
			if (empty($this->cb4_text)) 	 {	$this->cb4_text				   = 'גליל נייר בועות בכמות של';	 } 			
			if (empty($this->cb5_text)) 	 {	$this->cb5_text				   = 'דבק חם בכמות של'; 			 }
			if (empty($this->form_require1)) {	$this->form_require1		   = 'Required field';				 }
			if (empty($this->form_require2)) {	$this->form_require2		   = 'Input isnt valid'; 			 }
			if (empty($this->successMessage)) {			
				$this->successMessage		   = 'Thank you very much for your email. We will contact you shortly.';
			}
		}
	}
	
	
	public function LoadForm($bottom_text='',$dir='') {
	?>
    <form action="" method="post" class="CONTACT_FORM">
    <?
	if ($this->validated == true && !empty($this->successMessage)) {
		
		echo '<span class="OUTPUT">'.$this->successMessage."</span>";
		
	}
	if (!$this->validated){
		?>
		<table>
			<?
			if ($this->company == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->company_text?><? if ($this->r_company == true) { ?><span style="color:RED">*</span> <? } ?></td>
			</tr>
			<tr>
				<td><input type="text" name="company" value="<?=$this->error[10]?><?=$_POST['company']?>" <? if (!empty($this->error[10])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->company_text?><? if ($this->r_company == true) { ?><span style="color:RED">*</span> <? } ?></td>
				<td><input type="text" name="company" value="<?=$this->error[10]?><?=$_POST['company']?>" <? if (!empty($this->error[10])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->fullname == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><? if ($this->r_fullname == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->fullname_text?></td>
			</tr>
			<tr>
				<td><input type="text" name="fullname" value="<?=$this->error[1]?><?=$_POST['fullname']?>" <? if (!empty($this->error[1])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?				
				} else {
			?>
			<tr>
				<td valign="top"><? if ($this->r_fullname == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->fullname_text?></td>
				<td><input type="text" name="fullname" value="<?=$this->error[1]?><?=$_POST['fullname']?>" <? if (!empty($this->error[1])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->phone == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><? if ($this->r_phone == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->phone_text?></td>
			</tr>
			<tr>
				<td><input type="text" name="phone" value="<?=$this->error[3]?><?=$_POST['phone']?>" <? if (!empty($this->error[3])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><? if ($this->r_phone == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->phone_text?></td>
				<td><input type="text" name="phone" value="<?=$this->error[3]?><?=$_POST['phone']?>" <? if (!empty($this->error[3])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->email == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><? if ($this->r_email == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->email_text?></td>
			</tr>
			<tr>
				<td><input type="text" name="email" value="<?=$this->error[12]?><?=$_POST['email']?>" <? if (!empty($this->error[12])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><? if ($this->r_email == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->email_text?></td>
				<td><input type="text" name="email" value="<?=$this->error[12]?><?=$_POST['email']?>" <? if (!empty($this->error[12])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->cell == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->cell_text?><? if ($this->r_cell == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><input type="text" name="cell" value="<?=$this->error[4]?><?=$_POST['cell']?>" <? if (!empty($this->error[4])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->cell_text?><? if ($this->r_cell == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="cell" value="<?=$this->error[4]?><?=$_POST['cell']?>" <? if (!empty($this->error[4])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->fax == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->fax_text?><? if ($this->r_fax == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><input type="text" name="fax" value="<?=$this->error[5]?><?=$_POST['fax']?>" <? if (!empty($this->error[5])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->fax_text?><? if ($this->r_fax == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="fax" value="<?=$this->error[5]?><?=$_POST['fax']?>" <? if (!empty($this->error[5])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->address == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->address_text?><? if ($this->r_address == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><input type="text" name="address" value="<?=$this->error[6]?><?=$_POST['address']?>" <? if (!empty($this->error[6])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->address_text?><? if ($this->r_address == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="address" value="<?=$this->error[6]?><?=$_POST['address']?>" <? if (!empty($this->error[6])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->city == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->city_text?><? if ($this->r_city == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><input type="text" name="city" value="<?=$this->error[7]?><?=$_POST['city']?>" <? if (!empty($this->error[7])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->city_text?><? if ($this->r_city == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="city" value="<?=$this->error[7]?><?=$_POST['city']?>" <? if (!empty($this->error[7])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->code == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->code_text?><? if ($this->r_code == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><input type="text" name="code" value="<?=$this->error[8]?><?=$_POST['code']?>" <? if (!empty($this->error[8])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->code_text?><? if ($this->r_code == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="code" value="<?=$this->error[8]?><?=$_POST['code']?>" <? if (!empty($this->error[8])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->subject == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><? if ($this->r_subject == true) { ?><span style="color:RED">*</span> <? } ?><?=$this->subject_text?> </td>
			</tr>
			<tr>
				<td><input type="text" name="subject" value="<?=$this->error[9]?><?=$_POST['subject']?>" <? if (!empty($this->error[9])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->subject_text?><? if ($this->r_subject == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><input type="text" name="subject" value="<?=$this->error[9]?><?=$_POST['subject']?>" <? if (!empty($this->error[9])) { ?> class="ERROR" <? } ?>></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->content == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><?=$this->content_text?><? if ($this->r_content == true) { ?><span style="color:RED">*</span> <? } ?> </td>
			</tr>
			<tr>
				<td><textarea name="content" <? if (!empty($this->error[2])) { ?> class="ERROR" <? } ?>><?=$this->error[2]?><?=$_POST['content']?></textarea></td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td valign="top"><?=$this->content_text?><? if ($this->r_content == true) { ?><span style="color:RED">*</span> <? } ?> </td>
				<td><textarea name="content" <? if (!empty($this->error[2])) { ?> class="ERROR" <? } ?>><?=$this->error[2]?><?=$_POST['content']?></textarea></td>
			</tr>
			<?
				}
			}
			?>
			<?
			if ($this->captcha == true) {
				if($dir == 'vertical') {
			?>
			<tr>
				<td valign="top"><span style="color:RED">* </span><?=$this->captcha_text?></td>
			</tr>
			<tr>
				<td>
				<img src="CaptchaSecurityImages.php" />
				<input id="captcha" name="captcha" type="text" value="<?=$this->error[11]?><?=$_POST['captcha']?>" <? if (!empty($this->error[11])) { ?> class="ERROR" <? } ?>><br>
				</td>
			</tr>
			<?		
				} else {
			?>
			<tr>
				<td></td>
				<td><img src="includes/CaptchaSecurityImages.php"></td>
			</tr>
			<tr>
				<td valign="top"><span style="color:RED">* </span><?=$this->captcha_text?></td>
				<td>            
				<input id="captcha" name="captcha" type="text" value="<?=$this->error[11]?><?=$_POST['captcha']?>" <? if (!empty($this->error[11])) { ?> class="ERROR" <? } ?>><br>
				</td>
			</tr>
			<?
				}
			}
			?>
			</table>
			<?
			if ($bottom_text != ''){
			?>
				<div id='bottom_text'><?='*'.$bottom_text?></div>
			<?
			}
			?>
			<!--checkboxes-->
			<table>
			<?
				if ($this->cb1 == true) {
				?>
				<tr>
					<td valign="top"><? if ($this->r_cb1 == true) { ?><span style="color:RED">*</span> <? } ?><input type='checkbox'></td>
					<td valign="top"><?=$this->cb1_text?></td>
				</tr>
			<? } ?>
			<?
				if ($this->cb2 == true) {
				?>
				<tr>
					<td><? if ($this->r_cb2 == true) { ?><span style="color:RED">*</span> <? } ?><input type='checkbox'><?=$this->cb2_text?></td>
					<td><input type='text' class='CB_INPUTS' name="cb2_quan" value="<?=$_POST['cb2_quan']?>"></td>
				</tr>
			<? } ?>
				<?
				if ($this->cb3 == true) {
				?>
				<tr>
					<td valign="top"><? if ($this->r_cb3 == true) { ?><span style="color:RED">*</span> <? } ?><input type='checkbox'><?=$this->cb3_text?></td>
					<td valign="top"><input type='text' class='CB_INPUTS' name="cb3_quan" value="<?=$_POST['cb3_quan']?>"></td>
				</tr>
			<? } ?>
				<?
				if ($this->cb4 == true) {
				?>
				<tr>
					<td valign="top"><? if ($this->r_cb4 == true) { ?><span style="color:RED">*</span> <? } ?><input type='checkbox'><?=$this->cb4_text?></td>
					<td valign="top"><input type='text' class='CB_INPUTS' name="cb4_quan" value="<?=$_POST['cb4_quan']?>"></td>
				</tr>
			<? } ?>
				<?
				if ($this->cb5 == true) {
				?>
				<tr>
					<td valign="top"><? if ($this->r_cb5 == true) { ?><span style="color:RED">*</span> <? } ?><input type='checkbox'><?=$this->cb5_text?></td>
					<td valign="top"><input type='text' class='CB_INPUTS' name="cb5_quan" value="<?=$_POST['cb5_quan']?>"></td>
				</tr>
			<? } ?>
			</table>
			<!--end of checkboxes-->
			<div id="submit_form" <? if ($this->lang == 'en') { echo 'style="text-align:right; clear:both;"'; } else { echo 'style="text-align:left; clear:both;"'; } ?>>
			<?	if ($this->btn1 == true) { ?>
				<button type="reset"><img src="/images/clear.png" alt=""></button>
			<? } ?>
				<button type="submit" name="send"><img src="/images/send.png" alt=""></button>		
			</div>
		 </form>
		<?
		}
	}
}
?>