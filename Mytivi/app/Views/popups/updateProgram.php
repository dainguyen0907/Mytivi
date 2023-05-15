<div class="modal fade" id="updateProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật chương trình</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action="admin/program/update" enctype="multipart/form-data">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id-program" name="id_program">
                    </div>
                    <div class="form-group">
                        <label for="name_program" class="col-form-label">Tên chương trình:</label>
                        <input type="text" class="form-control" id="name_program" name="name_program">
                    </div>
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select name="id_catalogue" id="id_catalogue" class="form-select"
                            aria-label="Default select example">
                            <?php foreach ($catalogues as $cata): ?>
                                <option value="<?= $cata['id_catalogue'] ?>"><?= $cata['name_catalogue'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input-choose-video">File chương trình (Lưu ý: Không vượt quá 200mb)</label>
                        <input name="video" id="link_progam" type="file" accept="video/*" class="form-control-file"
                            id="input-choose-video" size="200" value="">
                    </div>
                    <video width="320" height="240" id="video" controls>
                        <source src="" type="video/mp4">
                    </video>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary text-light" data-dismiss="modal">Đóng</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>