$(document).ready(function() {
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
    });

    // Add New Data & Time Row
    $('.subButton').on('click', function(){
        bookingDateTimeRowNumber++;
        $('.bookingDateTimeAppendContainer').append(appendBookingDateAndTimeRow(bookingDateTimeRowNumber));
        flatPickrInit(bookingDateTimeRowNumber, disabledSelectedDatesArray);
    });

    // Get Total Booking Price and update text
    $("body").on("change", ".materialInputForm select, .materialInputForm input", function(){
        sumBookingPrices();
        headerTextDetails();
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
});