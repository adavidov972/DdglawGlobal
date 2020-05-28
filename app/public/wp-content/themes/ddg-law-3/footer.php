<section class="footer-section" id="footer">

    <div class="row footer-container">

            <div class="col-lg-8 lets-talk-container">
                <h1 class="lets-talk-header">? שנדבר</h1>

                <form class="lets-talk-form row" action="index.html" method="post">
                <input class="form-group col-lg-12" type="text" name="fullName" value="שם מלא">
                <input class="form-group col-lg-12" type="text" name="phone" value="טלפון">
                <input class="form-group col-lg-12" type="email" name="email" value="דואר אלקטרוני">
                <input class="form-group col-lg-12" type="text" name="somethingElse" value="? עוד משהו">
                </form>

                <!-- <img src="I'm not a robot" alt="not-a-robot-img"> -->
                <div class="g-recaptcha" data-sitekey= <%= process.env.SITE_KEY %></div>
                <div class="send-btn-container">
                <button type="button" class="btn btn-danger btn-send">שלח</button>
                </div>
            </div>

            <div class="col-lg-4 card-contact-details">

                <img class="footer-logo" src="<?php echo get_theme_file_uri('/images/footer-logo.png') ?>" alt="DdgLaw-icon">
                <h3 class="contact-details">רח׳ החשמונאים 115</h3>
                <h3 class="contact-details">תל אביב, 6713325</h3>
                <h3 class="contact-details">טלפון: 03-6350202</h3>
                <h3 class="contact-details">פקס: 03-6350242</h3>
            </div>
            </div>
        </section>
        <?php wp_footer(); ?>       
    </body>
</html>