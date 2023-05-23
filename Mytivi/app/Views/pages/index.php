<main class="dash-content">
    <div class="container-fluid">
        
        <div class="row dash-row">
            <div class="col-xl-6">
                <div class="stats stats-primary">
                    <h3 class="stats-title"> Tổng số tài khoản </h3>
                    <div class="stats-content">
                        <div class="stats-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="stats-data">
                            <div class="stats-number"><?= $countUser ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="stats stats-success ">
                    <h3 class="stats-title"> Tổng số chương trình </h3>
                    <div class="stats-content">
                        <div class="stats-icon">
                            <i class="far fa-share-square"></i>
                        </div>
                        <div class="stats-data">
                            <div class="stats-number"><?= $countProgram ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="stats stats-warning">
                    <h3 class="stats-title"> Tổng số kênh</h3>
                    <div class="stats-content">
                        <div class="stats-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="stats-data">
                            <div class="stats-number">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>