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
                    <input type="text" class="form-control" v-model="car.center" placeholder="Tên trung tâm" />
                </td>
            </tr>
            <tr>
                <th>Hạng Xe</th>
                <td>
                    <input type="text" class="form-control" v-model="car.levelcar" placeholder="Xe hạng nào " />
                </td>
            </tr>

            <tr>
                <th>Ngày Cấp</th>
                <td>
                    <Datepicker :typeable="true" :format="starttime" class="form-control inputdate" v-model="car.starttime" placeholder="Ngày cấp"></Datepicker>
                </td>
            </tr>
            <tr>
                <th>Ngày Hết Hạn</th>
                <td>
                    <Datepicker :typeable="true" :format="endtime" class="form-control inputdate" v-model="car.endtime" placeholder="Ngày hết hạn"></Datepicker>
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
                center: '',
                levelcar: '',
                starttime: '',
                endtime: ''
            },
            form: new FormData()

        }
    },
    methods: {
        starttime(date) {
            return this.car.starttime = moment(date).format('YYYY-MM-DD');
        },
        endtime(date) {
            return this.car.endtime = moment(date).format('YYYY-MM-DD');
        },
        async createCar() {
            this.form.append('namecar', this.car.namecar);
            this.form.append('center', this.car.center);
            this.form.append('levelcar', this.car.levelcar);
            this.form.append('starttime', this.car.starttime);
            this.form.append('endtime', this.car.endtime);

            const res = await this.callApi('post', '/api/cars/new', this.form);

            if (res.status === 200) {
                this.$router.push("/cars");
                this.s('Tạo Xe Thành Công');
                this.car.namecar = '';
                this.car.center = '';
                this.car.levelcar = '';
                this.car.starttime = '';
                this.car.endtime = '';
            }
            if (res.status === 300) {
                // console.log(res.data.mesg);
                this.e(res.data.mesg);
            }

        },
    }
}
</script>
