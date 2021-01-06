<template>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-header text-center">Tổng Hợp Học Viên</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{countcustomers}}</h3>

                                <p>Danh Sách Học Viên</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <router-link to="/customers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{successfull}}</h3>

                                <p>Học Viên Thi Đậu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-check"></i>

                            </div>
                            <router-link to="/customers/hocvienthidau" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{failTheory}}</h3>

                                <p>Học Viên Thi Rớt Lý Thuyết</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-times"></i>

                            </div>
                            <router-link to="/customers/hocvienrot" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{failPractice}}</h3>

                                <p>Học Viên Thi Rớt Thực Hành</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-times"></i>

                            </div>
                            <router-link to="/customers/hocvienrot" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Học Viên Hoàn Thành Học Phí</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <router-link to="/customers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>53</h3>

                                <p>Học Viên Nợ Học Phí</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <router-link to="/customers/hocvienthidau" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Home",

    data() {
        return {
            countcustomers: 0,
            successfull: 0
        }
    },
    methods: {
        getAllCustomers() {
            axios.get('api/customers/all').then(response => {
                this.countcustomers = response.data.customer.length;
                this.successfull = response.data.hocviendau.length;
                this.failTheory = response.data.rotlythuyet.length;
                this.failPractice = response.data.rotthuchanh.length;
            })
        }
    },
    mounted() {
        this.getAllCustomers();
    },

};
</script>
