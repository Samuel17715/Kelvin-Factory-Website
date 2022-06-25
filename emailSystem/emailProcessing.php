<?php
    require_once('phpMailerConfig.php'); 

    function sendOTPMessage($firstName=null, $email=null, $profileid=null, $otpCode=null) {
        require_once('otp-template/index.php');
        $recipientEmailAddress = array(
            array($email, $firstName)
        );
        return phpEmailMailerFunc($recipientEmailAddress, 'Enter your OTP - Kelvin Factory', $otpBody);
    }

    function sendForgetPasswordMessage($firstName=null, $email=null, $password=null) {
        $changePasswordLink = '/change-password.html?email='.$email.'&h='.strrev($password);
        require_once('forget-password-template/index.php');
        $recipientEmailAddress = array(
            array($email, $firstName)
        );
        return phpEmailMailerFunc($recipientEmailAddress, 'Reset Password - Kelvin Factory', $forgetPasswordBody);
    }

    function sendBookingDetails($email=null, $firstName=null) {
        require_once('booking-details-template/index.php');
        $recipientEmailAddress = array(
            array($email, $firstName),
            array('kelvinshotz14@gmail.com', 'Kelvin Shotz')
        );
        return phpEmailMailerFunc($recipientEmailAddress, 'Premium Membership - Kelvin Factory', $bookingDetailsBody);
    }