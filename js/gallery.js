$(function() {
    $(document.body).on('click', '.changeType', function() {
        $(this).closest('.phone-input').find('.type-text').text($(this).text());
        $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
    });
    $(document.body).on('click', '.btn-remove-phone', function() {
        $(this).closest('.deletephone').remove();
    });
    $('.btn-add-phone').click(function() {
        var index = $('.phone-input').length + 1;
        $('.form-group').append('' +
            '<div class="deletephone">' +
            '<div class="spacer" style="height:20px;"></div>' +
            '<div class="row">' +
            '<div class="col-sm-10">' +
            '<div class="input-group phone-input">' +
            '<input type="hidden" name="uploadimg' + index + '" value="' + index + '">' +
            '<input name="image' + index + '" type="file" class="form-control" id="customFile" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<span  class="input-group-btn">' +
            '<button class="btn btn-danger btn-remove-phone" type="button"><i class="fas fa-times"></i></button>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
    });
});
$(document).ready(function(){
    $(document).on('click', "button[name='disablePhoto']", function() {
        var gallery_id = $(this).val();
        $("#photoStatus_" + gallery_id).load("photoStatus.php", {
            gallery_id: gallery_id,
            status: 0
        });
    });
    $(document).on('click', "button[name='enablePhoto']", function() {
        var gallery_id = $(this).val();
        $("#photoStatus_" + gallery_id).load("photoStatus.php", {
            gallery_id: gallery_id,
            status: 1
        });
    });
    $(document).on('click', "button[name='deletePhoto']", function() {
        var gallery_id = $(this).val();
        $("#carouselExampleIndicators").load("photoDelete.php", {
            gallery_id: gallery_id
        });
    });
});