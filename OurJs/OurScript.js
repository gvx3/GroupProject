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

//An dep trai functions used for search stuff
var accentMap = {
    'ẚ':'a','Á':'a','á':'a','À':'a','à':'a','Ă':'a','ă':'a','Ắ':'a','ắ':'a','Ằ':'a','ằ':'a','Ẵ':'a','ẵ':'a','Ẳ':'a','ẳ':'a','Â':'a','â':'a','Ấ':'a','ấ':'a','Ầ':'a','ầ':'a','Ẫ':'a','ẫ':'a','Ẩ':'a','ẩ':'a','Ǎ':'a','ǎ':'a','Å':'a','å':'a','Ǻ':'a','ǻ':'a','Ä':'a','ä':'a','Ǟ':'a','ǟ':'a','Ã':'a','ã':'a','Ȧ':'a','ȧ':'a','Ǡ':'a','ǡ':'a','Ą':'a','ą':'a','Ā':'a','ā':'a','Ả':'a','ả':'a','Ȁ':'a','ȁ':'a','Ȃ':'a','ȃ':'a','Ạ':'a','ạ':'a','Ặ':'a','ặ':'a','Ậ':'a','ậ':'a','Ḁ':'a','ḁ':'a','Ⱥ':'a','ⱥ':'a','Ǽ':'a','ǽ':'a','Ǣ':'a','ǣ':'a',
    'Ḃ':'b','ḃ':'b','Ḅ':'b','ḅ':'b','Ḇ':'b','ḇ':'b','Ƀ':'b','ƀ':'b','ᵬ':'b','Ɓ':'b','ɓ':'b','Ƃ':'b','ƃ':'b',
    'Ć':'c','ć':'c','Ĉ':'c','ĉ':'c','Č':'c','č':'c','Ċ':'c','ċ':'c','Ç':'c','ç':'c','Ḉ':'c','ḉ':'c','Ȼ':'c','ȼ':'c','Ƈ':'c','ƈ':'c','ɕ':'c',
    'Ď':'d','ď':'d','Ḋ':'d','ḋ':'d','Ḑ':'d','ḑ':'d','Ḍ':'d','ḍ':'d','Ḓ':'d','ḓ':'d','Ḏ':'d','ḏ':'d','Đ':'d','đ':'d','ᵭ':'d','Ɖ':'d','ɖ':'d','Ɗ':'d','ɗ':'d','Ƌ':'d','ƌ':'d','ȡ':'d','ð':'d',
    'É':'e','Ə':'e','Ǝ':'e','ǝ':'e','é':'e','È':'e','è':'e','Ĕ':'e','ĕ':'e','Ê':'e','ê':'e','Ế':'e','ế':'e','Ề':'e','ề':'e','Ễ':'e','ễ':'e','Ể':'e','ể':'e','Ě':'e','ě':'e','Ë':'e','ë':'e','Ẽ':'e','ẽ':'e','Ė':'e','ė':'e','Ȩ':'e','ȩ':'e','Ḝ':'e','ḝ':'e','Ę':'e','ę':'e','Ē':'e','ē':'e','Ḗ':'e','ḗ':'e','Ḕ':'e','ḕ':'e','Ẻ':'e','ẻ':'e','Ȅ':'e','ȅ':'e','Ȇ':'e','ȇ':'e','Ẹ':'e','ẹ':'e','Ệ':'e','ệ':'e','Ḙ':'e','ḙ':'e','Ḛ':'e','ḛ':'e','Ɇ':'e','ɇ':'e','ɚ':'e','ɝ':'e',
    'Ḟ':'f','ḟ':'f','ᵮ':'f','Ƒ':'f','ƒ':'f',
    'Ǵ':'g','ǵ':'g','Ğ':'g','ğ':'g','Ĝ':'g','ĝ':'g','Ǧ':'g','ǧ':'g','Ġ':'g','ġ':'g','Ģ':'g','ģ':'g','Ḡ':'g','ḡ':'g','Ǥ':'g','ǥ':'g','Ɠ':'g','ɠ':'g',
    'Ĥ':'h','ĥ':'h','Ȟ':'h','ȟ':'h','Ḧ':'h','ḧ':'h','Ḣ':'h','ḣ':'h','Ḩ':'h','ḩ':'h','Ḥ':'h','ḥ':'h','Ḫ':'h','ḫ':'h','H':'h','̱':'h','ẖ':'h','Ħ':'h','ħ':'h','Ⱨ':'h','ⱨ':'h',
    'Í':'i','í':'i','Ì':'i','ì':'i','Ĭ':'i','ĭ':'i','Î':'i','î':'i','Ǐ':'i','ǐ':'i','Ï':'i','ï':'i','Ḯ':'i','ḯ':'i','Ĩ':'i','ĩ':'i','İ':'i','i':'i','Į':'i','į':'i','Ī':'i','ī':'i','Ỉ':'i','ỉ':'i','Ȉ':'i','ȉ':'i','Ȋ':'i','ȋ':'i','Ị':'i','ị':'i','Ḭ':'i','ḭ':'i','I':'i','ı':'i','Ɨ':'i','ɨ':'i',
    'Ĵ':'j','ĵ':'j','J':'j','̌':'j','ǰ':'j','ȷ':'j','Ɉ':'j','ɉ':'j','ʝ':'j','ɟ':'j','ʄ':'j',
    'Ḱ':'k','ḱ':'k','Ǩ':'k','ǩ':'k','Ķ':'k','ķ':'k','Ḳ':'k','ḳ':'k','Ḵ':'k','ḵ':'k','Ƙ':'k','ƙ':'k','Ⱪ':'k','ⱪ':'k',
    'Ĺ':'l','ĺ':'l','Ľ':'l','ľ':'l','Ļ':'l','ļ':'l','Ḷ':'l','ḷ':'l','Ḹ':'l','ḹ':'l','Ḽ':'l','ḽ':'l','Ḻ':'l','ḻ':'l','Ł':'l','ł':'l','Ł':'l','̣':'l','ł':'l','̣':'l','Ŀ':'l','ŀ':'l','Ƚ':'l','ƚ':'l','Ⱡ':'l','ⱡ':'l','Ɫ':'l','ɫ':'l','ɬ':'l','ɭ':'l','ȴ':'l',
    'Ḿ':'m','ḿ':'m','Ṁ':'m','ṁ':'m','Ṃ':'m','ṃ':'m','ɱ':'m',
    'Ń':'n','ń':'n','Ǹ':'n','ǹ':'n','Ň':'n','ň':'n','Ñ':'n','ñ':'n','Ṅ':'n','ṅ':'n','Ņ':'n','ņ':'n','Ṇ':'n','ṇ':'n','Ṋ':'n','ṋ':'n','Ṉ':'n','ṉ':'n','Ɲ':'n','ɲ':'n','Ƞ':'n','ƞ':'n','ɳ':'n','ȵ':'n','N':'n','̈':'n','n':'n','̈':'n',
    'Ó':'o','ó':'o','Ò':'o','ò':'o','Ŏ':'o','ŏ':'o','Ô':'o','ô':'o','Ố':'o','ố':'o','Ồ':'o','ồ':'o','Ỗ':'o','ỗ':'o','Ổ':'o','ổ':'o','Ǒ':'o','ǒ':'o','Ö':'o','ö':'o','Ȫ':'o','ȫ':'o','Ő':'o','ő':'o','Õ':'o','õ':'o','Ṍ':'o','ṍ':'o','Ṏ':'o','ṏ':'o','Ȭ':'o','ȭ':'o','Ȯ':'o','ȯ':'o','Ȱ':'o','ȱ':'o','Ø':'o','ø':'o','Ǿ':'o','ǿ':'o','Ǫ':'o','ǫ':'o','Ǭ':'o','ǭ':'o','Ō':'o','ō':'o','Ṓ':'o','ṓ':'o','Ṑ':'o','ṑ':'o','Ỏ':'o','ỏ':'o','Ȍ':'o','ȍ':'o','Ȏ':'o','ȏ':'o','Ơ':'o','ơ':'o','Ớ':'o','ớ':'o','Ờ':'o','ờ':'o','Ỡ':'o','ỡ':'o','Ở':'o','ở':'o','Ợ':'o','ợ':'o','Ọ':'o','ọ':'o','Ộ':'o','ộ':'o','Ɵ':'o','ɵ':'o',
    'Ṕ':'p','ṕ':'p','Ṗ':'p','ṗ':'p','Ᵽ':'p','Ƥ':'p','ƥ':'p','P':'p','̃':'p','p':'p','̃':'p',
    'ʠ':'q','Ɋ':'q','ɋ':'q',
    'Ŕ':'r','ŕ':'r','Ř':'r','ř':'r','Ṙ':'r','ṙ':'r','Ŗ':'r','ŗ':'r','Ȑ':'r','ȑ':'r','Ȓ':'r','ȓ':'r','Ṛ':'r','ṛ':'r','Ṝ':'r','ṝ':'r','Ṟ':'r','ṟ':'r','Ɍ':'r','ɍ':'r','ᵲ':'r','ɼ':'r','Ɽ':'r','ɽ':'r','ɾ':'r','ᵳ':'r',
    'ß':'s','Ś':'s','ś':'s','Ṥ':'s','ṥ':'s','Ŝ':'s','ŝ':'s','Š':'s','š':'s','Ṧ':'s','ṧ':'s','Ṡ':'s','ṡ':'s','ẛ':'s','Ş':'s','ş':'s','Ṣ':'s','ṣ':'s','Ṩ':'s','ṩ':'s','Ș':'s','ș':'s','ʂ':'s','S':'s','̩':'s','s':'s','̩':'s',
    'Þ':'t','þ':'t','Ť':'t','ť':'t','T':'t','̈':'t','ẗ':'t','Ṫ':'t','ṫ':'t','Ţ':'t','ţ':'t','Ṭ':'t','ṭ':'t','Ț':'t','ț':'t','Ṱ':'t','ṱ':'t','Ṯ':'t','ṯ':'t','Ŧ':'t','ŧ':'t','Ⱦ':'t','ⱦ':'t','ᵵ':'t','ƫ':'t','Ƭ':'t','ƭ':'t','Ʈ':'t','ʈ':'t','ȶ':'t',
    'Ú':'u','ú':'u','Ù':'u','ù':'u','Ŭ':'u','ŭ':'u','Û':'u','û':'u','Ǔ':'u','ǔ':'u','Ů':'u','ů':'u','Ü':'u','ü':'u','Ǘ':'u','ǘ':'u','Ǜ':'u','ǜ':'u','Ǚ':'u','ǚ':'u','Ǖ':'u','ǖ':'u','Ű':'u','ű':'u','Ũ':'u','ũ':'u','Ṹ':'u','ṹ':'u','Ų':'u','ų':'u','Ū':'u','ū':'u','Ṻ':'u','ṻ':'u','Ủ':'u','ủ':'u','Ȕ':'u','ȕ':'u','Ȗ':'u','ȗ':'u','Ư':'u','ư':'u','Ứ':'u','ứ':'u','Ừ':'u','ừ':'u','Ữ':'u','ữ':'u','Ử':'u','ử':'u','Ự':'u','ự':'u','Ụ':'u','ụ':'u','Ṳ':'u','ṳ':'u','Ṷ':'u','ṷ':'u','Ṵ':'u','ṵ':'u','Ʉ':'u','ʉ':'u',
    'Ṽ':'v','ṽ':'v','Ṿ':'v','ṿ':'v','Ʋ':'v','ʋ':'v',
    'Ẃ':'w','ẃ':'w','Ẁ':'w','ẁ':'w','Ŵ':'w','ŵ':'w','W':'w','̊':'w','ẘ':'w','Ẅ':'w','ẅ':'w','Ẇ':'w','ẇ':'w','Ẉ':'w','ẉ':'w',
    'Ẍ':'x','ẍ':'x','Ẋ':'x','ẋ':'x',
    'Ý':'y','ý':'y','Ỳ':'y','ỳ':'y','Ŷ':'y','ŷ':'y','Y':'y','̊':'y','ẙ':'y','Ÿ':'y','ÿ':'y','Ỹ':'y','ỹ':'y','Ẏ':'y','ẏ':'y','Ȳ':'y','ȳ':'y','Ỷ':'y','ỷ':'y','Ỵ':'y','ỵ':'y','ʏ':'y','Ɏ':'y','ɏ':'y','Ƴ':'y','ƴ':'y',
    'Ź':'z','ź':'z','Ẑ':'z','ẑ':'z','Ž':'z','ž':'z','Ż':'z','ż':'z','Ẓ':'z','ẓ':'z','Ẕ':'z','ẕ':'z','Ƶ':'z','ƶ':'z','Ȥ':'z','ȥ':'z','ʐ':'z','ʑ':'z','Ⱬ':'z','ⱬ':'z','Ǯ':'z','ǯ':'z','ƺ':'z'
};

