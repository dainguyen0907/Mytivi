<main class="dash-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="easion-card-title">Danh sách chương trình</div>
                </div>
                <div class="card-body ">
                    <?= view ('message/message')?>
                    <table id="datatable" class="cell-border">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tên chương trình</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Đường dẫn</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programs as $program): ?>
                                <tr>
                                    <td>
                                        <?= $program["id_program"] ?>
                                    </td>
                                    <td>
                                        <?= $program["name_program"] ?>
                                    </td>
                                    <td>
                                        <?= $program["name_catalogue"] ?>
                                    </td>
                                    <td>
                                        <?= $program["link_program"] ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="comment-edit.html" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a data-url="" class="btn btn-danger btn-del-confirm text-light" data-toggle="modal" data-target="#deleteProgramModal" data-idprogram="<?= $program["id_program"] ?>"]><i
                                                class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?= view('popups/deleteProgram')?>