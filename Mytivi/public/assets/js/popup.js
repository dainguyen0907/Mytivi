$('#updateUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('iduser')
    var modal = $(this)
    modal.find('#id-user').val(id)
})
$('#deleteUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('iduser')
    var modal = $(this)
    modal.find('#id-user').val(id)
})
$('#deleteProgramModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('idprogram')
    var modal = $(this)
    modal.find('#id-program').val(id)
    modal.find('#text-confirm').text('Bạn muốn xóa chương trình vơi id='+id+' ?')
})