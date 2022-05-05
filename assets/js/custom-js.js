$(document).ready(function() {
    // Right Bar
    $('.mainBodyRightContainerTrigger, .mainBodyRightCloseBtn, .mainBodyRightDivCloseContainer').click(function(){
        let windowPositionY = $('body').scrollTop();
        $('.mainBodyRightContainer').css("top", windowPositionY);
        $('.mainBodyRightContainer').toggleClass('active');
        $('.mainBodyRightDiv').addClass('animate__bounceInRight');
    });


    // Appointment Checkboxes
    const checkboxesValueArray = []
    $('.multiSelectOptionsDiv input').change(function() {
        let checkboxes = $('.multiSelectOptionsDiv input:checkbox:checked').length;
        if(checkboxes === 0) {
            $('.checkBoxesButton .checkBoxesButtonText').html('Add to your appointment');
        } else {
            $('.checkBoxesButton .checkBoxesButtonText').html(checkboxes + ' items selected');
        }

        let arrayIndex = checkboxesValueArray.findIndex(e => e.name === $(this).val());
        if( arrayIndex === -1 ){
            checkboxesValueArray.push({"name": $(this).val(), "price": $(this).attr('data-value')});
        } else {
            checkboxesValueArray.splice(arrayIndex, 1);
        }
    });


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
            maxDate: "11:30 PM"
        });
        let bookingEndTime = flatpickr(bookingEndTimeID, {
            enableTime: true,
            noCalendar: true,
            minuteIncrement: 30,
            dateFormat: "h:i K",
            defaultDate: "11:30 PM",
            minDate: "06:00 AM",
            maxDate: "11:30 PM"
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

    // Default Booking Row Number and Dates Array
    var bookingDateTimeRowNumber = 1;
    var disabledSelectedDatesArray = [];


    // Init Flatpickr
    flatPickrInit(bookingDateTimeRowNumber);


    // Append Booking Date And TIme Row
    function appendBookingDateAndTimeRow(bookingDateTimeRowNumber){
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


    // Show or Hide Add New Booking Input Form
    $('select.studioMembership').on('change', function(){
        $('.studioMembershipHeaderText').html($(this).val() + ' - $' + $(this).find(':selected').data('price'));
        $('.studioMembershipHeaderDetails').html($(this).find(':selected').data('text'));

        if(($(this).val() !== 'Studio Rental') && ($(this).val() !== '')) {
            $('.subButton').addClass('active');
        } else {
            $('.subButton').removeClass('active');
        }
    });


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
    function calculateTotalHours() {
        let totalBookingHours = 0
        for(let i=1; i<=$('.bookingDateTimeContainer[data-row-number]').length; i++){
           if(($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingStartTime').val() !== '') && ($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingEndTime').val() !== '')) {
                totalBookingHours += convertTime($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingEndTime').val()) - convertTime($('.bookingDateTimeContainer[data-row-number="'+i+'"] .bookingStartTime').val());
            }
        }
        return totalBookingHours;
    }


    // Get booking input values
    function getBookingInputValues() {
        let bookingInputValuesObject = {
            studioMembershipValue: $('select.studioMembership').val(),
            studioMembershipHours: parseInt($('select.studioMembership').find(':selected').data('hours')),
            studioMembershipPrice: parseInt($('select.studioMembership').find(':selected').data('price')),
            bookingDateValue: $('.bookingDate').val(),
            bookingTotalHours: calculateTotalHours()
        }
        
        if((bookingInputValuesObject.studioMembershipValue !== '') && (bookingInputValuesObject.bookingDateValue !== '')) {
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
            let scheduledTimeDifference = getBookingInputValues().studioMembershipHours - getBookingInputValues().bookingTotalHours;
            if(scheduledTimeDifference === 0) {
                $('.studioMembershipTime').html('<span>' + getBookingInputValues().studioMembershipHours + 'Studio Time fully scheduled. </span>');
                return true;
            } else {
                $('.studioMembershipTime').html('<span>You have ' + scheduledTimeDifference + ' hours left. </span> You can schedule unused hours to another day.');
                return false;
            }
        }
    }

    $("body").on("change", ".materialInputForm select, .materialInputForm input", function(){
        sumBookingPrices();
        calculateUnusedHours();
    });

    // Add New Data & Time Row
    $('.subButton').on('click', function(){
        bookingDateTimeRowNumber++;
        $('.bookingDateTimeAppendContainer').append(appendBookingDateAndTimeRow(bookingDateTimeRowNumber));
        flatPickrInit(bookingDateTimeRowNumber);
    });
});