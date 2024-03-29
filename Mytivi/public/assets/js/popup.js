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
$('#updateProgramModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('idprogram')
    var name=button.data('nameprogram')
    var catalogue=button.data('idcatalogue')
    var link=button.data('linkprogram')
    var modal = $(this)
    modal.find('#id-program').val(id)
    modal.find('#id_catalogue').val(catalogue)
    modal.find('#name_program').val(name)
    modal.find('#video').attr('src', link)
})
$('#deleteScheduleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('idschedule')
    var modal = $(this)
    modal.find('#id-schedule').val(id)
})
$('#updateScheduleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('idschedule')
    var program=button.data('idprogram')
    var priority=button.data('priority')
    var tstart=button.data('timestart')
    var tend=button.data('timeend')
    var modal = $(this)
    modal.find('#id-schedule').val(id)
    modal.find('#id_program').val(program)
    modal.find('#priority').val(priority)
    modal.find('#time_start').val(tstart)
    modal.find('#time_end').val(tend)

})