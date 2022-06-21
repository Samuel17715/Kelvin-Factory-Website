<?php
    require_once('phpMailerConfig.php'); 

    function sendOTPMessage($firstName=null, $email=null, $profileid=null, $otpCode=null) {
        require_once('otp-template/index.php');
        $recipientEmailAddress = array(
            array($email, $firstName)
        );
        return phpEmailMailerFunc($recipientEmailAddress, 'Kelvin Factory OTP (One Time Password)', $otpBody);
    }

    function sendForgetPasswordMessage($firstName=null, $email=null, $password=null) {
        $changePasswordLink = '/change-password.html?email='.$email.'&h='.strrev($password);
        require_once('forget-password-template/index.php');
        $recipientEmailAddress = array(
            array($email, $firstName),
            array('kelvinshotz14@gmail.com', 'KelvinShotz')
        );
        return phpEmailMailerFunc($recipientEmailAddress, 'Reset Password - Kelvin Factory', $forgetPasswordBody);
    }