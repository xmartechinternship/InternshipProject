<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/global.css'); ?> ">
    <link rel=" stylesheet" href="<?php echo base_url('public/css/home-page.css'); ?>" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400&display=swap" />
</head>

<body>
    <div class="home-page">
        <div class="contact-us-parent">
            <div class="contact-us">Contact Us</div>
            <div class="frame-child"></div>
            <div class="products">Products</div>
            <div class="links">Links</div>
            <div class="contact-us1">Contact us</div>
            <div class="company-details">Company details</div>
            <div class="div">
                <p class="p">..............</p>
                <p class="p">.........................</p>
                <p class="p">...................</p>
                <p class="p">......</p>
            </div>
            <img class="insta-icon" alt="" src="<?php echo base_url('public/images/insta.svg') ?>" />
        </div>
        <div class="why-choose-us-parent">
            <div class="why-choose-us">Why choose us?</div>
            <div class="electronic-commerce-commonly">
                Electronic commerce, commonly known as e-commerce, is the buying and
                selling of product or service over electronic systems such as the
                Internet and other computer networks. Electronic commerce is generally
                considered to be the sales aspect of e-business. It also consists of
                the exchanging of data to facilitate the financing and payment aspects
                of business transactions.
            </div>
        </div>
        <img class="home-page-child" alt="" src="<?php echo base_url('public/images/group-8.svg') ?>" />
        <div class="categories-parent">
            <div class="categories1">Categories</div>
            <div class="frame-wrapper">
                <div class="frame-div">
                    <img class="frame-item" alt=""
                        src="<?php echo base_url('public/images/rectangle-14@2x.png') ?>" /><img class="frame-inner"
                        alt="" src="<?php echo base_url('public/images/rectangle-15@2x.png') ?>" /><img
                        class="frame-child1" alt=""
                        src="<?php echo base_url('public/images/rectangle-16@2x.png') ?>" /><img class="frame-child2"
                        alt="" /><img class="frame-child3" alt=""
                        src="<?php echo base_url('public/images/rectangle-18@2x.png')?>" />
                </div>
            </div>
            <div class="view-all-wrapper">
                <b class="view-all">View All &gt;</b>
            </div>
        </div>
        <div class="home-page-inner">
            <div class="navigation-c-wrapper">
                <div class="navigation-c3">
                    <div class="sample-logo3" id="sampleLogoContainer">
                        <div class="photo3">n.o.w</div>
                        <img class="union-icon6" alt="" src="<?php echo base_url('public/images/union2.svg') ?>" /><img
                            class="union-icon6" alt="" src="./public/union3.svg" />
                    </div>
                    <div class="button5" id="buttonContainer">
                        <div class="button-child3"></div>
                        <div class="register2">Register</div>
                    </div>
                    <div class="button6" id="buttonContainer1">
                        <div class="button-child4"></div>
                        <div class="log-in2">Log in</div>
                    </div>
                    <div class="cart2" id="cartText">Cart</div>
                    <div class="line-parent1">
                        <div class="group-child37"></div>
                        <div class="search3">Search</div>
                    </div>
                    <img class="search-alt-icon3" alt="" src="<?php echo base_url('public/images/search-alt.svg') ?>" />
                </div>
            </div>
        </div>
    </div>

    <script>
    var sampleLogoContainer = document.getElementById("sampleLogoContainer");
    if (sampleLogoContainer) {
        sampleLogoContainer.addEventListener("click", function(e) {
            window.location.href = "home-page.html";
        });
    }

    var buttonContainer = document.getElementById("buttonContainer");
    if (buttonContainer) {
        buttonContainer.addEventListener("click", function(e) {
            window.location.href = "./signup.html";
        });
    }

    var buttonContainer1 = document.getElementById("buttonContainer1");
    if (buttonContainer1) {
        buttonContainer1.addEventListener("click", function(e) {
            window.location.href = "./login.html";
        });
    }

    var cartText = document.getElementById("cartText");
    if (cartText) {
        cartText.addEventListener("click", function(e) {
            window.location.href = "./cart-page.html";
        });
    }
    </script>
</body>

</html>