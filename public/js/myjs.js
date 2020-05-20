$('.deleteForm').click(function () {
    var form_id = $(this).closest("tr").find("td:first").html();

    swal({
        title: "Are you sure?",
        text: "Form ID " + form_id + " will be deleted.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            $(this).closest("tr").remove();

            $.ajax({
                url: "deleteform",
                method: "POST",
                data: {"formid": form_id},
                success: function () {

                    swal("Done!", "It was succesfully deleted!", {
                        icon: "success"
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", {
                        icon: "error"
                    });
                }
            })
        }
    });
})

$('.deleteProduct').click(function () {
    var product_id = $(this).closest("tr").find("td:first").html();

    swal({
        title: "Are you sure?",
        text: "Product Id " + product_id + " will be deleted.",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
    }).then((willDelete) => {
        if (willDelete.value) {

            // $(this).closest("tr").remove();

            $.ajax({
                url: "delete_product",
                method: "POST",
                data: {"product_id": product_id},
                success: function (data) {
                    response = JSON.parse(data);

                    if (response.status == 'true') {
                        swal("Done!", "It was succesfully deleted!", "success").then((confirm) => {
                            location.reload()
                        });
                    }
                },
            })
        }
    });
})

$('.deleteCategory').click(function () {
    var category_id = $(this).closest("tr").find("td:first").html();

    swal({
        title: "Are you sure?",
        text: "Category Id " + category_id + " will be deleted.",
        type: "warning",
        showCancelButton: true,
        cancelButtonColor: '#d33',
    }).then((willDelete) => {
        if (willDelete.value) {

            // $(this).closest("tr").remove();

            $.ajax({
                url: "delete_category",
                method: "POST",
                data: {"category_id": category_id},
                success: function (data) {
                    response = JSON.parse(data);

                    if (response.status == 'true') {
                        swal("Done!", "It was succesfully deleted!", "success").then((confirm) => {
                            location.reload()
                        });
                    }
                },
            })
        }
    });
})

$(document).ready(function () {
    var i = 0;
    $('.addVariation').click(function () {
        i++;
        var append_to = $('#modal-variation');

        var src = '<div class="row" id="row' + i + '">\n' +
            '<div class="col-md-6 col-5">\n' +
            '<input type="text" class="form-control variation" name="variation[]" placeholder="Color, Size etc..." required>\n' +
            '</div>\n' +
            '<div class="col-md-4 col-5">\n' +
            '<input type="text" class="form-control variation_attr" name="variation_attr[]" placeholder="Red, Blue..." required>\n' +
            '</div>\n' +
            '<div class="col-md-2 col-2">\n' +
            '<button id="' + i + '" class="btn btn-danger btn_remove">x</button>\n' +
            '</div>\n' +
            '</div>';
        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            console.log(button_id)
            $("#row" + button_id + "").remove();
        })

        append_to.append(src);
    })
})

$('.btn_remove_dom').click(function () {
    $(this).closest('.row').remove();
})


$(document).ready(function () {
    $('.p-Img').change(function () {
        var chg = $('.custom-file-label');
        var name = $(this);
        if (typeof (FileReader) != "undefined") {
            var tmp_image = $(".tmp_image");
            tmp_image.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $("<img />");
                    img.attr("style", "width: 10%;margin: 10px");
                    img.attr("src", e.target.result);
                    tmp_image.append(img);

                    chg.html(name[0]['files'][0]['name'])
                }
                reader.readAsDataURL(file[0]);
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    })
})

function deleteImg(el, id) {
    var p_id = $('#img_delete_p_id').val();
    var element = el;

    $.ajax({
        url: '/app/delete_img',
        method: 'post',
        data: {"img": id, "p_id": p_id},
        success: function (response) {
            data = JSON.parse(response);
            if (data.response == 'yes') {
                element.closest('span').remove();
            }
        }
    })
}

function deleteCatImg(el, id, category_id) {
    var p_id = category_id;
    var element = el;


    $.ajax({
        url: '/app/delete_category_img',
        method: 'post',
        data: {"img": id, "p_id": p_id},
        success: function (response) {
            data = JSON.parse(response);
            if (data.response == 'yes') {
                element.closest('span').remove();
            }
        }
    })
}

$(document).ready(function(){
    $(document).ready(function() {
        var limit = 3;
        $('.tag-multiselect').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 250,
            enableFiltering: true,
        });
    });

})




