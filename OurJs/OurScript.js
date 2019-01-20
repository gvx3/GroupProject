$('#carouselExample').on('slide.bs.carousel', function (e) {


    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;

    if (idx >= totalItems - (itemsPerSlide - 1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i = 0; i < it; i++) {
            // append slides to end
            if (e.direction == "left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


$('#carouselExample').carousel({
    interval: 2000
});

//An dep trai
function openInNewTab(url) {
    alert('andeptrai')
    window.open(url, '_blank');
    
  }
function search(input) {
    alert('An dep trai trai');
}
//An dep trai


$(document).ready(function () {
    /* show lightbox when clicking a thumbnail */
    $('a.thumb').click(function (event) {
        event.preventDefault();
        var content = $('.modal-body');
        content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);
        content.html($(this).html());
        $(".modal-profile").modal({ show: true });
    });
    // An dep trai
    $("#loginForm").submit(function(event) {
        event.preventDefault();
        var username = $("#inputUsername").val();
        var password = $("#inputPassword").val();
        var loginButton = $("#loginButton").val();
        $("#form_message").load("includes/login.inc.php", {
            userName: username,
            userPassword: password,
            loginButton: loginButton  
        });
    });

    $("#changeProfileForm").submit(function(event) {
        event.preventDefault();
        var email = $("#email-change").val();
        var password = $("#password-change").val();
        var password_repeat = $('#repeat-password-change').val();
        var imageLink = $('#input-user-image').val();
        var phone = $('#input-user-tel').val();
        var city = $('#type-location').val();
        var changeProfileButton = $("#changeProfileButton").val();
        $("#change_profile_message").load("includes/changeProfile.inc.php", {
            // php variable is on the left
            email: email,
            password: password,
            passwordRepeat: password_repeat,
            imageLink: imageLink,
            phone: phone,
            city: city,
            changeProfileButton: changeProfileButton  
        });
    });

    $("#buyRadioButton").change(function () { 
        $('#homeSearchForm').unbind("submit");
        $('#homeSearchForm').submit(function(e){
            var params = {index: "buy", query: $("#homeSearch").val()};
            console.log(params);
            var queryStr = jQuery.param(params );
            window.open("search.html?" + queryStr, '_blank');
            return false;
        });

    

    });

    $("#rentRadioButton").change(function () { 
        $('#homeSearchForm').unbind("submit");

        $('#homeSearchForm').submit(function(e){
            var params2 = { index:"rent", query: $("#homeSearch").val()};
            var queryStr2 = jQuery.param(params2 );
            window.open("search.html?" + queryStr2, '_blank');
            return false;
        });
   

    });
    

    
    // An dep trai

});