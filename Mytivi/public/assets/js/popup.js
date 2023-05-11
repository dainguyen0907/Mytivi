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