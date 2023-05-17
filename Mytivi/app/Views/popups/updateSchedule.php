<div class="modal fade" id="updateScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật lịch chiếu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action="admin/schedule/update">
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="id-schedule" name="id_schedule">
                    </div>
                    <div class="form-group">
                        <label>Chương trình</label>
                        <select name="id_program" id="id_program" class="form-select"
                            aria-label="Default select example">
                            <?php foreach ($programs as $program): ?>
                                <option value="<?= $program['id_program'] ?>"><?= $program['name_program'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kênh</label>
                        <select name="priority" id="priority" class="form-select" aria-label="Default select example">
                            <option value='1'>Kênh 1</option>
                            <option value='2'>Kênh 2</option>
                            <option value='3'>Kênh 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thời gian bắt đầu</label>
                        <input name="time_start" id="time_start" type="time" class="form-control" placeholder="Thời gian bắt đầu"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Thời gian kết thúc</label>
                        <input name="time_end" id="time_end" type="time" class="form-control" placeholder="Thời gian bắt đầu"
                            required>
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