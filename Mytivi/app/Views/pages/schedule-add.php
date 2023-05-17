<main class="dash-content">
    <div class="container-fluid">
        <h1 class="dash-title">Thêm lịch chiếu mới</h1>
        <div class="row">
            <div class="col-xl-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="easion-card-title"> Thông tin lịch chiếu</div>
                    </div>
                    <div class="card-body ">
                        <?= view('message/message')?>
                        <form action="admin/schedule/create" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Chương trình</label>
                                    <select name="id_program" class="form-select" aria-label="Default select example">
                                        <?php foreach ($programs as $program): ?>
                                            <option value='<?=$program['id_program']?>'><?=$program['name_program']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kênh</label>
                                    <select name="priority" class="form-select" aria-label="Default select example">
                                        <option value='1'>Kênh 1</option>
                                        <option value='2'>Kênh 2</option>
                                        <option value='3'>Kênh 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Thời gian bắt đầu</label>
                                    <input name="time_start" type="time" class="form-control"
                                        placeholder="Thời gian bắt đầu" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Thời gian kết thúc</label>
                                    <input name="time_end" type="time" class="form-control"
                                        placeholder="Thời gian kết thúc" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Tạo mới</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>