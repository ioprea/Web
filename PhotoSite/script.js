$(document).ready(function() {

  // function refresh () {
  //     $('.insideChat').load(document.URL +  ' .chatDiv');
  //     //$('.chatDiv').css('display', 'block');
  //   }

    var leftCount = 0
    var rightCount = 0
    var menuCount = 0
    var startTime
    var leftTime = 0
    var rightTime = 0
    var menuTime = 0

    $(".leftContent").mouseenter(function(event) {
      /* Act on the event */
      startTime = new Date();
    });
    $(".leftContent").mouseleave(function(event) {
      /* Act on the event */
      var endTime = new Date();
      var timeDiff = endTime - startTime;
      timeDiff /= 1000;
      leftTime += timeDiff
      console.log("leftTime: " + leftTime);
    });


    $(".rightContent").mouseenter(function(event) {
      /* Act on the event */
      startTime = new Date();
    });
    $(".rightContent").mouseleave(function(event) {
      /* Act on the event */
      var endTime = new Date();
      var timeDiff = endTime - startTime;
      timeDiff /= 1000;
      rightTime += timeDiff
      console.log("rightTime: " + rightTime);
    });

    $("#menu").mouseenter(function(event) {
      /* Act on the event */
      startTime = new Date();
    });
    $("#menu").mouseleave(function(event) {
      /* Act on the event */
      var endTime = new Date();
      var timeDiff = endTime - startTime;
      timeDiff /= 1000;
      menuTime += timeDiff
      console.log("menuTime: " + menuTime);
    });




    $("#chatButton").click(function(event) {
      /* Act on the event */
      event.preventDefault();
      //var refreshIntervalId = setInterval(refresh, 2000);
      $('.leftContent').css('display', 'none');
      $('.rightContent').css('display', 'none');
      $('.chatDiv').css('display', 'block');
    });


    var loginF = $('#loginForm')[0];
    var upload = $('#uploadPhoto')[0];
    var signup = $('#signupForm')[0];

    window.onclick = function(event) {
        if (event.target == loginF) {
            loginF.style.display = "none";
        }
        if (event.target == upload) {
            upload.style.display = "none";
        }
        if (event.target == signup) {
            signup.style.display = "none";
        }
      }

    var slideIndex = 1;
    showSlides(slideIndex);

    $('#nextBtn').click(function() {
        showSlides(slideIndex += 1);
    });


    function toSlide(n) {
      slideIndex = n;
      showSlides(slideIndex);
    }

    function showSlides(n) {
      var i;
      var slides = $('.mySlides');

      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }

      slides[slideIndex-1].style.display = "block";

    }

    // $('#homeBtn').click(function(event) {
    //   /* Act on the event */
    //   clearInterval(refreshIntervalId);
    // });

    $('#loginBtn').click(function() {
        var day = new Date().getDay();
        $.post({
            url: "login.php",
            data: {
                username: $('#usernameField').val(),
                password: $('#passwordField').val(),
                date: day
            }
        }).done(function(result) {
          //location.reload();
        });
    });


    $('#logoutBtn').click(function() {
        clearInterval(refreshIntervalId);
        $('.leftContent').css('display', 'block');
        $('.rightContent').css('display', 'block');
        $('.chatDiv').css('display', 'none');
        $.get({
            url: "logout.php"
        });
        location.reload();
    });



    $('#chatBtn').click(function() {
        $.post({
                url: "chat.php",
                data: {
                    message: $('#messageInput').val()
                }
            })
            .done(function(result) {
                if(result == "Fail") alert("You have to be logged in");
                else {
                  $('#chatList').append('<li>' + $('#chatUser').text() + ': ' + $('#messageInput').val() + '</li>');
                  $('#messageInput').val('');
                }
            });
    });

});
