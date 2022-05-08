    // Form Input Validation Messages
    const formInputValidationMessages = {
        createAccount: {
            emailAddress: ['Email Address is required', 'Invalid Email Address'],
            firstName: ['First Name is required', 'First Name is too short'],
            lastName: ['Last Name is required', 'Last Name is too short'],
            password: ['Set your password', 'Minimum length of 6 characters', 'It must contain at least one number, and a special character']
        },
        login: {
            emailAddress: ['Email Address is required', 'Invalid Email Address'],
            password: ['Please enter your password', 'Incorrect Password']
        },
        forgotPassword: {
            emailAddress: ['Please enter your email', 'Invalid Email Address']
        },
        changePassword: {
            password: ['Please enter your new password', 'Password does not match']
        }
    }

    // Email Input Regex
    function validateEmailAddress(inputValue) {
        const emailValidRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (inputValue.match(emailValidRegex)) {
            return true;
        } else {
            return false;
        }
    }

    // Input Error Messages Function
    function inputValidationFunc(selector, responseMessage, responseState) {
        if (responseState === 'open') {
            if($('.'+ selector + ' .inputFieldInfo').css('display') !== 'block') {
                $('.'+ selector + ' .inputFieldInfo').fadeIn(300);
            }
            $('.'+ selector + ' .inputFieldInfo span').html(responseMessage);
        }
        if (responseState === 'close') {
            $('.'+ selector + ' .inputFieldInfo').fadeOut(300);
        }
    }

    // Email Input Validation (Create Account)
    function emailInputValidationCreateAccount(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('emailAddressInput', formInputValidationMessages.createAccount.emailAddress[0], 'open');
            return false;
        } else {
            if(!validateEmailAddress(inputValue.toLowerCase())) {
                inputValidationFunc('emailAddressInput', formInputValidationMessages.createAccount.emailAddress[1], 'open');
                return false;
            } else {
                inputValidationFunc('emailAddressInput', '', 'close');
                return true;
            }
        }
    }

    $('.createAccountDiv .emailAddress').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        emailInputValidationCreateAccount(inputValue);
    });

    // FIrst Name Input Validation  (Create Account)
    function firstNameInputValidationCreateAccount(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('firstNameInput', formInputValidationMessages.createAccount.firstName[0], 'open');
            return false;
        } else {
            if(inputValue.length < 3){
                inputValidationFunc('firstNameInput', formInputValidationMessages.createAccount.firstName[1], 'open');
                return false;
            } else {
                inputValidationFunc('firstNameInput', '', 'close');
                return true;
            }
        }
    }

    $('.createAccountDiv .firstName').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        firstNameInputValidationCreateAccount(inputValue);
    });

    // Last Name Input Validation  (Create Account)
    function lastNameInputValidationCreateAccount(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('lastNameInput', formInputValidationMessages.createAccount.lastName[0], 'open');
            return false;
        } else {
            if(inputValue.length < 3){
                inputValidationFunc('lastNameInput', formInputValidationMessages.createAccount.lastName[1], 'open');
                return false;
            } else {
                inputValidationFunc('lastNameInput', '', 'close');
                return true;
            }
        }
    }

    $('.createAccountDiv .lastName').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        lastNameInputValidationCreateAccount(inputValue);
    });

    // Password Input Validation  (Create Account)
    function passwordInputValidationCreateAccount(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('passwordInputDiv', formInputValidationMessages.createAccount.password[0], 'open');
            return false;
        } else {
            if(inputValue.length < 6){
                inputValidationFunc('passwordInputDiv', formInputValidationMessages.createAccount.password[1], 'open');
                return false;
            } else {
                if(!/^(?=.*[0-9])(?=.*[!@#$%^&*_~.-])[a-zA-Z0-9!@#$%^&*_~.-]{6,36}$/.test(inputValue)) {
                    inputValidationFunc('passwordInputDiv', formInputValidationMessages.createAccount.password[2], 'open');
                    return false;
                } else {
                    inputValidationFunc('passwordInputDiv', '', 'close');
                    return true;
                }
            }
        }
    }

    $('.createAccountDiv .passwordInput').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        passwordInputValidationCreateAccount(inputValue)
    });


    // Email Input Validation (Login)
    function emailInputValidationLogin(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('emailAddressInput', formInputValidationMessages.login.emailAddress[0], 'open');
            return false;
        } else {
            if(!validateEmailAddress(inputValue.toLowerCase())) {
                inputValidationFunc('emailAddressInput', formInputValidationMessages.login.emailAddress[1], 'open');
                return false;
            } else {
                inputValidationFunc('emailAddressInput', '', 'close');
                return true;
            }
        }
    }

    $('.loginDiv .emailAddress').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        emailInputValidationLogin(inputValue);
    });



    // Password Input Validation (Login)
    function passwordInputValidationLogin(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('passwordInputDiv', formInputValidationMessages.login.password[0], 'open');
            return false;
        } else {
            inputValidationFunc('passwordInputDiv', '', 'close');
            return true;
        }
    }

    $('.loginDiv .passwordInput').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        passwordInputValidationLogin(inputValue);
    });



    // Forgot Password Validation (Forgot Password)
    function forgotPasswordInputValidationLogin(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('emailAddressInput', formInputValidationMessages.forgotPassword.emailAddress[0], 'open');
            return false;
        } else {
            if(!validateEmailAddress(inputValue.toLowerCase())) {
                inputValidationFunc('emailAddressInput', formInputValidationMessages.forgotPassword.emailAddress[1], 'open');
                return false;
            } else {
                inputValidationFunc('emailAddressInput', '', 'close');
                return true;
            }
        }
    }
    
    $('.forgotPasswordDiv .emailAddress').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        forgotPasswordInputValidationLogin(inputValue)
    });



    // Change Password Input Validation (Change Password)
    function changePasswordInputValidationLogin(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('changePasswordInputDiv', formInputValidationMessages.createAccount.password[0], 'open');
            return false;
        } else {
            if(inputValue.length < 6){
                inputValidationFunc('changePasswordInputDiv', formInputValidationMessages.createAccount.password[1], 'open');
                return false;
            } else {
                if(!/^(?=.*[0-9])(?=.*[!@#$%^&*_~.-])[a-zA-Z0-9!@#$%^&*_~.-]{6,36}$/.test(inputValue)) {
                    inputValidationFunc('changePasswordInputDiv', formInputValidationMessages.createAccount.password[2], 'open');
                    return false;
                } else {
                    inputValidationFunc('changePasswordInputDiv', '', 'close');
                    return true;
                }
            }
        }
    }

    $('.changePasswordInputDiv .passwordInput').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        changePasswordInputValidationLogin(inputValue);
    });



    // Change Password Input Validation (Confirm Password)
    function confirmPasswordInputValidationLogin(inputValue) {
        if(inputValue === ""){
            inputValidationFunc('confirmPasswordInputDiv', formInputValidationMessages.changePassword.password[0], 'open');
            return false;
        } else {
            if(inputValue !== $('.changePasswordInputDiv .passwordInput').val()) {
                inputValidationFunc('confirmPasswordInputDiv', formInputValidationMessages.changePassword.password[1], 'open');
                return false;
            } else {
                inputValidationFunc('confirmPasswordInputDiv', '', 'close');
                return true;
            }
        }
    }

    $('.confirmPasswordInputDiv .passwordInput').on( "keyup blur change", function() {
        let inputValue = $(this).val();
        confirmPasswordInputValidationLogin(inputValue);
    });


    
    // Password Reveal
    $('.materialFormGroupInput .showHideBtn.showPassword').click(function(event) {
        event.preventDefault();
        $('.loginFormDivContainer .passwordInput').attr('type', 'text');
        $('.materialFormGroupInput .showHideBtn').removeClass('active');
        $('.materialFormGroupInput .showHideBtn.hidePassword').addClass('active');
    });

    $('.materialFormGroupInput .showHideBtn.hidePassword').click(function(){
        $('.loginFormDivContainer .passwordInput').attr('type', 'password');
        $('.materialFormGroupInput .showHideBtn').removeClass('active');
        $('.materialFormGroupInput .showHideBtn.showPassword').addClass('active');
    });