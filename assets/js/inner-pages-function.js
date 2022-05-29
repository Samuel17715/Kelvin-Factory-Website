let otpInnerPage = (email, profileid) => {
    let htmlContent = `
        <div class="materialInputCodeDiv materialOTPDiv">
            <h5>Enter OTP</h5>
            <p>Enter the OTP sent to this email (${email}).</p>
            
            <div class="materialMultipleInput">
                <input class="" type="text" maxlength="1" data-id="1" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="2" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="3" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="4" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="5" autocomplete="off" value="">
                <input class="" type="text" maxlength="1" data-id="6" autocomplete="off" value="">
                <input class="emailAddress" type="hidden" value="${email}">
                <input class="profileid" type="hidden" value="${profileid}">
                <input class="inputValue otpCode" type="hidden" autocomplete="off" value=""> <!-- RETRIEVE OTP VALUE HERE -->
            </div>
            <p class="resendOTPButton">Resend OTP Code</p>
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