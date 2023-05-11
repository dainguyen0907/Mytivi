<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action="admin/user/delete">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id-user" name="id">
                    </div>
                    <p>Bạn muốn xóa tài khoản này ?</p>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-danger text-light" data-dismiss="modal">Thoát</a>
                        <button type="submit" class="btn btn-primary">Đồng ý</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>