var cities = ["Hà Nội", "Hồ Chí Minh","Bình Dương","Đà Nẵng ","Hải Phòng","An Giang ","Bà Rịa Vũng Tàu","Bắc Giang","Bắc Ninh","Bạc Liêu","Bắc Kạn","Bình Định","Bình Phước ","Bến Tre","Bình Thuận","Cần Thơ","Cà Mau","Cao Bằng ","Điện Biên","Đắk Lắk ","Đắk Nông ","Đồng Nai","Đồng Tháp","Gia Lai","Hưng Yên","Hà Giang","Hà Nam ","Hà Tĩnh ","Hải Dương","Hòa Bình","Hậu Giang ","Khánh Hòa","Kiên Giang ","Kon Tum ","Lâm Đồng","Long An","Lai Châu","Lào Cai ","Lạng Sơn","Nam Định","Ninh Thuận","Ninh Bình","Phú Thọ ","Phú Yên ","Quảng Trị ","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh ","Sóc Trăng ","Sơn La ","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa ","Thừa Thiên Huế","Tiền Giang","Trà Vinh","Vĩnh Long","Vĩnh Phúc","Yên Bái ","Tuyên Quang","Nghệ An"];
var normalize = function( term ) {
    var ret = "";
    for ( var i = 0; i < term.length; i++ ) {
        ret += accentMap[ term.charAt(i) ] || term.charAt(i);
    }
    return ret;
};

