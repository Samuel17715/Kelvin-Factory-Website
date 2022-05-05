$(document).ready(function() {
    // Right Bar
    $('.mainBodyRightContainerTrigger, .mainBodyRightCloseBtn, .mainBodyRightDivCloseContainer').click(function(){
        let windowPositionY = $('body').scrollTop();
        $('.mainBodyRightContainer').css("top", windowPositionY);
        $('.mainBodyRightContainer').toggleClass('active');
        $('.mainBodyRightDiv').addClass('animate__bounceInRight');
    });


    // Appointment Checkboxes
    const checkboxesValueArray = [];
    function getCheckboxesValuesFunc(thisSelector) {
        let checkboxes = $('.multiSelectOptionsDiv input:checkbox:checked').length;
        if(checkboxes === 0) {
            $('.checkBoxesButton .checkBoxesButtonText').html('Add to your appointment');
        } else {
            $('.checkBoxesButton .checkBoxesButtonText').html(checkboxes + ' items selected');
        }

        let arrayIndex = checkboxesValueArray.findIndex(e => e.name === thisSelector.val());
        if( arrayIndex === -1 ){
            checkboxesValueArray.push({"name": thisSelector.val(), "price": thisSelector.attr('data-value')});
        } else {
            checkboxesValueArray.splice(arrayIndex, 1);
        }
        return checkboxesValueArray;
    }


    // Flat Pickr (Date & Time) Configuration
    function flatPickrInit(bookingDateTimeRowNumber) {
        let bookingDateID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingDate'); // Booking Date
        let bookingStartTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingStartTime'); // Start Time
        let bookingEndTimeID = document.querySelector('.bookingDateTimeContainer[data-row-number="'+bookingDateTimeRowNumber+'"] .bookingEndTime'); // End Time
        
        let bookingDate= flatpickr(bookingDateID, {});
        
        let bookingStartTime = flatpickr(bookingStartTimeID, {
            enableTime: true,
            noCalendar: true,
            minuteIncrement: 30,
            dateFormat: "h:i K",
            defaultDate: "06:00 AM",
            minDate: "06:00 AM",
            maxDate: "08:00 PM"
        });
        let bookingEndTime = flatpickr(bookingEndTimeID, {
            enableTime: true,
            noCalendar: true,
            minuteIncrement: 30,
            dateFormat: "h:i K",
            defaultDate: "10:00 AM",
            minDate: "06:00 AM",
            maxDate: "11:00 PM"
        });

        // Set New Min Date for EndTime
        bookingStartTimeID.addEventListener('change', function (event) {
            bookingEndTime.set("minDate", bookingStartTimeID.value);
            bookingEndTimeID.removeAttribute('disabled'); 
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
            <div class="row mt-4 bookingDateTimeContainer" data-row-number="${bookingDateTimeRowNumber}">       
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
                        <input type="date" class="bookingTime bookingEndTime" placeholder="11:59 PM" disabled>
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
            return bookingInputValuesObject;
        } else {
            return false;
        }
    }
    

    // Sum Booking Prices
    function sumBookingPrices() {
        if(getBookingInputValues()) {
            let totalPrice = (getBookingInputValues().studioMembershipPrice * getBookingInputValues().bookingTotalHours).toFixed(1);
            $('.initialPrice').html(getBookingInputValues().studioMembershipPrice);
            $('.initialTime').html(getBookingInputValues().bookingTotalHours);
            $('.totalPrice').html(totalPrice);
        }
    }

    // Calculate Unused hours
    function calculateUnusedHours() {
        if(getBookingInputValues()) {
            let unusedHours = getBookingInputValues().studioMembershipHours - getBookingInputValues().bookingTotalHours;
            return unusedHours;
            // if(scheduledTimeDifference === 0) {
            //     $('.studioMembershipTime').html('<span>' + getBookingInputValues().studioMembershipHours + 'Studio Time fully scheduled. </span>');
            //     return true;
            // } else {
            //     $('.studioMembershipTime').html('<span>You have ' + scheduledTimeDifference + ' hours left. </span> You can schedule unused hours to another day.');
            //     return false;
            // }
        }
    }

    // Header Text 
    function headerTextDetails() {
        let studioMembershipSelector = $('select.studioMembership');
        if((studioMembershipSelector.val() === '') || (studioMembershipSelector.val() === null)) {
        } else {
            $('.materialInputForm input.bookingDate').removeAttr('disabled');
            $('.materialInputForm input.bookingStartTime').removeAttr('disabled');

            if(studioMembershipSelector.val() !== 'Studio Rental') {
                $('.subButton').addClass('active');
                $('.studioMembershipHeaderText').html(studioMembershipSelector.val() + ' - ' + studioMembershipSelector.find(':selected').data('hours') + 'hr studio time');
                if((calculateUnusedHours() === null) || (typeof calculateUnusedHours() === 'undefined')) {
                    $('.studioMembershipTime').html('');
                } else {
                    let lastRowNumber = $('.bookingDateTimeContainer[data-row-number]').length
                        
                    if(calculateUnusedHours() === 0){
                        $('.bookingDateTimeContainer[data-row-number="'+lastRowNumber+'"] .bookingEndTime').removeClass('warning');
                        $('.studioMembershipTime span').removeClass('warning');

                        $('.studioMembershipTime').html('<span>'+ studioMembershipSelector.find(':selected').data('hours') +' hours of ' + studioMembershipSelector.val() + ' fully scheduled</span>. Now Book Studio');
                    }
                    if(calculateUnusedHours() < 0){
                        $('.bookingDateTimeContainer[data-row-number="'+lastRowNumber+'"] .bookingEndTime').addClass('warning');
                        $('.studioMembershipTime span').addClass('warning');

                        $('.studioMembershipTime').html('<span>Studio Time set has passed ' + studioMembershipSelector.find(':selected').data('hours') + ' hours of ' + studioMembershipSelector.val() +' </span>.<br>Please re adjust the booking Time');
                    }
                    if(calculateUnusedHours() > 0){
                        $('.bookingDateTimeContainer[data-row-number="'+lastRowNumber+'"] .bookingEndTime').removeClass('warning');
                        $('.studioMembershipTime span').removeClass('warning');

                        $('.studioMembershipTime').html(studioMembershipSelector.find(':selected').data('hours') + ' hours of studio time. You can reschedule to another day<br><span>'+ calculateUnusedHours() +' hours studio time left.</span>');
                    }
                }
            } else {
                $('.subButton').removeClass('active');
                $('.studioMembershipHeaderText').html(studioMembershipSelector.val() + ' - $' + studioMembershipSelector.find(':selected').data('price') + '/hr');
            }
        }
    }
    
    // Default Booking Row Number and Dates Array
    var bookingDateTimeRowNumber = 1;
    var disabledSelectedDatesArray = [];

    // Init Flatpickr
    flatPickrInit(bookingDateTimeRowNumber);

    // Add to your appointment
    $('.multiSelectOptionsDiv input').change(function() {
        getCheckboxesValuesFunc($(this));
    });

    // Add New Data & Time Row
    $('.subButton').on('click', function(){
        bookingDateTimeRowNumber++;
        $('.bookingDateTimeAppendContainer').append(appendBookingDateAndTimeRow(bookingDateTimeRowNumber));
        flatPickrInit(bookingDateTimeRowNumber);
    });

    // Get Total Booking Price and update text
    $("body").on("change", ".materialInputForm select, .materialInputForm input", function(){
        sumBookingPrices();
        headerTextDetails();
    });

    // Submit data to server
    $('.materialInputForm input[type="submit"]').on('click', function(){
        console.log(getBookingInputValues());
    });
});;