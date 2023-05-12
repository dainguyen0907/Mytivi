<main class="dash-content">
    <div class="container-fluid">
        <h1 class="dash-title">Thêm chương trình mới</h1>
        <div class="row">
            <div class="col-xl-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="easion-card-title"> Thông tin chương trình</div>
                    </div>
                    <div class="card-body ">
                        <?= view('message/message');?>
                        <form action="admin/program/create" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tên chương trình</label>
                                    <input name="name_program" type="text" class="form-control"
                                        placeholder="Nhập tên chương trình" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Thể loại</label>
                                    <select name="id_catalogue"class="form-select" aria-label="Default select example">
                                        <?php foreach($catalogues as $cata):?>
                                        <option value="<?= $cata['id_catalogue']?>"><?= $cata['name_catalogue']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="input-choose-video">File chương trình (Lưu ý: Không vượt quá 200mb)</label>
                                <input name="video" type="file" accept="video/*" class="form-control-file"
                                    id="input-choose-video" required size="200">
                            </div>
                            <button type="submit" class="btn btn-success">Đăng ký</button>
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>