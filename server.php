<?php
class serverProcessing {
	private $dbh;
	private $hostname = 'default';
    private $dbname= 'kelvinfactorydb';
    private $username = 'kelvinfactorydb';
    private $password = 'Kelvinfactorydb15@';
    
	public function __construct($host=null,$db=null,$user=null,$pass=null) {
        $this->hostname = (is_null($host) ? $this->hostname : $host);
        $this->dbname 	= (is_null($db)   ? $this->dbname : $db);
        $this->username = (is_null($user) ? $this->username : $user);
        $this->password = (is_null($pass) ? $this->password : $pass);
	}
	
	public function connect() { // Connect To the Database
		try
		{
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_CASE => PDO::CASE_NATURAL,
				PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
			];
			
			/* Actual connection */
			$this->dbh = new PDO('mysql:host='.$this->hostname.';dbname='.$this->dbname, $this->username, $this->password, $options);
			return true;
		}
		catch (PDOException $e)
		{
			return false;
		}
	} 
	
	public function addNewUser($firstName=null, $lastName=null, $email=null, $phoneNumber=null, $password=null, $profileid=null, $otpCode=null) {
		if($this->dbh){
			try {
				$pdoCheckIfUserExists = $this->dbh->prepare("
					SELECT COUNT(*) AS numofusers FROM `users` WHERE email='$email'
				");
				$pdoCheckIfUserExists->execute();
				$pdoCheckIfUserExistsRow = $pdoCheckIfUserExists->fetch(PDO::FETCH_ASSOC);

				if($pdoCheckIfUserExistsRow['numofusers'] > 0) {
					return [101];
				} else {
					$data = [
						'profileid' => $profileid,
						'firstName' => $firstName,
						'lastName' => $lastName,
						'email' => $email,
						'phoneNumber' => $phoneNumber,
						'password' => $password,
						'otpcode' => $otpCode,
						'confirmed' => 'no'
					];
					/* Use prepared statements for maximum security against injections */
					$pdoAddNewUsers = $this->dbh->prepare("
						INSERT INTO `users` (profileid, firstname, lastname, email, phonenumber, password, otpcode, confirmed) 
						VALUES (:profileid, :firstName, :lastName, :email, :phoneNumber, :password, :otpcode, :confirmed)
					");
					$pdoAddNewUsers->execute($data);
					return [100, $firstName, $email, $profileid, $otpCode];
				}
			}
			catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function resendOTP($firstName=null, $email=null, $profileid=null, $otpCode=null) {
		if($this->dbh){
			try {
				$pdoResendOTP = $this->dbh->prepare("
					UPDATE `users` SET otpcode='$otpCode' WHERE profileid = '$profileid' AND email = '$email'
				");
				$pdoResendOTP->execute();
				return [100, $firstName, $email, $profileid, $otpCode];
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function confirmUser($email=null, $profileid=null, $otpCode=null) {
		if($this->dbh){
			try {
				$pdoCheckIfUserIsConfirmed = $this->dbh->prepare("
					SELECT COUNT(*) AS numofusers, profileid, confirmed FROM `users` WHERE email='$email' AND profileid='$profileid'
				");
				$pdoCheckIfUserIsConfirmed->execute();
				$pdoCheckIfUserIsConfirmedRow = $pdoCheckIfUserIsConfirmed->fetch(PDO::FETCH_ASSOC);
				if($pdoCheckIfUserIsConfirmedRow['numofusers'] <= 0) {
					return [101];
				} else {
					if($pdoCheckIfUserIsConfirmedRow['confirmed'] === 'no') {
						// Check if OTP is valid
						$pdoCheckIfOtpIsValid = $this->dbh->prepare("
							SELECT COUNT(otpcode) AS otpcount FROM `users` WHERE email='$email' AND profileid='$profileid' AND otpcode='$otpCode'
						");
						$pdoCheckIfOtpIsValid->execute();
						$pdoCheckIfOtpIsValidRow = $pdoCheckIfOtpIsValid->fetch(PDO::FETCH_ASSOC);

						// Confirm User
						if($pdoCheckIfOtpIsValidRow['otpcount'] > 0) {
							$pdoConfirmUser = $this->dbh->prepare("
								UPDATE `users` SET confirmed='yes' WHERE profileid = '$profileid' AND email = '$email'
							");
							$pdoConfirmUser->execute();
							return [100, $profileid];
						} else {
							return [103];
						}
					} elseif($pdoCheckIfUserIsConfirmedRow['confirmed'] === 'yes'){
						return [104];
					}
				}
			} catch (PDOException $e) {
				return [105];
			}
		} else { 
			return [106]; 
		}
	}

	public function loginUser($email=null, $password=null) {
		if($this->dbh){
			try {
				$pdoCheckIfUserExists = $this->dbh->prepare("
					SELECT COUNT(*) AS numofusers, profileid, password FROM `users` WHERE email='$email'
				");
				$pdoCheckIfUserExists->execute();
				$pdoCheckIfUserExistsRow = $pdoCheckIfUserExists->fetch(PDO::FETCH_ASSOC);
				if($pdoCheckIfUserExistsRow['numofusers'] <= 0) {
					return [102];
				} else {
					if(password_verify($password, $pdoCheckIfUserExistsRow['password'])){
						return [100, $pdoCheckIfUserExistsRow['profileid']];
					} else {
						return [101]; 
					}
				}
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function forgetPassword($email=null) {
		if($this->dbh) {
			try {
				$pdoCheckIfUserExist = $this->dbh->prepare("
					SELECT COUNT(*) AS numofusers, firstname, email, profileid, password FROM `users` WHERE email='$email'
				");
				$pdoCheckIfUserExist->execute();
				$pdoCheckIfUserExistRow = $pdoCheckIfUserExist->fetch(PDO::FETCH_ASSOC);
				if($pdoCheckIfUserExistRow['numofusers'] > 0) {
					return [100, $pdoCheckIfUserExistRow['firstname'], $pdoCheckIfUserExistRow['email'], $pdoCheckIfUserExistRow['password']];
				} else {
					return [101];
				}
			} catch (PDOException $e) {
				return [104];
			}
		}
		else { 
			return [105]; 
		}
	}

	public function validateChangePasswordLink($email=null, $hashLink=null) {
		if($this->dbh) {
			try {
				$pdoCheckIfUserExists = $this->dbh->prepare("
					SELECT COUNT(*) AS numofusers, email, password FROM `users` WHERE email='$email'
				");
				$pdoCheckIfUserExists->execute();
				$pdoCheckIfUserExistsRow = $pdoCheckIfUserExists->fetch(PDO::FETCH_ASSOC);
				if($pdoCheckIfUserExistsRow['numofusers'] <= 0) {
					return [102];
				} else {
					if(strrev($hashLink) === $pdoCheckIfUserExistsRow['password']) {
						return [100];
					} else {
						return [101]; 
					}
				}
			} catch (PDOException $e) {
				return [104];
			}
		}
		else { 
			return [105]; 
		}
	}

	public function changePassword($email=null, $password=null) {
		if($this->dbh) {
			try {
				$pdoChangePassword = $this->dbh->prepare("
					UPDATE `users` SET password='$password' WHERE email='$email'
				");
				$pdoChangePassword->execute();
				return [100];
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function studioMembershipDetails($profileid=null, $studioMembershipId=null, $studioMembershipType=null, $studioMembershipHours=null, $studioMembershipPrice=null) {
		if($this->dbh) {
			try {
				$data = [
					'profileid' => $profileid,
					'studioMembershipId' => $studioMembershipId,
					'studioMembershipType' => $studioMembershipType,
					'studioMembershipHours' => $studioMembershipHours,
					'studioMembershipPrice' => $studioMembershipPrice
				];
				/* Use prepared statements for maximum security against injections */
				$pdoStudioMembershipDetails = $this->dbh->prepare("
					INSERT INTO `studiomembership` (profileid, membershipsessionid, membershiptype, membershipprice, membershiphours) 
					VALUES (:profileid, :studioMembershipId, :studioMembershipType, :studioMembershipPrice, :studioMembershipHours)
				");
				$pdoStudioMembershipDetails->execute($data);
				return [100];
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function studioExtraPackagesDetails($profileid=null, $studioMembershipId=null, $extraPackagesName=null, $extraPackagesPrice=null) {
		if($this->dbh) {
			try {
				$data = [
					'profileid' => $profileid,
					'studioMembershipId' => $studioMembershipId,
					'extraPackagesName' => $extraPackagesName,
					'extraPackagesPrice' => $extraPackagesPrice
				];
				/* Use prepared statements for maximum security against injections */
				$pdoStudioExtraPackagesDetails = $this->dbh->prepare("
					INSERT INTO `extrapackages` (profileid,	membershipsessionid, extrapackagesname, extrapackagesprice) 
					VALUES (:profileid, :studioMembershipId, :extraPackagesName, :extraPackagesPrice)
				");
				$pdoStudioExtraPackagesDetails->execute($data);
				return [100];
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105]; 
		}
	}

	public function bookingDateAndTimeDetails($profileid=null, $studioMembershipId=null, $bookingDate=null, $bookingStartTime=null, $bookingEndTime=null) {
		if($this->dbh) {
			try {
				$data = [
					'profileid' => $profileid,
					'studioMembershipId' => $studioMembershipId,
					'bookingDate' => $bookingDate,
					'bookingStartTime' => $bookingStartTime,
					'bookingEndTime' => $bookingEndTime
				];
				/* Use prepared statements for maximum security against injections */
				$pdoBookingDateAndTimeDetails = $this->dbh->prepare("
					INSERT INTO `bookingdateandtime` (profileid, membershipsessionid, bookingdate, bookingstarttime, bookingendtime) 
					VALUES (:profileid, :studioMembershipId, :bookingDate, :bookingStartTime, :bookingEndTime)
				");
				$pdoBookingDateAndTimeDetails->execute($data);
				return [100];
			} catch (PDOException $e) {
				return [104];
			}
		} else { 
			return [105];
		}
	} 
	
	public function fetchUserDetails($profileid=null) {
		if($this->dbh){
			try {
                $pdoFetchUser = $this->dbh->prepare("
                    SELECT profileid, firstname, lastname, email, phonenumber
                    FROM `users` WHERE profileid = '$profileid'
                ");
                $pdoFetchUser->execute();
                $pdoFetchUserRow = $pdoFetchUser->fetch(PDO::FETCH_ASSOC);
                return [100, [$pdoFetchUserRow['profileid'], $pdoFetchUserRow['firstname'], $pdoFetchUserRow['lastname'], $pdoFetchUserRow['email'], $pdoFetchUserRow['phonenumber']]];
			}
			catch (PDOException $e) {
				return [104];
			}
		}
		else { return [105]; }
	}

	public function fetchUserStudioMembershipDetails($profileid=null) {
		if($this->dbh){
			try {
				$studioMembershipArray = array();

                $pdoFetchStudioMembership = $this->dbh->prepare("
					SELECT membershipsessionid, membershiptype, membershipprice, membershiphours 
					FROM `studiomembership` WHERE profileid = '$profileid'
					GROUP BY membershipsessionid 
					ORDER BY id DESC
				");
                $pdoFetchStudioMembership->execute();
                while (is_array($pdoFetchStudioMembershipRow = $pdoFetchStudioMembership->fetch(PDO::FETCH_ASSOC))){
					$fetchedMembershipsessionid = $pdoFetchStudioMembershipRow['membershipsessionid'];

					$pdoFetchStudioMembershipArrayKey['membershipsessionid'] = $pdoFetchStudioMembershipRow['membershipsessionid'];
					$pdoFetchStudioMembershipArrayKey['membershiptype'] = $pdoFetchStudioMembershipRow['membershiptype'];
					$pdoFetchStudioMembershipArrayKey['membershipprice'] = $pdoFetchStudioMembershipRow['membershipprice'];
					$pdoFetchStudioMembershipArrayKey['membershiphours'] = $pdoFetchStudioMembershipRow['membershiphours'];
				
						// Create Booking Date and Time Array and Extra Package Array
						$bookingDateAndTimeArray = array();
						$extraPackagesArray = array();
					
						// Fetch Booking Date and Time
						$pdoFetchBookingDateAndTime = $this->dbh->prepare("
							SELECT membershipsessionid, bookingdate, bookingstarttime, bookingendtime
							FROM `bookingdateandtime` 
							WHERE membershipsessionid = '$fetchedMembershipsessionid' 
							AND profileid = '$profileid'
							ORDER BY bookingdate ASC 
						");

						$pdoFetchBookingDateAndTime->execute();
						while (is_array($pdoFetchBookingDateAndTimeRow = $pdoFetchBookingDateAndTime->fetch(PDO::FETCH_ASSOC))){
							$pdoFetchBookingDateAndTimeArrayKey['membershipsessionid'] = $pdoFetchBookingDateAndTimeRow['membershipsessionid'];	
							$pdoFetchBookingDateAndTimeArrayKey['bookingdate'] =	$pdoFetchBookingDateAndTimeRow['bookingdate'];	
							$pdoFetchBookingDateAndTimeArrayKey['bookingstarttime'] = $pdoFetchBookingDateAndTimeRow['bookingstarttime'];	
							$pdoFetchBookingDateAndTimeArrayKey['bookingendtime'] = $pdoFetchBookingDateAndTimeRow['bookingendtime'];
							
							array_push($bookingDateAndTimeArray, $pdoFetchBookingDateAndTimeArrayKey);
						} 


						// Fetch Extra Packages
						$pdoFetchExtraPackages = $this->dbh->prepare("
							SELECT membershipsessionid, extrapackagesname, extrapackagesprice
							FROM `extrapackages` 
							WHERE membershipsessionid = '$fetchedMembershipsessionid' 
							AND profileid = '$profileid'
						");

						$pdoFetchExtraPackages->execute();
						while (is_array($pdoFetchExtraPackagesRow = $pdoFetchExtraPackages->fetch(PDO::FETCH_ASSOC))){
							$pdoFetchExtraPackagesArrayKey['membershipsessionid'] = $pdoFetchExtraPackagesRow['membershipsessionid'];	
							$pdoFetchExtraPackagesArrayKey['extrapackagesname'] =	$pdoFetchExtraPackagesRow['extrapackagesname'];	
							$pdoFetchExtraPackagesArrayKey['extrapackagesprice'] = $pdoFetchExtraPackagesRow['extrapackagesprice'];	
							
							array_push($extraPackagesArray, $pdoFetchExtraPackagesArrayKey);
						}
					
					$pdoFetchStudioMembershipArrayKey['bookingDateAndTime'] = $bookingDateAndTimeArray;
					$pdoFetchStudioMembershipArrayKey['extraPackages'] = $extraPackagesArray;
					array_push($studioMembershipArray, $pdoFetchStudioMembershipArrayKey);
				}
				return [100, $studioMembershipArray];
   			}
			catch (PDOException $e) { 
				return [104];
			}
		}
		else { return [105]; }
	} 
}
	