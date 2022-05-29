let otpInnerPage = () => {
    let htmlContent = `
        <div class="materialInputCodeDiv materialOTPDiv">
            <h5>Enter OTP</h5>
            <p>Enter the OTP sent to your email.</p>
            
            <div class="materialMultipleInput">
                <input class="" type="text" maxlength="1" data-id="1" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="2" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="3" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="4" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="5" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="6" autocomplete="off" value="">
                <input class="inputValue" type="hidden" autocomplete="off" value=""> <!-- RETRIEVE OTP VALUE HERE -->
            </div>
            <div class="materialFormInput mt-5">
                <input type="submit" class="" value="Submit">

                <div class="materialFormSecButton">
                    <a href="create-account.html" class="materialFormSecButton">Go Home <strong>(Create Account)</strong></a>
                </div>
            </div>
        </div>
    `;
    $('.loginForm').html(htmlContent);
}