$(function() {
    $(".search").click(function(e) {
        e.preventDefault(); //ngăn sự kiện mặc dịnh
        let search = document.getElementById("key").value;
        if (search == "") {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', '#dd2222');
            $('#notifDiv').text('Please select the keyword to search?');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 4000);
        } else {
            $( "#formSearch" ).submit();
        }
    });
});