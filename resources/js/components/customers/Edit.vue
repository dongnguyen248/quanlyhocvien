<template>
<div customer-new>
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('editinfo')" :class="{ active: isActive('editinfo') }" href="#editinfo">Thông tin học viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('editmoney')" :class="{ active: isActive('editmoney') }" href="#editmoney">Lịch sử nộp học phí</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('need')" :class="{ active: isActive('need') }" href="#need">Trạng Thái Học Viên</a>
        </li>
    </ul>

    <form @submit.prevent="EditCustomer">
        <div class="tab-content py-3" id="myTabContent">
            <div class="tab-pane fade" :class="{ 'active show': isActive('editinfo') }" id="editinfo">
                <table class="table">
                    <tr>
                        <th>Khóa Học</th>
                        <td>
                            <input type="text" class="form-control" readonly v-model="customer.CodeCustomer" placeholder="Mã Học Viên" />
                        </td>
                    </tr>
                    <tr>
                        <th>Tên Học Viên</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.name" placeholder="Tên Học Viên" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày Sinh</th>
                        <td>
                            <Datepicker :format="customeDate" class="form-control inputdate" v-model="customer.birthday" placeholder="Nhập ngày tháng năm sinh"></Datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Ảnh Học viên</th>
                        <td>
                            <input type="file" hidden id="picture" class="form-control" @change="chooseFile" accept="image/*" placeholder="Ảnh học viên nếu có " />
                            <label for="picture" class="form-control">{{customer.photo}}</label>

                        </td>
                    </tr>
                    <tr>
                        <th>Trường khai giảng</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.school" placeholder="Trường học viên khai giảng " />
                        </td>
                    </tr>
                    <tr>
                        <th>Dự Kiến Thi</th>
                        <td>
                            <Datepicker :format="datedukien" class="form-control inputdate" v-model="customer.dukienthi" placeholder="Ngày thi dự kiến"></Datepicker>

                        </td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại</th>
                        <td>

                            <input type="text" class="form-control" v-model="customer.phone" placeholder="Số điện thoại học viên" />
                        </td>
                    </tr>
                    <tr>
                        <th>Số Chứng Minh Nhân Dân</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.email" placeholder="Nhập chứng minh của học viên nếu có" />
                        </td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.address" placeholder="Địa chỉ học viên" />
                        </td>
                    </tr>
                    <tr>
                        <th>Loại Bằng</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.Type" placeholder="Nhập loại bằng học viên đăng ký" />
                        </td>
                    </tr>
                    <tr>
                        <th>Khu Vực</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.location" placeholder="Khu vực học" />
                        </td>
                    </tr>

                    <tr>
                        <th>Trung Tâm Đăng Ký</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.Owner" placeholder="Học viên nhà hay của trung tâm khác" />
                        </td>
                    </tr>

                    <tr>
                        <th>Thầy Phụ Trách</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.Facebook" placeholder="Tên facebook học viên nếu có" />
                        </td>
                    </tr>

                </table>
            </div>
            <div class="tab-pane fade" :class="{ 'active show': isActive('editmoney') }" id="editmoney">
                <table class="table fixtable">
                    <tr>
                        <th>Học phí lần 1</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.first" placeholder="nhập học phí lần 1" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đóng lần 1</th>
                        <td>
                            <datepicker :format="dateformatfirst" class="form-control inputdate" v-model="customer.datefirst" placeholder="Ngày đóng học phí lần 1"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Học phí lần 2</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.second" placeholder="nhập học phí lần 2" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đóng lần 2</th>
                        <td>
                            <datepicker :format="dateformatsecond" class="form-control inputdate" v-model="customer.datesecond" placeholder="Ngày đóng học phí lần 2"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Học phí lần 3</th>
                        <td>
                            <input type="text" class="form-control inputdate" v-model="customer.third" placeholder="nhập học phí lần 3" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đóng lần 3</th>
                        <td>
                            <datepicker :format="dateformatthird" class="form-control inputdate" v-model="customer.datethird" placeholder="Ngày đóng học phí lần 3"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th> Đóng phí lần 4</th>
                        <td>
                            <input v-model="customer.fourth" type="text" class="form-control" placeholder="nhập học phí lần 4" />
                        </td>

                    </tr>
                    <tr>
                        <th>Ngày đóng lần 4</th>
                        <td>
                            <datepicker :format="dateformatfour" class="form-control inputdate" v-model="customer.datefour" placeholder="Ngày đóng học phí lần 4"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Tiền sức khỏe</th>
                        <td>
                            <input v-model="customer.healthyMoney" type="text" class="form-control" placeholder="nhập tiền đóng sức khỏe" />
                        </td>

                    </tr>
                    <tr>
                        <th> Ngày đóng tiền sức khỏe</th>
                        <td>
                            <datepicker :format="dateformathealth" class="form-control inputdate" v-model="customer.dayhealth" placeholder="Ngày đóng tiền sức khỏe"></datepicker>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="tab-pane fade" :class="{ 'active show': isActive('need') }" id="need">
                <table class="table">
                    <tr>
                        <th>Tổng Học Phí</th>
                        <td>
                            <input type="text" class="form-control"  v-model="customer.totalMoney" placeholder="Tổng học phí cần đóng" />
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng Thái Thi Cử</th>
                        <td>
                           <select class="form-control" v-model="customer.statusExam">
                               <option value="Chưa thi" > Chưa thi</option>
                               <option value="Đậu" > Đậu</option>
                               <option value="Rớt lý thuyết" > Rớt lý thuyết</option>
                               <option value="Rớt thực hành" > Rớt thực hành</option>
                           </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="footer col-6">
                <router-link to="/customers" class="btn btn-secondary">Cancel</router-link>
                <input type="submit" value="Lưu" class="btn btn-primary" />
            </div>
        </div>
    </form>

    <div class="errors" v-if="errors">
        <ul>

            
            <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                <strong>{{ fieldName }}</strong> {{ fieldsError.join("\n") }}
            </li>
        </ul>
    </div>

