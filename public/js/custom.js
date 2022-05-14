let url = "http://127.0.0.1:8000";

$(document).ready(function () {

    $('.breadcrumbs li a').each(function () {

        var breadWidth = $(this).width();

        if ($(this).parent('li').hasClass('active') || $(this).parent('li').hasClass('first')) {


        } else {

            $(this).css('width', 75 + 'px');

            $(this).mouseover(function () {
                $(this).css('width', breadWidth + 'px');
            });

            $(this).mouseout(function () {
                $(this).css('width', 75 + 'px');
            });
        }

    });


    let province_id;
    $('#province').on('change', function () {
        province_id = $(this).find('option:selected').val();
        $.get(url + "/admin/get_city/" + province_id, function (data, status) {
                $("#city").empty();
                for (i = 0; i < data.length; i++) {
                    $("#city").append($("<option/>").val(data[i]['id']).text(data[i]['name']));
                }
            }
        )
    });

});


// submit form by a tag
function submitform() {
    document.myform.submit();
}




