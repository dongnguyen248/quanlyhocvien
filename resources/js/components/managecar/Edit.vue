<template>
<form @submit.prevent="createCar">
    <div class="tab-content py-3" id="myTabContent">
        <table class="table">
            <tr>
                <th>Tên xe</th>
                <td>
                    <input type="text" class="form-control" v-model="car.namecar" placeholder="Tên xe" />
                </td>
            </tr>
            <tr>
                <th>Trung Tâm</th>
                <td>
                    <input type="text" class="form-control" v-model="car.Center" placeholder="Tên trung tâm" />
                </td>
            </tr>
            <tr>
                <th>Hạng Xe</th>
                <td>
                    <input type="text" class="form-control" v-model="car.LevelCar" placeholder="Xe hạng nào " />
                </td>
            </tr>

            <tr>
                <th>Ngày Cấp</th>
                <td>
                    <Datepicker :typeable="true" :format="starttime" class="form-control inputdate" v-model="car.startdate" placeholder="Ngày cấp"></Datepicker>
                </td>
            </tr>
            <tr>
                <th>Ngày Hết Hạn</th>
                <td>
                    <Datepicker :typeable="true" :format="endtime" class="form-control inputdate" v-model="car.endDate" placeholder="Ngày hết hạn"></Datepicker>
                </td>
            </tr>
             <tr>
                <th>Bảo Hiểm</th>
                <td>
                    <Datepicker :typeable="true" :format="baohiem" class="form-control inputdate" v-model="car.baohiem" placeholder="Ngày hết hạn bảo hiểm"></Datepicker>
                </td>
            </tr>
            <tr>
                <th>Ghi Chú</th>
                <td>
                    <input type="text" class="form-control" v-model="car.note" placeholder="ghi chú " />
                </td>
            </tr>
        </table>
    </div>

    <div class="row justify-content-md-center">
        <div class="footer col-6">
            <router-link to="/cars" class="btn btn-secondary">Cancel</router-link>
            <input type="submit" value="Create" class="btn btn-primary" />
        </div>
    </div>
</form>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            car: {
                namecar: '',
                Center: '',
                LevelCar: '',
                startdate: '',
                endDate: '',
                baohiem: '',
                note: ''
            },
            form: new FormData()

        }
    },
    created() {
        axios.get(`/api/cars/${this.$route.params.id}`)
            .then((response) => {
                this.car = response.data.car;
            });
    },
    methods: {
        starttime(date) {
            return this.car.starttime = moment(date).format('YYYY-MM-DD');
        },
        endtime(date) {
            return this.car.endtime = moment(date).format('YYYY-MM-DD');
        },
        baohiem(date) {
            return this.car.baohiem = moment(date).format('YYYY-MM-DD');
        },
        async createCar() {
            this.form.append('namecar', this.car.namecar);
            this.form.append('center', this.car.Center);
            this.form.append('levelcar', this.car.LevelCar);
            this.form.append('starttime', this.car.startdate);
            this.form.append('endtime', this.car.endDate);
            this.form.append('baohiem', this.car.baohiem);
            this.form.append('note', this.car.note);
            const res = await this.callApi('post', `/api/cars/edit/${this.$route.params.id}`, this.form);
            if (res.status === 200) {
                this.$router.push("/cars");
                this.s('Sửa Thành Công')
            }
            if (res.status === 300) {
                this.e(res.data.mesg);
            }

        },
    }
}
</script>