function enablePagination(nItems){
    var limitPerPage = 10;
    $('#page .resultReturnedCell:gt(' +(limitPerPage - 1) + ') ').hide();
    var totalPages = Math.round(nItems/limitPerPage);
    $(".pagination").append("<li class='current-page active'><a href='javascript:void(0)'>" + 1 + "</a></li>");

    //Append the page number
    for(var i = 2; i <= totalPages; ++i){
        $(".pagination").append("<li class='current-page'><a href='javascript:void(0)'>" + i + "</a></li>");
    }

    // Add next button after all the page numbers  
    $(".pagination").append("<li id='next-page'><a href='javascript:void(0)' aria-label=Next><span aria-hidden=true>&raquo;</span></a></li>");
    //display new items based on the page number

    //Click on a page
    $(".pagination li.current-page").on("click", function(){
        alert("page + " + $(this).index() + " clicked");
        if($(this).hasClass('active')) {
            return false
        }
        else {
            var currentPage = $(this).index();
            $(".pagination li").removeClass('active'); //Remove all active class
            $(this).addClass('active');
            $("#page .resultReturnedCell").hide();

            var totalItemToThisPage = limitPerPage * currentPage;
            for(var i = totalItemToThisPage - limitPerPage; i < totalItemToThisPage; ++i){
                $("#page .resultReturnedCell:eq(" + i + ")").show();
            }
        }
    });

    $("#next-page").on("click", function(){
        var currentPage = $(".pagination li.active").index();
        
        if(currentPage === totalPages) {
            alert("This is the last page");
            return false;
        }
        else{
            currentPage++;
            $(".pagination li").removeClass('active');
            $("#page .resultReturnedCell").hide();

            var totalItemToThisPage = limitPerPage * currentPage;
            for(var i = totalItemToThisPage - limitPerPage; i < totalItemToThisPage; ++i){
                $("#page .resultReturnedCell:eq(" + i + ")").show();
            }

            $(".pagination li.current-page:eq(" + (currentPage - 1) + ")").addClass('active'); // Make new page number the 'active' page
        }
      }

    );



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
    // this function allows ajax login
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

    // ajax search
    // variable to hold the request
    var searchRequest;
    $("#searchForm").submit(function (event) {
        event.preventDefault();

        //Abort pending request
        if(searchRequest){
            searchRequest.abort();
        }
        var inputs = $(this).find("input, select, button, textarea");
        //Serialize data
        var serializedData = $(this).serialize();
        console.log(serializedData)
        //Disable inputs during the request
        inputs.prop("disabled", true);
        searchRequest = $.ajax({
            method: "post",
            url: "includes/LoadSearchResult.inc.php",
            data: serializedData
        });

        searchRequest.done(function (response, textStatus, jqXHR){
            //do the things with response here
            console.log("Me done");
            //console.log(response);
            response = JSON.parse(response);
            for(var i = 0; i < response.length; ++i){
                var id = response[i].id;
                var title = response[i].title;
                var price = response[i].price;
                var area = response[i].area;
                var address = response[i].address;
                var imageLink = response[i].image;
                var divResult = '<div class="row resultReturnedCell">' +
                                    '<a href="DetailPage.php?id=' + id + '">' +
                                        '<div class="row resultImageContainer">' + 
                                            '<img src="' + imageLink + '" alt="Image goes here">' +
                                        '</div>' +
                                        '<div class="row resultInfoContainer">'+
                                            '<h5 class="resultTitle">' + title  + '</h5>' +
                                            '<h3 class="resultPrice">' + price + '</h3>' +
                                            '<p class="resultArea">' + area + '</p>' +
                                            '<p class="resultAddress">' + address + '</p>' +
                                        '</div>' +
                                    '</a>' +
                                '</div>';
                $("#page").append(divResult);
                                
            }
            enablePagination(response.length);
        });
        searchRequest.always(function () {
            inputs.prop("disabled", false);
        });

        //Get all the field
      });
    
      

    //Function used for test only
    

    /* temporary disable
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
    */

     // This allow search with both "symbol" and no symbol
     $( "#cityListInput" ).autocomplete({
        mouseover: function(event, userInput) {
            $("#cityListInput").val(userInput.item);
            
        },
        source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( cities, function( value ) {
            value = value.label || value.value || value;
            return matcher.test( value ) || matcher.test( normalize( value ) );
            }) );
        }
    });

    //pagination part
    


    // $("#next-page").on("click", function(){
    //     var currentPage = $(".pagination li.active").index();
        
    //     if(currentPage === totalPages) {
    //         alert("This is the last page");
    //         return false;
    //     }
    //     else{
    //         currentPage++;
    //         $(".pagination li").removeClass('active');
    //         $("#page .resultReturnedCell").hide();

    //         var totalItemToThisPage = limitPerPage * currentPage;
    //         for(var i = totalItemToThisPage - limitPerPage; i < totalItemToThisPage; ++i){
    //             $("#page .resultReturnedCell:eq(" + i + ")").show();
    //         }

    //         $(".pagination li.current-page:eq(" + (currentPage - 1) + ")").addClass('active'); // Make new page number the 'active' page
    //     }
    //   }

    // );

    // $("#previous-page").on("click", function(){
    //     var currentPage = $(".pagination li.active").index();
        
    //     if(currentPage === 1) {
    //         alert("This is the First page");
    //         return false;
    //     }
    //     else{
    //         currentPage--;
    //         $(".pagination li").removeClass('active');
    //         $("#page .resultReturnedCell").hide();

    //         var totalItemToThisPage = limitPerPage * currentPage;
    //         for(var i = totalItemToThisPage - limitPerPage; i < totalItemToThisPage; ++i){
    //             $("#page .resultReturnedCell:eq(" + i + ")").show();
    //         }

    //         $(".pagination li.current-page:eq(" + (currentPage - 1) + ")").addClass('active'); // Make new page number the 'active' page
    //     }
    //   }

    // );

    
    
    
    // An dep trai
   

});








