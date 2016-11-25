var cache = {},
        counter = 0,
        emptyText = '<tr><td colspan="6" class="sys_align_center">No Data / Tidak ada data</td></tr>';
$(document).ready(function () {
    var tbody = $('#addProduct');
    $('#add').click(function (evt) {
        var output = '<tr id="data_' + counter + '">' +
                '<td><input type="checkbox" class="checkbox"/></td>' +
                '<td><input name="item[]" type="text" id="name_' + counter + '" class="form-control" required=""/></td>' +
                '<td><input name="qty[]" id="quantity_' + counter + '" type="text" class="form-control col-lg-4" required="" /></td>' +
                '<td><input name="unit[]" id="price_' + counter + '" type="text" class="form-control" required="" /></td>' +
                '</tr>';

//        if ($('tr td', tbody).length === 1) {
//            tbody.html('');
//        }
        if (counter === 0) {
            $('#empty').remove();
            $('#first').show();
            $('#item').focus();
        }
        else if (counter > 0) {
            tbody.append(output);
            $('#item').focus();
        }

        counter++;
        $('#counter').val(counter);
        evt.preventDefault();
    });

    $('#delete').click(function (evt) {
        $('input:checked', tbody).each(function () {
            $(this).closest('tr').remove();
        });

        if ($('tr', tbody).length === 0) {
            tbody.html(emptyText);
        }

        evt.preventDefault();
    });

});