</div>
</template>

<script>
import validate from "validate.js";
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {
    name: "Edit",

    components: {
        Datepicker
    },
    data() {
        return {
            
            activeItem: 'editinfo',
            customer: {
                name: "",
                birthday: "",
                dukienthi: "",
                email: "",
                phone: "",
                address: "",
                location: "",
                Owner: "",
                Facebook: "",
                image: "",
                photo: "",
                school: "",
                Type: "",
                first: 0,
                second: 0,
                third: 0,
                fourth: 0,
                healthyMoney: '',
                datefirst: "",
                datesecond: "",
                datethird: "",
                datefour: "",
                dayhealth: "",
                statusExam:'',
                totalMoney:'',
            },
            errors: null,
            form: new FormData(),
        };
    },
    created() {
        axios.get(`/../api/customers/${this.$route.params.id}`)
            .then((response) => {
                this.customer = response.data.customer;
            });
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        },
        customers() {

            return this.$store.getters.customers;
        },
    },
    methods: {
        dateformathealth(date) {
            this.customer.dayhealth = moment(date).format('L');
            return this.customer.dayhealth;
        },
        dateformatfirst(date) {
            this.customer.datefirst = moment(date).format('L');
            // console.log(this.datefirst);
            return this.customer.datefirst;
        },
        dateformatsecond(date) {
            this.customer.datesecond = moment(date).format('L');
            return this.customer.datesecond;
        },
        dateformatthird(date) {
            this.customer.datethird = moment(date).format('L');
            return this.customer.datethird;
        },
        dateformatfour(date) {
            this.customer.datefour = moment(date).format('L');
            return this.customer.datefour;
        },
        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        },
        datedukien(date) {
            this.customer.dukienthi = moment(date).format("L");
            return this.customer.dukienthi;
        },
        customeDate(date) {
            this.customer.birthday = moment(date).format("L");
            return this.customer.birthday;
        },
        chooseFile(event) {
            this.customer.image = event.target.files[0];
            let filename = event.target.files[0].name;
            if (!filename.match(/.(jpg|jpeg|png|gif)$/i))
                return this.e("This file is not iamge please choose image file");
            this.customer.photo = filename;

        },
        async EditCustomer() {
            this.form.append('name', this.customer.name);
            this.form.append('birthday', this.customer.birthday);
            this.form.append('dukienthi', this.customer.dukienthi);
            this.form.append('email', this.customer.email);
            this.form.append('phone', this.customer.phone);
            this.form.append('address', this.customer.address);
            this.form.append('location', this.customer.location);
            this.form.append('Owner', this.customer.Owner);
            this.form.append('Facebook', this.customer.Facebook);
            this.form.append('image', this.customer.image);
            this.form.append('school', this.customer.school);
            this.form.append('createBy', this.currentUser.name);
            this.form.append('type', this.customer.Type);
            this.form.append('first', this.customer.first);
            this.form.append('second', this.customer.second);
            this.form.append('third', this.customer.third);
            this.form.append('four', this.customer.fourth);
            this.form.append('dayhealth', this.customer.dayhealth);
            this.form.append('healthyMoney', this.customer.healthyMoney);
            this.form.append('firstday', this.customer.datefirst);
            this.form.append('secondday', this.customer.datesecond);
            this.form.append('thirddday', this.customer.datethird);
            this.form.append('fourday', this.customer.datefour);
            this.form.append('status', this.customer.statusExam);
            this.form.append('totalMoney', this.customer.totalMoney);
            // this.form.append('cannop', this.customer.cannop);
            // if (this.customer.CodeCustomer == '') return this.i(' Bạn cần nhập CodeCustomer !');
            if (this.customer.name == '') return this.i('Bạn cần nhập tên học viên !');
            if (this.customer.birthday == '') return this.i('Bạn cần nhập ngày sinh!');
            if (this.customer.phone == '') return this.i('Bạn cần nhập số điện thoại !');
            if (this.customer.address == '') return this.i('Bạn cần nhập số  địa chỉ !');
            if (this.customer.Owner == '') return this.i('Bạn cần nhập học viên của ai !');
            this.errors = null;
            const constraints = this.getConstraints();
            const errors = validate(this.$data.customer, constraints);
            if (errors) {
                this.errors = errors;
                return;
            }
            const res = await this.callApi('post', '/api/customers/edit/' + this.customer.id, this.form);

            if (res.status === 200) {
                this.$router.push("/customers");
                this.s('Sửa Học Viên Thanh Công');

            }
            if (res.status === 300) {
                console.log(res.data.mesg);
                this.e(res.data.mesg);
            }

        },
        getConstraints() {
            return {
                name: {
                    presence: true,
                    length: {
                        minimum: 4,
                        message: "Tên phải nhiều hơn 4 ký tự",
                    },
                },
                birthday: {
                    presence: true
                },
                phone: {
                    presence: true,
                    numericality: true,
                    length: {
                        minimum: 10,
                        message: "số điện thoại cần 10 số",
                    },
                },

            };
        },
    },
};
</script>

<style>
.errors {
    background: lightcoral;
    border-radius: 5px;
    padding: 21px 0 2px 0;
}

.vdp-datepicker div input {
    display: block;
    width: 100%;
    height: calc(1.6em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    position: relative;
    bottom: 7px;
    border-left: none !important;
    border-right: none !important;
}
</style>
