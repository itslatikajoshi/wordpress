<section class="lead_form">
    <div class="max_width">
        <h4>Request a Call back</h4>
        <div id="form" class="tml_homepage_new_lead_form">
            <form class="sw_new_lead_form" action="" method="POST">
                <div class="home_lead_form onpgfrm clear">
                    <div class="clear">
                        <div class="width25 fieldspacing paddingRight">
                            <div class="input-container">
                                <!--Name-->
                                <input type="text" class="floatlabel" id="name" name="name" required>
                                <label for="name">Name</label>
                                <span class="error" id="nameErr"></span>
                                <!--Name-->
                            </div>
                        </div>
                        <div class="width25 fieldspacing paddingLeft paddingRight">
                            <div class="input-container">
                                <!--Email-->
                                <input type="email" class="floatlabel" id="email" name="email" required>
                                <label for="email">Email</label>
                                <span class="error" id="emailErr"></span>
                                <!--Email-->
                            </div>
                        </div>
                        <div class="width25 fieldspacing paddingLeft paddingRight">
                            <div class="input-container">
                                <!--Mobile-->
                                <input type="tel" id="mobile" class="floatlabel" maxlength="10" name="mobile" required>
                                <label for="mobile">Mobile</label>
                                <span class="error" id="mobileErr"></span>
                                <!--Mobile-->
                            </div>
                        </div>
                    </div>

                    <div class="clear SHL-Checkbox" style="display: none;">
                        <div class="width100">
                            <div class="input-container highlighted_heading">
                                <p>I would like to</p>
                            </div>
                        </div>
                    </div>
                    <div class="clear SHL-Checkbox" style="display: none;">
                        <div class="highlighted_checkbox">
                            <!--Purchase within 1 month-->
                            <div class="width25 fieldspacing paddingRight">
                                <div class="input-container">
                                    <div class="checkbox">
                                        <div class="checkbox-group">
                                            <!-- <input type="checkbox" id="purchaseInOneMonth" name="checkbox" required> -->
                                            <label for="purchaseInOneMonth">Purchase within one month.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Purchase within 1 month-->
                            <!--Test drive within one week-->
                            <div class="width25 fieldspacing paddingLeft">
                                <div class="input-container">
                                    <div class="checkbox">
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="testDriveInOneWeek">
                                            <label for="testDriveInOneWeek">Test drive within one week.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Test drive within one week-->
                        </div>
                    </div>
                    <div class="clear">
                        <br>
                    </div>
                </div>

                <div>
                    <div class="clear">
                        <div class="nothighlighted_checkbox input-container">
                            <div class="checkbox">
                                <div class="checkbox-group">
                                    <!--Terms & Conditions and Privacy Policy-->
                                    <input type="checkbox" id="termsConditionPrivacyPolicy" checked="">
                                    <label for="termsConditionPrivacyPolicy">I agree to the Terms and Conditions &amp;
                                        Privacy policy by Black Pearl Cosmetic.</label>
                                    <span id="termsConditionPrivacyPolicyErr"></span>
                                    <!--Terms & Conditions and Privacy Policy-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear">
                    <div class="width33 fieldspacing"></div>
                    <div class="width33 fieldspacing paddingRight paddingLeft">
                        <div class="genrtotp btn_popup new_lead_submit">
                            <button type="submit" id="sendOTP">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
</section>