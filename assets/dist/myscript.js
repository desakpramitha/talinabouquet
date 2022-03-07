const flashData = $('.flash-data').data('flashdata');
if (flashData) {
    Swal({
        title: 'Success',
        text: flashData,
        type: 'success'
    });
}