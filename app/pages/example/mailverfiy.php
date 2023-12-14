<?php
#
#  _   _ _____ ____ _____ _____  _____ ____ 
# | \ | | ____|  _ \_   _/ _ \ \/ /_ _/ ___|
# |  \| |  _| | |_) || || | | \  / | | |    
# | |\  | |___|  _ < | || |_| /  \ | | |___ 
# |_| \_|_____|_| \_\|_| \___/_/\_\___\____|
#
#

$currPage = 'back_mailverify';
require HANDLER_PATH.'nicPageHandler.php';

if($mailcode == NULL) {
    if($usermail_verified == 'false') {
        $generatedCode = $auth->saveVerifyCode($userid);
        $mailer->sendMail($usermail, 'Mail Verification Code', 'Your verification code is: '.$generatedCode);
    }
}

if(isset($_POST['checkCode'])) {

    $checkCode = $base->verifyString($mailcode, $_POST['mailCode']);

    if($checkCode == true) {
        $auth->verifyMail($usermail);
    } else {
        $console->callError(false, 'mailVerify.php', 'The Mail Verification Code u entered wasnt right.');
    }

}
?>


<h1> Mail Verification needed </h1>
<br>
<small>We've sended a code to your E-Mail, please enter this code here.</small>
<br><br>

<form method="POST">
<input name="mailCode" placeholder="E-Mail Code"></input>
<br>
<button name="checkCode" type="Submit"> Check Code </button>
</form>