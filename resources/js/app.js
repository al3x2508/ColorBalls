require('./bootstrap');
$(function () {
    $(document).on('click', '.btn-add', function (e) {
        //Button for adding a new color
        e.preventDefault();
        var dynaForm = $('.dynamic-wrap form:first'),
            currentEntry = $(this).parents('.entry:first'),
            submitBtn = dynaForm.find('[type="submit"]'),
            newEntry = $(currentEntry.clone()).insertBefore(submitBtn);

        newEntry.find('input').val('');
        dynaForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus"></i>');
    }).on('click', '.btn-remove', function (e) {
        //Button for remove a color
        $(this).parents('.entry:first').remove();
        e.preventDefault();
        return false;
    });
    //Send the data via ajax; the result will be a json with a status and if it has an error, we will display the message of that error, else we will output the groups into a list
    $("#frm").submit(function(e) {
        e.preventDefault();
        $.post("api/balls", $(this).serialize(), function (data) {
            $("#groups").empty();
            $("#errors").addClass('d-none').text('');
            if(!data.status) {
                $("#errors").text(data.message).removeClass('d-none');
            }
            else {
                $.each(data.groups, function(key, group) {
                    $("#groups").append($("<li></li>").addClass("list-group-item").text(group));
                });
            }
        }, "json");
    });
});
