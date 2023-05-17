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
                    <?= view('message/message') ?>
                    <table id="datatable" class="cell-border">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tên chương trình</th>
                                <th scope="col">Thời gian phát</th>
                                <th scope="col">Thời gian kết thúc</th>
                                <th scope="col">Kênh</th>
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
                                        <a href="comment-edit.html" class="btn btn-primary" data-toggle="modal" 
                                        data-target="#updateScheduleModal"
                                        data-idschedule="<?= $schedule['id_schedule']?>"
                                        data-idprogram="<?= $schedule['id_program']?>"
                                        data-timestart="<?= $schedule['time_start']?>"
                                        data-timeend="<?= $schedule['time_end']?>"
                                        data-priority="<?= $schedule['priority']?>"><i class="fas fa-edit"></i></a>
                                        <a data-url="" class="btn btn-danger btn-del-confirm text-light" data-toggle="modal" 
                                        data-target="#deleteScheduleModal" data-idschedule="<?= $schedule['id_schedule']?>"><i
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
<?= view('popups/updateSchedule')?>
<?= view('popups/deleteSchedule')?>