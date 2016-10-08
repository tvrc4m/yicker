<div class="sidebar-right">
    <div class="sidebar-scroll">
        <div class="sidebar-divider">
            Let's get social
        </div>
        <div class="sidebar-menu">
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-facebook"></i> Facebook
                <i class="fa fa-circle"></i>
            </a>
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-twitter"></i> Twitter
                <i class="fa fa-circle"></i>
            </a>
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-google-plus"></i> Google
                <i class="fa fa-circle"></i>
            </a>
        </div>
        <div class="sidebar-divider">
            GET IN TOUCH
        </div>
        <div class="sidebar-menu">
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-phone"></i> Call Us
                <i class="fa fa-circle"></i>
            </a>
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-fax"></i> Fax Us
                <i class="fa fa-circle"></i>
            </a>
            <a class="menu-item" href="#" data-pjax="true">
                <i class="fa fa-envelope-o"></i> Mail Us
                <i class="fa fa-circle"></i>
            </a>
        </div>
        <div class="sidebar-divider">
            SEND US A MESSAGE
        </div>
        <div class="sidebar-form contact-form no-bottom">
            <div class="formSuccessMessageWrap" id="formSuccessMessageWrap" style="display: none;">
                Awesome! We'll get back to you!
            </div>
            <form action="php/contact.php" method="post" class="contactForm" id="contactForm">
                <fieldset>
                    <div class="formValidationError" id="contactNameFieldError" style="display: none;">Name is required!</div>
                    <div class="formValidationError" id="contactEmailFieldError" style="display: none;">Mail address required!</div>
                    <div class="formValidationError" id="contactEmailFieldError2" style="display: none;">Mail address must be valid!</div>
                    <div class="formValidationError" id="contactMessageTextareaError" style="display: none;">Message field is empty!</div>
                    <div class="formFieldWrap">
                        <input onfocus="if (this.value=='Name') this.value = ''" onblur="if (this.value=='') this.value = 'Name'" type="text" name="contactNameField" value="Name" class="contactField requiredField" id="contactNameField">
                    </div>
                    <div class="formFieldWrap">
                        <input onfocus="if (this.value=='Email') this.value = ''" onblur="if (this.value=='') this.value = 'Email'" type="text" name="contactEmailField" value="Email" class="contactField requiredField requiredEmailField" id="contactEmailField">
                    </div>
                    <div class="formTextareaWrap">
                        <textarea onfocus="if (this.value=='Message') this.value = ''" onblur="if (this.value=='') this.value = 'Message'" name="contactMessageTextarea" class="contactTextarea requiredField" id="contactMessageTextarea">Message</textarea>
                    </div>
                    <div class="formSubmitButtonErrorsWrap">
                        <input type="submit" class="buttonWrap button button-green contactSubmitButton no-bottom" id="contactSubmitButton" value="SUBMIT" data-formid="contactForm">
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="sidebar-decoration"></div>
    </div>
</div>
<script type="text/javascript">
    
</script>