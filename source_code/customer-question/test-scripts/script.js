globals = {
  css: '<link rel="stylesheet" type="text/css" href="{{css_url}}">',
  html: '<div id="oi-poc-popup" class=" oi-poc-popup oi-poc-popup-modal oi-poc-popup-static xoi-poc-popup-wide xoi-poc-popup-narrow xoi-poc-popup-tall xoi-poc-popup-short oi-poc-popup-center xoi-poc-popup-bottom Xoi-poc-popup-header-button Xoi-poc-popup-body-button oi-poc-popup-footer-button oi-poc-popup-button-static oi-poc-popup-branding-orange "> <div class="oi-poc-popup-container"> <div class="oi-poc-popup-header"> <div class="oi-poc-popup-branding"></div><span id="oi-poc-popup-close" class="oi-poc-popup-close">&#10005;</span> <span class="oi-poc-popup-title"><strong>I want to use adjusted/targeted advertisements</strong></span> <span id="oi-poc-popup-button-yes" class="oi-poc-popup-button">I agree</span> </div><div class="oi-poc-popup-body"> <p class="oi-poc-popup-title"><strong>I want to use adjusted/targeted advertisements</strong></p><p>I hereby allow my mobile operator, MNO XY, to create a general subscriber profile based on my data and to share this profile with 3rd parties cooperating with MNO XY in order to present me with targeted advertisements. Your profile will be created based on information obtained during the signup process and throughout the duration of the contract (Click here to check what kind of data we’re using). We will not use information about your calls, nor share your name, last name, phone number and address with our partners. You always have the possibility to opt-out <a href="#">here</a>. Find information about the partners we’re sharing your data with and details about your data subject rights <a href="#">here</a>. We and our partners use cookies to ensure that we provide you the best experience on our website. Such cookies may track your interaction with this dialogue. We and our partners also use cookies to make sure that we show you advertising that is relevant to you. If you continue without changing your settings, we\'ll assume that you are happy to receive all cookies from us and our partners. However, you can change your cookie settings at any time.</p><span id="oi-poc-popup-button-yes" class="oi-poc-popup-button">I agree</span> </div><div class="oi-poc-popup-footer"> <span id="oi-poc-popup-button-yes" class="oi-poc-popup-button">I agree</span> </div></div>',
  sid : "{{subID}}",
  host: "http://172.21.1.238:8088/optink/ccp",
  cid : "{{consentID}}"
};
(function(){
   setTimeout(function() {
      showOptin();
    }, 2000);
    function showOptin() {
        var ins = document.createElement("ins");
        ins.setAttribute('data-pid',"14");
        ins.setAttribute('id',"optink-popup-ins");
        document.body.appendChild(ins);
        document.getElementById("optink-popup-ins").innerHTML += (globals.css + globals.html);
        document.getElementById("oi-poc-popup").style.display = "block";
        document.getElementById("oi-poc-popup").addEventListener("click", function dismissPopup( e ){
            e = window.event || e;
            if (this === e.target) {
                document.getElementById("oi-poc-popup").style.display = "none";
            }
            sendOptIn("close");
        }, false);
        buttonsYes = document.getElementsByClassName("oi-poc-popup-button");
        for (var i = 0; i < buttonsYes.length; i++) {
            buttonsYes[i].addEventListener("click", function dismissPopup( e ){
                e = window.event || e;
                if (this === e.target) {
                    document.getElementById("oi-poc-popup").style.display = "none";
                }
                sendOptIn("yes");
                var img = document.getElementById("oi-poc-popup-image");
                if (img) {
                    img.classList.remove("cta");
                    img.classList.add("ty");
                }
                var popup = document.getElementById("oi-poc-popup");
                if (popup && popup.classList.contains("oi-poc-popup-branding-orange-expand")) {
                    document.getElementById("oi-poc-popup-image-placeholder").style.display = "block";
                }
                if (popup && popup.classList.contains("oi-poc-popup-embedded")) {
                    document.getElementById("oi-poc-popup-image-placeholder").style.display = "block";
                }
                e.stopPropagation();
            }, false);
        };
        buttonsClose = document.getElementsByClassName("oi-poc-popup-close");
        for (var i = 0; i < buttonsClose.length; i++) {
            buttonsClose[i].addEventListener("click", function dismissPopup( e ){
                e = window.event || e;
                if (this === e.target) {
                    document.getElementById("oi-poc-popup").style.display = "none";
                }
                sendOptIn("close");
                var popup = document.getElementById("oi-poc-popup");
                if (popup && popup.classList.contains("oi-poc-popup-branding-orange-expand")) {
                    document.getElementById("oi-poc-popup-image-placeholder").style.display = "block";
                }
                e.stopPropagation();
            }, false);
        };
    };
    function sendOptIn(answer) {
        var tlink = globals.host+"?answer="+answer+"&cid="+globals.cid;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", tlink, true);
        xhttp.withCredentials = true;
        xhttp.onload = function () {
            if (xhttp.readyState === xhttp.DONE) {
                if (xhttp.status === 200) {

                }
            }
        };
        xhttp.send(null);
    };
})();