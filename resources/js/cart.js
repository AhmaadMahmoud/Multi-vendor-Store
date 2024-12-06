import { data } from "autoprefixer";

(function($) {

    $('.item-quantity').on('change', function(e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            },
            success: function(response) {
            if (response.success) {
                // تحديث التوتال في الواجهة
                $('#cart-total').text(response.total); // تحديث العنصر الذي يحتوي على التوتال
            }
        },
    })
    });

    $('.remove-item').on('click', function(e) {

        let id = $(this).data('id'); // معناها انه هيدور علي اتربيوت اسمه data-id
        $.ajax({
            url: "/cart/" + id, //data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
                $("#cart-total").text(response.total);
            }
        });
    });
    $('.add-to-cart').on('click', function(e) {

        let id = $(this).data('id');
        $.ajax({    
            url: "/cart/", //data-id
            method: "post",
            data: {
                product_id: $(this).data("id"),
                quantity: $(this).data("quantity"),
                _token: csrf_token,
            },
            success: (response) => {
                alert('product added succssfully!');
            },
        });
    });
})(jQuery);
