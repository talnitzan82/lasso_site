<?php
if($_POST)
{
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    } 
    
    $to_Email       = "tal@dreamax.co.il"; //Replace with recipient email address
    $subject        = 'פניה חדשה מלאסו!.'; //Subject line for emails
    
    //check $_POST vars are set, exit if any missing
    if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userPhone"]) || !isset($_POST["userMessage"]))
    {
        die();
    }

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $user_Phone       = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
    $user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
	
	$body         = 'שם מלא:'.  $user_Name."\r\n"; 
	$body        .= 'דואל:'. $user_Email ."\r\n"; 
	$body        .= 'טלפון:'. $user_Phone ."\r\n"; 
	$body        .= 'הודעה:'. $user_Message."\r\n";  
    
    //additional php validation
    if(mb_strlen($user_Name)<4) // If length is less than 4 it will throw an HTTP error.
    {
        header('HTTP/1.1 500 השם קצר מידי , לפחות 4 תווים');
        exit();
    }
    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
    {
        header('HTTP/1.1 500 אנא הזינו כתובת אימייל תקינה!');
        exit();
    }
    if(!is_numeric($user_Phone)) //check entered data is numbers
    {
        header('HTTP/1.1 500 אנא הכניסו ספרות בלבד במספר הטלפון.');
        exit();
    }
    if(strlen($user_Message)<5) //check emtpy message
    {
        header('HTTP/1.1 500 ההודעה קצרה מידי, לפחות 5 תווים.');
        exit();
    }
    
    //proceed with PHP email.
	$headers       = 'MIME-Version: 1.0' . "\r\n";
	$headers      .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $headers 	  .= 'From: '.$user_Email.'' . "\r\n";
    $headers 	  .= 'Reply-To: '.$user_Email.'' . "rn";
    $headers 	  .= 'X-Mailer: PHP/' . phpversion();
    
    @$sentMail = mail($to_Email, $subject, $body, $headers);
    
    if(!$sentMail)
    {
        header('HTTP/1.1 500 Couldnot send mail! Sorry..');
        exit();
    }else{
        echo 'תודה '.$user_Name .', על פנייתכם. ';
        echo 'האימייל שלכם נשלח בהצלחה, נציגינו יחזרו אליכם בקרוב.';
    }
}
?>