// Update Wishlist:
$(document).ready(function(){
    $('.update_wishlist').click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = $(this).data('product_id');
        let user_id = document.getElementById('user_id').value;
        $.ajax({
            url: 'update_wishlist',
            type: 'POST',
            data: {
                product_id: product_id,
                user_id: user_id,
            },
            success:function(response){
                if (response.action == 'add') {
                    $('a[data-product_id='+product_id+']').html(`<i
                    class="favourite fa fa-heart"></i>`);
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', '#7fad39');
                    $('#notifDiv').text(response.message);
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (response.action == 'del') {
                    $('a[data-product_id='+product_id+']').html(`<i
                    class="fa fa-heart"></i>`);
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', '#dd2222');
                    $('#notifDiv').text(response.message);
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        });
    });
});