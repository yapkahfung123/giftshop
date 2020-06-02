function error_alert(msg) {
    $('.single-product').find('.alert-danger').removeClass('hidden').find('strong').html(msg);
}

function remove_error_alert() {
    $('.single-product').find('.alert-danger').addClass('hidden');
}

function success_alert(msg) {
    $('.single-product').find('.alert-success').removeClass('hidden').find('strong').html(msg);
}

$('.attr-select .col-sm-6').change(function () {
    if ($(this).children().val() == '') {
        $(this).children().addClass('empty-variation');
        error_alert('You must select variation');

    } else {
        $(this).children().removeClass('empty-variation');
    }

    // Dont remove error tag when user not yet select variations
    if (!$('.attr-select .col-sm-6').children().hasClass('empty-variation')) {
        remove_error_alert();
    }
})

$('.close').click(function () {
    $(this).parent().addClass('hidden');
})

function plus_minus(operate, el) {
    var quantity = $('.prod_qty').val();
    var el_parent = el.parentElement;

    if (operate == '-') {
        if (quantity == 1) {
            error_alert('Quantity Minimum is 1');
            return false;
        }

        el_parent.find('.qty').val(parseInt(quantity) - 1);
    } else if (operate == '+') {
        if (!$('.single-product').find('.alert-danger').hasClass('hidden')) {
            remove_error_alert();
        }


        el_parent.find('.qty').val(parseInt(quantity) + 1);
    }
}

$('.quantity input[type=button]').each(function () {
    $(this).click(function () {
        var quantity = $(this).siblings('.qty').val();
        var operator = $(this).val();

        if (operator == '-') {
            if (quantity == 1) {
                error_alert('Quantity Minimum is 1');
                return false;
            }

            $(this).siblings('.qty').val(parseInt(quantity) - 1);
        } else if (operator == '+') {
            if (!$('.single-product').find('.alert-danger').hasClass('hidden')) {
                remove_error_alert();
            }


            $(this).siblings('.qty').val(parseInt(quantity) + 1);
        }
    })
})
