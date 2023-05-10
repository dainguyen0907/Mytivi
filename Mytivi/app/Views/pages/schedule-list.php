<main class="dash-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="easion-card-title">Lịch chiếu</div>
                </div>
                <div class="card-body ">
                    <table id="datatable" class="cell-border">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tên chương trình</th>
                                <th scope="col">Thời gian phát</th>
                                <th scope="col">Thời gian kết thúc</th>
                                <th scope="col">Độ ưu tiên</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr>
                                    <td>
                                        <?= $schedule['id_schedule'] ?>
                                    </td>
                                    <td>
                                        <?= $schedule['name_program'] ?>
                                    </td>
                                    <td>
                                        <?= $schedule['time_start'] ?>
                                    </td>
                                    <td>
                                        <?= $schedule['time_end'] ?>
                                    </td>
                                    <td>
                                        <?= $schedule['priority'] ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="comment-edit.html" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <a data-url="" class="btn btn-danger btn-del-confirm"><i
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