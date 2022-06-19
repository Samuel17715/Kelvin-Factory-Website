function bookingFormInit() {
    // Open Right Bar
    function openRightBar() {
        let windowPositionY = $('body').scrollTop();
        $('.mainBodyRightContainer').css("top", windowPositionY);
        $('.mainBodyRightContainer').toggleClass('active');
        $('.mainBodyRightDiv').addClass('animate__bounceInRight');
    }

    // Calculate Total Appointment Checkboxes Prices
    function calculateTotalAppointmentCheckboxes() {
        let totalChecboxesPrice = 0;

        $('.multiSelectOptionsDiv input:checkbox:checked').each(function() {
            totalChecboxesPrice += parseInt($(this).attr('data-value'));
        });

        return totalChecboxesPrice;
    }

    // Appointment Checkboxes
    const checkboxesValueArray = [];
    function getCheckboxesValuesFunc(thisSelector) {
        let checkboxes = $('.multiSelectOptionsDiv input:checkbox:checked').length;
        if(checkboxes === 0) {
            $('.checkBoxesButton .checkBoxesButtonText').html('Add to your appointment');
        } else {
            $('.checkBoxesButton .checkBoxesButtonText').html(checkboxes + ' items selected - <strong>$' + calculateTotalAppointmentCheckboxes() + '</strong>');
        }

        let arrayIndex = checkboxesValueArray.findIndex(e => e.name === thisSelector.val());
        if( arrayIndex === -1 ){
            checkboxesValueArray.push({"name": thisSelector.val(), "price": thisSelector.attr('data-value')});
        } else {
            checkboxesValueArray.splice(arrayIndex, 1);
        }

        return checkboxesValueArray;
    }

    // Flat Pickr
    function flatPickrInit(bookingDateTimeRowNumber, disabledSelectedDatesArray) {
        let bookingDateID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingDate'); // Booking Date
        let bookingStartTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingStartTime'); // Start Time
        let bookingEndTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingEndTime'); // End Time

        let bookingDate = flatpickr(bookingDateID, {
            minDate: "today"
        });

        let bookingStartTime = flatpickr(bookingStartTimeID, {
            enableTime: true,
            noCalendar: true,
            minuteIncrement: 30,
            dateFormat: "h:i K",
            defaultDate: "07:00 AM",
            minDate: "07:00 AM",
            maxDate: "08:00 PM"
        });

        let bookingEndTime = flatpickr(bookingEndTimeID, {
            enableTime: true,
            noCalendar: true,
            minuteIncrement: 30,
            dateFormat: "h:i K",
            defaultDate: "10:00 AM",
            minDate: "07:00 AM",
            maxDate: "11:00 PM"
        });

        // Set Min Date
        bookingStartTimeID.addEventListener('change', function (event) {
            bookingEndTime.set("minDate", bookingStartTimeID.value);
            if((moment(bookingStartTimeID.value, "hh:mm:ss A").format("X")) > (moment(bookingEndTimeID.value, "hh:mm:ss A").format("X"))) {
                bookingEndTimeID.value = bookingStartTimeID.value;
            }
        });

        // Disable Selected Dates
        if (bookingDateTimeRowNumber > 1) {
            let previousRowNumber = bookingDateTimeRowNumber - 1;
            let previousBookingDateValue = document.querySelector('.bookingDateTimeContainer[data-row-number="'+previousRowNumber+'"] .bookingDate').value;
            if (!disabledSelectedDatesArray.includes(previousBookingDateValue)) {
                disabledSelectedDatesArray.push(previousBookingDateValue);
                bookingDate.set("disable", disabledSelectedDatesArray);
            }
        }
    }


    // Append Booking Date And TIme Row
    function appendBookingDateAndTimeRow(bookingDateTimeRowNumber) {
        let appendBookingDateAndTimeHTML = `
            <div class="row mt-4 bookingDateTimeContainer active" data-row-number="${bookingDateTimeRowNumber}">       
                <div class="col-sm-6">
                    <div class="materialInputForm">
                        <label for="">Booking Date</label>
                        <input type="text" class="bookingDate" placeholder="DD/MM/YYYY">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="materialInputForm">
                        <label for="">Start Time</label>
                        <input type="date" class="bookingTime bookingStartTime" placeholder="00:00 AM">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="materialInputForm">
                        <label for="">End Time</label>
                        <input type="date" class="bookingTime bookingEndTime" placeholder="11:59 PM">
                    </div>
                </div>
            </div>
        `;
        return appendBookingDateAndTimeHTML;
    }

    // Convert Time
    function convertTime(timeStr) {
        const [time, modifier] = timeStr.split(' ');
        let [hours, minutes] = time.split(':');
        if (hours==='12'){ hours='00';}
        if (modifier==='PM'){ hours=parseInt(hours, 10) + 12;}

        let timeFraction = parseInt(hours) + (parseInt(minutes) / 60);
        return timeFraction.toFixed(1);
    }


    // Calculate Total Hours
    function getBookingDateAndTimeValuesFunc() {
        let bookingDateTimeArray = [];
        let totalBookingSumHours = 0
        for(let i=1; i<=$('.bookingDateTimeContainer[data-row-number]').length; i++){
        if(($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingDate').val() !== '') && ($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingStartTime').val() !== '') && ($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingEndTime').val() !== '')) {
                bookingDateTimeArray.push([$('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingDate').val(), $('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingStartTime').val(), $('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingEndTime').val()]);
                totalBookingSumHours += convertTime($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingEndTime').val()) - convertTime($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingStartTime').val());
            }
        }
        return {bookingDateTimeValues: bookingDateTimeArray, totalBookingHoursValues: totalBookingSumHours};
    }

    // Get booking input values
    function getBookingInputValues() {
        let bookingInputValuesObject = {
            studioMembershipValue: $('select.studioMembership').val(),
            studioMembershipHours: parseInt($('select.studioMembership').find(':selected').data('hours')),
            studioMembershipPrice: parseInt($('select.studioMembership').find(':selected').data('price')),
            studioExtraPackages: checkboxesValueArray,
            bookingDateAndTime: getBookingDateAndTimeValuesFunc().bookingDateTimeValues,
            bookingTotalHours: getBookingDateAndTimeValuesFunc().totalBookingHoursValues
        }
        
        if((bookingInputValuesObject.bookingDateAndTime.length !== 0) && (bookingInputValuesObject.studioMembershipValue !== '')) {
            return [true, bookingInputValuesObject];
        } else {
            return [false];
        }
    }

    // Calculate Unused hours
    function calculateUnusedHours() {
        if(getBookingInputValues()[0]) {
            let unusedHours = getBookingInputValues()[1].studioMembershipHours - getBookingInputValues()[1].bookingTotalHours;
            return unusedHours;
        }
    }

    function studioRentalFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice) {
        $('.studioMembershipHeaderText').html(studioMembershipValue + ' - $' + studioMembershipPrice + '/hr');

        $('.totalPriceDiv').removeClass('active');
        $('.totalPriceDiv[data-id="1"]').addClass('active');

        if(getBookingInputValues()[0]) {
            let totalPrice = (getBookingInputValues()[1].studioMembershipPrice * getBookingInputValues()[1].bookingTotalHours).toFixed(1);
            $('.totalPriceDiv[data-id="1"] .initialPrice').html(getBookingInputValues()[1].studioMembershipPrice);
            $('.totalPriceDiv[data-id="1"] .initialTime').html(getBookingInputValues()[1].bookingTotalHours);
            $('.totalPriceDiv[data-id="1"] .totalPrice').html(totalPrice);
            $('.totalPriceDiv[data-id="1"] .extraPackagesPrice').html(calculateTotalAppointmentCheckboxes());
            $('.totalPriceDiv[data-id="1"] .grandTotalPrice').html(parseInt(totalPrice) + parseInt(calculateTotalAppointmentCheckboxes()));
        }
    }

    function otherMembershipFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice) {
        $('.subButton').addClass('active');
        $("select.studioMembership option[value='Studio Rental']").attr("disabled","disabled");

        $('.studioMembershipHeaderText').html(studioMembershipValue + ' - ' + studioMembershipHours + 'hr studio time');
        // $('.initialPrice').html(getBookingInputValues()[1].studioMembershipPrice);
        // $('.initialTime').html(studioMembershipHours);
        // $('.totalPrice').html(totalPrice);

        if((calculateUnusedHours() === null) || (typeof calculateUnusedHours() === 'undefined')) {
            $('.studioMembershipTime').html('');
            $('.viewPriceDiv').removeClass('active');
            
        } else {
            $('.totalPriceDiv').removeClass('active');
            $('.totalPriceDiv[data-id="2"]').addClass('active');
            $('.totalPriceDiv[data-id="2"] .totalPrice').html(studioMembershipPrice);
            $('.totalPriceDiv[data-id="2"] .extraPackagesPrice').html(calculateTotalAppointmentCheckboxes());
            $('.totalPriceDiv[data-id="2"] .grandTotalPrice').html(parseInt(studioMembershipPrice) + parseInt(calculateTotalAppointmentCheckboxes()));
       

            if(calculateUnusedHours() === 0) {
                $('.studioMembershipTime').html('<span>'+ studioMembershipHours +' hours of ' + studioMembershipSelector.val() + ' fully scheduled</span>. Now Book Studio');
            }

            if(calculateUnusedHours() < 0) {
                $('.studioMembershipTime').html('<span>Studio Time set has passed ' + studioMembershipHours + ' hours of ' + studioMembershipSelector.val() +' </span>.<br>Please re adjust the booking Time');
            }

            if(calculateUnusedHours() > 0){
                $('.studioMembershipTime').html(studioMembershipHours  + ' hours of studio time. You can reschedule to another day<br><span>'+ calculateUnusedHours() +' hours studio time left.</span>');
            }
        }
        console.log(calculateUnusedHours());
    }


    function validateInput() {
        let studioMembershipSelector = $('select.studioMembership');
        let studioMembershipValue = studioMembershipSelector.val();
        let studioMembershipHours = parseInt(studioMembershipSelector.find(':selected').data('hours'));
        let studioMembershipPrice = parseInt(studioMembershipSelector.find(':selected').data('price'));

        // Disable All input if Studio Membership is not selected
        if(studioMembershipValue !== ''){
            $('.bookingDateTimeContainer').addClass('active');
            $('.materialInputForm input.bookingDate').removeAttr('disabled');
            $('.materialInputForm input.bookingTime').removeAttr('disabled');

            if(studioMembershipValue === 'Studio Rental'){
                studioRentalFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice);
            } else {
                otherMembershipFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice);
            }
        }
    }


    // Default Booking Row Number and Dates Array
    var bookingDateTimeRowNumber = 1;
    const disabledSelectedDatesArray = [];

    // Init Flatpickr
    flatPickrInit(bookingDateTimeRowNumber, disabledSelectedDatesArray);

    // Right Bar
    $('.mainBodyRightContainerTrigger, .mainBodyRightCloseBtn, .mainBodyRightDivCloseContainer').click(function() {
        openRightBar();
    });

    // Add to your appointment
    $('.multiSelectOptionsDiv input').change(function() {
        getCheckboxesValuesFunc($(this));
        if($('select.studioMembership').val() !== '') {
            validateInput();
        }
    });

    // Get Total Booking Price and update text
    $("body").on("change", ".materialInputForm select, .materialInputForm input", function(){
        validateInput();
    });

    // Add New Data & Time Row
    $('.subButton').on('click', function(){
        bookingDateTimeRowNumber++;
        $('.bookingDateTimeAppendContainer').append(appendBookingDateAndTimeRow(bookingDateTimeRowNumber));
        flatPickrInit(bookingDateTimeRowNumber, disabledSelectedDatesArray);
    });

    // Submit data to server
    $('.materialInputForm input[type="submit"]').on('click', function(){
        if(getBookingInputValues()[0]) {
            sessionStorage.setItem("bookingInput", JSON.stringify(getBookingInputValues()));
            if (sessionStorage.getItem("profileid") !== null) {
                window.location.href = "profile.html";
            } else {
                window.location.href = "login.html";
            }
        }
    });
}


