<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action="admin/user/update">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id-user" name="id">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-form-label">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary text-light" data-dismiss="modal">Đóng</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>