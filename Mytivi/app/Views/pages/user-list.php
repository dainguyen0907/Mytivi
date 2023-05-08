<main class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card easion-card">
                    <div class="card-header">
                        <div class="easion-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="easion-card-title">Danh sách tài khoản</div>
                    </div>
                    <div class="card-body ">
                        <table id="datatable" class="cell-border">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Tài khoản</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user):?>
                                <tr>
                                    <td><?= $user["user_id"]?></td>
                                    <td><?= $user["user_name"]?></td>
                                    <td><?= $user["user_email"]?></td>
                                    <td class="text-center">
                                        <a href="user-edit.html" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <?php if($user["user_id"]!=1)
                                        {
                                            echo '<a data-url="" class="btn btn-danger btn-del-confirm"><i
                                            class="far fa-trash-alt"></i></a>';
                                        }?>
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
