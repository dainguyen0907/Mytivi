<div class="modal fade" id="deleteScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa lịch chiếu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action="admin/schedule/delete">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id-schedule" name="id">
                    </div>
                    <p id="text-confirm">Bạn muốn xóa lịch chiếu này ?</p>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-danger text-light" data-dismiss="modal">Thoát</a>
                        <button type="submit" class="btn btn-primary">Đồng ý</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>