function createAccountInit() {
    // Customer Login / Signup
    function enterOTP() {
        // Multiple Input Function for OTP and Pin
        $(document).on('keypress', '.materialMultipleInput input', function (e) {  
            let charCode = (e.which) ? e.which : event.keyCode    
            if (String.fromCharCode(charCode).match(/[^0-9]/g))    
                return false;                        
        }); 

        $(document).on('keyup', '.materialMultipleInput input', function (e) {
            if($(this).val() !== '') {
                $(this).next().focus();
            } else if($(this).val() == '') {
                $(this).prev().focus();
            }
        });

        function collectMultipleInputValues(parentSelector){
            let inputValue = '';
            for(let i=1; i<=$('.'+parentSelector+' .materialMultipleInput input[data-id]').length; i++){
                if($('.'+parentSelector+' .materialMultipleInput input[data-id="'+i+'"]').val() !== ''){
                    inputValue += $('.'+parentSelector+' .materialMultipleInput input[data-id="'+i+'"]').val();
                }
            }
            $('.'+parentSelector+' .materialMultipleInput input.inputValue').val(inputValue);
        }

        // OTP
        $(document).on('change blur keyup', '.materialOTPDiv .materialMultipleInput input', function () {
            let parentSelector = 'materialOTPDiv';
            collectMultipleInputValues(parentSelector);
        }); 
    }
    enterOTP();

    let callAjaxFunc = (formData, callback) => {
        $.ajax({
            url: "https://kelvinshotzz.com/kelvinfactory/serverProcessing.php",
            type: "POST",
            dataType: 'json',
            data: formData,
            success: callback,
            error: function(){
            }   
        });
    }

    function createAccountCallback(response) {
        switch (response[0]){
            case 100:
                otpInnerPage(response[1], response[2], response[3]);
                break;
            case 101:
                inputValidationFunc('emailAddressInput', 'User already exists. Please login <a href="login.html" style="color: #000;"><strong>here</strong></a>', 'open');
                break;
            case 104:
                console.log('Error! Please try again');
                break;
            case 105:
                console.log('Unable to connect to database');
        }
        $('.createAccountDiv input[type="submit"]').val('Create Account');
    }

    function resendOTPCallback(response) {
        switch (response[0]){
            case 100:
                inputValidationFunc('otpMessage', '<span class="success">An OTP Code has been sent again to your email</span>', 'open');
                break;
            case 104:
                console.log('Error! Please try again');
                break;
            case 105:
                console.log('Unable to connect to database');
        }
    }

    function submitOTPCallback(response) {
        switch (response[0]){
            case 100:
                sessionStorage.setItem("profileid", response[1]);
                window.location.href = "profile.html";
                break;
            case 101:
                inputValidationFunc('otpMessage', 'User does not exists', 'open');
                break;
            case 102:
                inputValidationFunc('otpMessage', '<span class="success">New OTP Sent</span>', 'open');
                break;
            case 103:
                inputValidationFunc('otpMessage', 'Incorrect OTP', 'open');
                break;
            case 104:
                console.log('Account already validated');
                break;
            case 105:
                console.log('Error! Please try again');
                break;
            case 105:
                console.log('Unable to connect to database');
        }
    }

    // Submit Create Account Function (Check input Validation for all and Submit)
    $('.createAccountDiv input[type="submit"]').click(function(event) {
        if( ( emailInputValidationCreateAccount($('.createAccountDiv .emailAddress').val())) &&
            ( firstNameInputValidationCreateAccount($('.createAccountDiv .firstName').val())) &&
            ( lastNameInputValidationCreateAccount($('.createAccountDiv .lastName').val())) &&
            ( passwordInputValidationCreateAccount($('.createAccountDiv .passwordInput').val()))
        ) {
            $(this).val('Creating Account...');
            let formData = {
                firstName: $('.createAccountDiv .firstName').val(),
                lastName: $('.createAccountDiv .lastName').val(),
                email: $('.createAccountDiv .emailAddress').val(),
                phoneNumber: $('.createAccountDiv .phoneNumber').val(),
                password: $('.createAccountDiv .passwordInput').val(),
                requestType: 'addNewUser'
            }
            callAjaxFunc(formData, createAccountCallback);
        } else {
        }
    })

    // Submit OTP Code
    $(document).on('click', '.materialOTPDiv input[type="submit"]', function () {
        let formData = {
            email: $('.materialOTPDiv .emailAddress').val(),
            profileid: $('.materialOTPDiv .profileid').val(),
            otpCode: $('.materialOTPDiv .otpCode').val(),
            requestType: 'confirmUser'
        }
        callAjaxFunc(formData, submitOTPCallback);
    });

    // Resend OTP Code
    $(document).on('click', '.materialOTPDiv .resendOTPButton', function () {
        let formData = {
            firstName: $('.materialOTPDiv .firstName').val(),
            email: $('.materialOTPDiv .emailAddress').val(),
            profileid: $('.materialOTPDiv .profileid').val(),
            otpCode: $('.materialOTPDiv .otpCode').val(),
            requestType: 'resendOTP'
        }
        callAjaxFunc(formData, resendOTPCallback);
    });
}


$(document).ready(function() {
    $('.materialNavSection .toggleButton').on('click', function(){
        $('.materialNavSection.mobile nav.dropdown').toggleClass('active');
    });
});

