/****************** Sign Out **************/
function signOut() {
    sessionStorage.removeItem("profileid");
    window.location.href = "login.html";
}

/************* Get File Directory ************/
function getFileName() {
    let url = window.location.pathname;
    let filename = url.substring(url.lastIndexOf('/')+1);
    return filename;
}

/************* Profile Session ID ***********/
function profileSessionIDFunc() {
    let sessionProfileId = "";

    if((sessionStorage.getItem("profileid") !== null) && (typeof sessionStorage.getItem("profileid") !== undefined)) {
        sessionProfileId = sessionStorage.getItem("profileid");
    }

    if(getFileName() === "profile.html") {
        if(sessionProfileId === ""){
            window.location.href = "login.html";
        }
    }
    return sessionProfileId;
}



/************ Booking Form  ***************/
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


        // Create New FlatPickr Instances for Date & Time
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

        
        // Clean Disabled Dates Array and add New Dates
        disabledSelectedDatesArray.splice(0, disabledSelectedDatesArray.length);
        $('.bookingDateTimeContainer[data-row-number] .bookingDate').each(function() {
            if ((!disabledSelectedDatesArray.includes($(this).val())) && ($(this).val() !== "")) {
                disabledSelectedDatesArray.push($(this).val());
            }
        });
        bookingDate.set("disable", disabledSelectedDatesArray);

        // Set Min Date
        bookingStartTimeID.addEventListener('change', function (event) {
            bookingEndTime.set("minDate", bookingStartTimeID.value);
            if((moment(bookingStartTimeID.value, "hh:mm:ss A").format("X")) > (moment(bookingEndTimeID.value, "hh:mm:ss A").format("X"))) {
                bookingEndTimeID.value = bookingStartTimeID.value;
            }
        });
    }

    // Delete Row
    function deletebookingDateTimeContainer(bookingDateTimeRowNumber) {
        // Destroy FlatPickr Instances
        let bookingDateID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingDate'); // Booking Date
        let bookingStartTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingStartTime'); // Start Time
        let bookingEndTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingEndTime'); // End Time

        flatpickr(bookingDateID).destroy();
        flatpickr(bookingStartTimeID).destroy();
        flatpickr(bookingEndTimeID).destroy();

        $('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"').remove();
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
            <div class="col-sm-6 bookingDateTimeDiv">
                <div class="materialInputForm">
                    <label for="">Start Time</label>
                    <input type="text" class="bookingTime bookingStartTime" placeholder="00:00 AM">
                </div>
                <div class="materialInputForm">
                    <label for="">End Time</label>
                    <input type="text" class="bookingTime bookingEndTime" placeholder="11:59 PM">
                </div>
                <div class="pt-4 deleteBookingDateAndTime">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4.5" y="5.09985" width="15" height="18" rx="1.5"  /><rect x="2.25" y="2.09985" width="19.5" height="3" rx="0.75"   stroke-linejoin="round"/><path d="M9 0.900146L15 0.900146"   stroke-linecap="round"/><path d="M12 9V19.5"   stroke-linecap="round"/><path d="M15.75 9V19.5"   stroke-linecap="round"/><path d="M8.25 9V19.5"   stroke-linecap="round"/></svg>
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
        $('.bookingDateTimeContainer[data-row-number]').each(function() {
            let rowNumber = $(this).attr('data-row-number');
            if(($('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingDate').val() !== '') && ($('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingStartTime').val() !== '') && ($('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingEndTime').val() !== '')) {
                bookingDateTimeArray.push([$('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingDate').val(), $('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingStartTime').val(), $('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingEndTime').val()]);
                totalBookingSumHours += convertTime($('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingEndTime').val()) - convertTime($('.bookingDateTimeContainer[data-row-number="'+rowNumber+'"] .bookingStartTime').val());
            }
        });
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

    // Studio Rental Function
    function studioRentalFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice) {
        // Delete Other Row
        $('.bookingDateTimeContainer[data-row-number]').each(function() {
            let bookingDateTimeRowNumber = $(this).attr('data-row-number');
            if(bookingDateTimeRowNumber !== "1") {
                deletebookingDateTimeContainer(bookingDateTimeRowNumber);
            }
        });
        $('.subButton').removeClass('active');
        
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

    // Membership Functions
    function otherMembershipFunctions(studioMembershipSelector, studioMembershipValue, studioMembershipHours, studioMembershipPrice) {
        $('.subButton').addClass('active');

        $('.studioMembershipHeaderText').html(studioMembershipValue);
        $('.studioMembershipTimeDiv p.studioMembershipTime').html(studioMembershipHours + ' total hours of studio time. ');
        if((calculateUnusedHours() === null) || (typeof calculateUnusedHours() === 'undefined')) {
            $('.viewPriceDiv').removeClass('active');
        } else {
            $('.totalPriceDiv').removeClass('active');
            $('.totalPriceDiv[data-id="2"]').addClass('active');
            $('.totalPriceDiv[data-id="2"] .totalTime').html(studioMembershipHours);
            $('.totalPriceDiv[data-id="2"] .totalPrice').html(studioMembershipPrice);
            $('.totalPriceDiv[data-id="2"] .extraPackagesPrice').html(calculateTotalAppointmentCheckboxes());
            $('.totalPriceDiv[data-id="2"] .grandTotalPrice').html(parseInt(studioMembershipPrice) + parseInt(calculateTotalAppointmentCheckboxes()));
       

            if(calculateUnusedHours() === 0) {
                $('.studioMembershipTimeDiv p.studioMembershipTimeLeft').html('<span class="green">' + studioMembershipHours + ' fully scheduled. Now book studio</span>');
                $('.materialBookingForm input[type="submit"]').attr("disabled", false);
            }

            if(calculateUnusedHours() < 0) {
                $('.studioMembershipTimeDiv p.studioMembershipTimeLeft').html('<span class="orange">Studio time you set has exceeded ' + studioMembershipHours + ' hours. Re-adjust the booking Time</span>');
                $('.materialBookingForm input[type="submit"]').attr("disabled", true);
            }

            if(calculateUnusedHours() > 0){
                $('.studioMembershipTimeDiv p.studioMembershipTimeLeft').html(calculateUnusedHours() + ' hours studio time unset.');
                $('.materialBookingForm input[type="submit"]').attr("disabled", false);
            }

            console.log(calculateUnusedHours());
        }
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
    $('.subButton').on('click', function() {
        bookingDateTimeRowNumber++;
        $('.bookingDateTimeAppendContainer').append(appendBookingDateAndTimeRow(bookingDateTimeRowNumber));
        flatPickrInit(bookingDateTimeRowNumber, disabledSelectedDatesArray);
    });

    // Delete Row
    $(document).on('click', '.deleteBookingDateAndTime', function(){
        let bookingDateTimeRowNumber = $(this).closest('div.bookingDateTimeContainer').attr('data-row-number');
        deletebookingDateTimeContainer(bookingDateTimeRowNumber);
        validateInput();
    });

    // Submit data to server
    $('.materialInputForm input[type="submit"]').on('click', function(){
        if(getBookingInputValues()[0]) {
            sessionStorage.setItem("bookingInput", JSON.stringify(getBookingInputValues()));
            window.location.href = "profile.html";
        }
    });
}


/************ Append Main Navigation ***************/
function addMainNav() {
    let btnDesktopHTML = '';
    let btnMobileHTML = '';

    if(profileSessionIDFunc() !== "") {
        btnDesktopHTML = '<li><a class="materialButton" href="javascript: void(0)" onClick="signOut()">Sign Out</a></li>';  
        btnMobileHTML = '<li><a class="materialButton" href="profile.html">My Bookings</a></li>';  
    } else {
        btnDesktopHTML = '<li><a class="materialButton" href="login.html">Log In</a></li>';
        btnMobileHTML = '<li><a class="materialButton" href="login.html">Log In</a></li>'
    }

    let mainNavHTMLContent = `
        <section class="materialNavSection">
            <nav class="flex-between">
                <div>
                    <a href="index.html">
                        <img src="assets/img/kelvin-factory-logo-2.png" alt="">
                    </a>
                </div>
                <div>
                    <ul>
                        <li><a class="active" href="profile.html">My Bookings</a></li>
                        <li><a class="" href="#">About</a></li>
                        <li><a class="" href="#">Contact</a></li>
                        <li><a target="_blank" class="" href="https://kelvinshotzz.com">Book Shoots</a></li>
                    </ul>    
                </div>
                <div>
                    <ul>
                        ${btnDesktopHTML}
                    </ul>
                </div>
            </nav>
        </section>

        <section class="materialNavSection mobile">
            <nav class="flex-between">
                <div>
                    <a href="index.html">
                        <img src="assets/img/kelvin-factory-logo-2.png" alt="">
                    </a>
                </div>
                <div>
                    <ul>
                        ${btnMobileHTML}
                        <li class="toggleButton">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 12H22.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.5 21H22.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.5 3H22.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </li>
                    </ul>
                </div>
            </nav>

            <nav class="dropdown">
                <div>
                    <ul class="flex-column">
                        <li><a class="" href="#">About</a></li>
                        <li><a class="" href="#">Contact</a></li>
                        <li><a target="_blank" class="" href="https://kelvinshotzz.com">Book Shoots</a></li>
                        <li><a class="" href="javascript: void(0)" onClick="signOut()">Sign Out</a></li>
                    </ul>    
                </div>
            </nav>
        </section>
    `;

    $('.mainNavHTMLContentDiv').html(mainNavHTMLContent);
}


/*********** Submit Data to Server ********/
const callAjaxFunc = (formData, callback) => {
    $.ajax({
        //url: "https://kelvinshotzz.com/kelvinfactory/serverProcessing.php",
        //url: "serverProcessing.php",
        url: "http://localhost/Kelvin-Factory-Website/serverProcessing.php",
        type: "POST",
        dataType: 'json',
        data: formData,
        success: callback,
        error: function(){
        }   
    });
}


$(document).ready(function() {
    // Session ID
    profileSessionIDFunc();

    // Add Main Nav
    addMainNav();

    // Toggle Mobile Navigation 
    $(document).on('click', '.materialNavSection .toggleButton', function(){
        $('.materialNavSection.mobile nav.dropdown').toggleClass('active');
    });
});

