<?php	
    header("Access-Control-Allow-Origin: *");
    require_once ('db.php');
    require_once ('emailSystem/emailProcessing.php');

    $requestType = $_REQUEST['requestType'];
    
    // User Registration
    if($requestType === 'addNewUser') {
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $email = $_REQUEST['email'];
        $phoneNumber = $_REQUEST['phoneNumber'];
        $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $profileid = rand(10000000,99999999); // 8 Digits
        $otpCode = rand(100000,999999); // 6 Digits

        $addNewUser = $pdo->addNewUser($firstName, $lastName, $email, $phoneNumber, $password, $profileid, $otpCode);
        if($addNewUser[0] === 100) {
            if(sendOTPMessage($addNewUser[1], $addNewUser[2], $addNewUser[3], $addNewUser[4])[0]){
                array_pop($addNewUser);
                return print_r(json_encode($addNewUser)); 
            }
        } else {
            return print_r(json_encode($addNewUser)); 
        }
    }


    if($requestType === 'resendOTP') {
        $firstName = $_REQUEST['firstName'];
        $email = $_REQUEST['email'];
        $profileid = $_REQUEST['profileid'];
        $otpCode = rand(100000,999999);
        $resendOTP = $pdo->resendOTP($firstName, $email, $profileid, $otpCode);
        if($resendOTP[0] === 100) {
            if(sendOTPMessage($resendOTP[1], $resendOTP[2], $resendOTP[3], $resendOTP[4])[0]){
                array_pop($resendOTP);
                return print_r(json_encode($resendOTP)); 
            }
        } else {
            return print_r(json_encode($resendOTP)); 
        }
    }

    if($requestType === 'confirmUser') {
        $email = $_REQUEST['email'];
        $profileid = $_REQUEST['profileid'];
        $otpCode = $_REQUEST['otpCode'];
        //$otpState = $_REQUEST['otpState'];
        $confirmUser = $pdo->confirmUser($email, $profileid, $otpCode);
        return print_r(json_encode($confirmUser));
    }

    if($requestType === 'loginUser') {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $loginUser = $pdo->loginUser($email, $password);
        return print_r(json_encode($loginUser));
    }

    if($requestType === 'forgetPassword') {
        $email = $_REQUEST['email'];
        $forgetPassword = $pdo->forgetPassword($email);
        if($forgetPassword[0] === 100){
            if(sendForgetPasswordMessage($forgetPassword[1], $forgetPassword[2], $forgetPassword[3])[0]){
                return print_r(json_encode([100]));
            }
        } else {
            return print_r(json_encode($forgetPassword));
        }
    }

    if($requestType === 'validateChangePasswordLink') {
        $email = $_REQUEST['email'];
        $hashLink = $_REQUEST['linkParams'];
        $validateChangePasswordLink = $pdo->validateChangePasswordLink($email, $hashLink);
        return print_r(json_encode($validateChangePasswordLink));
    }

    if($requestType === 'changePassword') {
        $email = $_REQUEST['email'];
        $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $changePassword = $pdo->changePassword($email, $password);
        return print_r(json_encode($changePassword));
    }


    // Save Studio Membership
    if($requestType === 'saveBookingDetails') {
        try {
            $profileid = $_REQUEST['profileid'];
            $studioMembershipId = rand(100000000,999999999);
            $studioMembershipType = $_REQUEST['bookingInput'][1]['studioMembershipValue'];
            $studioMembershipHours = $_REQUEST['bookingInput'][1]['studioMembershipHours'];
            $studioMembershipPrice = $_REQUEST['bookingInput'][1]['studioMembershipPrice'];
            $saveStudioMembershipDetails = $pdo->studioMembershipDetails($profileid, $studioMembershipId, $studioMembershipType, $studioMembershipHours, $studioMembershipPrice);
           
            $studioExtraPackages = $_REQUEST['bookingInput'][1]['studioExtraPackages'];
            foreach ($studioExtraPackages as $value)  {
                $saveStudioExtraPackagesDetails = $pdo->studioExtraPackagesDetails($profileid, $studioMembershipId, $value['name'], $value['price']);
            } 
    
            $bookingDateAndTime = $_REQUEST['bookingInput'][1]['bookingDateAndTime'];
            foreach ($bookingDateAndTime as $value)  {
                $saveBookingDateAndTimeDetails = $pdo->bookingDateAndTimeDetails($profileid, $studioMembershipId, $value[0], $value[1], $value[2]);
            }

            $fetchUserDetailsEmail = $pdo->fetchUserDetails($profileid);

            $bookingEmailArray = [
                'email' => $fetchUserDetailsEmail[1][3],
                'profileid' => $fetchUserDetailsEmail[1][1],
                'fullName' => $fetchUserDetailsEmail[1][1].' '.$fetchUserDetailsEmail[1][2],
                'phoneNumber' => $fetchUserDetailsEmail[1][4],
                'studioMembershipType' => $studioMembershipType,
                'studioMembershipHours' => $studioMembershipHours,
                'studioMembershipPrice' => $studioMembershipPrice,
                'bookingDateAndTime' => $bookingDateAndTime,
                'extraPackages' => $studioExtraPackages
            ];
            // return print_r(json_encode($bookingEmailArray ));
            if(sendBookingDetails($bookingEmailArray)){
                return print_r(json_encode([100]));
            }        
        }
        catch (exception $e) {
            //code to handle the exception
            return print_r(json_encode($e->getMessage()));
        }
    }
   
    // Get User Details
    if($requestType === 'fetchUserDetails') {
        $profileid = $_REQUEST['profileid'];
        $fetchUserDetails = $pdo->fetchUserDetails($profileid);
        return print_r(json_encode($fetchUserDetails));
    }

    // Fetch User Studio Membership
    if($requestType === 'fetchUserStudioMembership') {
        $profileid = $_REQUEST['profileid'];
        $fetchUserStudioMembershipDetails = $pdo->fetchUserStudioMembershipDetails($profileid);
        return print_r(json_encode($fetchUserStudioMembershipDetails));
    }