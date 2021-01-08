<template>
<div customer-new>
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('addinfo')" :class="{ active: isActive('addinfo') }" href="#addinfo">Thông tin học viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('addmoney')" :class="{ active: isActive('addmoney') }" href="#addmoney">Lịch sử nộp học phí</a>
        </li>

    </ul>

    <form @submit.prevent="add">
        <div class="tab-content py-3" id="myTabContent">
            <div class="tab-pane fade" :class="{ 'active show': isActive('addinfo') }" id="addinfo">
                <table class="table">
                    <tr>
                        <th>Khóa Học</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.CodeCustomer" placeholder="Khóa Học" />
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
                            <Datepicker :typeable="true" :format="customeDate" class="form-control inputdate" v-model="customer.birthday" placeholder="Nhập ngày tháng năm sinh"></Datepicker>
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
                            <Datepicker :typeable="true" :format="datedukien" class="form-control inputdate" v-model="customer.dukienthi" placeholder="Ngày thi dự kiến"></Datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại</th>
                        <td>

                            <input type="text" class="form-control" v-model="customer.phone" placeholder="Số điện thoại học viên" />
                        </td>
                    </tr>
                    <tr>
                        <th>Chứng Minh Nhân Dân</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.email" placeholder="Nhập số chứng mình nhân dân học viên nếu có" />
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
                            <select class="form-control" v-model="customer.type">
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="C">C</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="customer.type" placeholder="Nhập loại bằng học viên đăng ký" /> -->
                        </td>
                    </tr>
                    <tr>
                        <th>Khu Vực Học</th>
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
                            <input type="text" class="form-control" v-model="customer.Facebook" placeholder="Thầy nào dạy" />
                        </td>
                    </tr>

                </table>
            </div>
            <div class="tab-pane fade" :class="{ 'active show': isActive('addmoney') }" id="addmoney">
                <table class="table fixtable">
                    <tr>
                        <th>Học phí lần 1</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.moneyfirst" placeholder="nhập học phí lần 1" />
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
                            <input type="text" class="form-control" v-model="customer.moneysecond" placeholder="nhập học phí lần 2" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đóng lần 2</th>
                        <td>
                            <datepicker :typeable="true" :format="dateformatsecond" class="form-control inputdate" v-model="customer.datesecond" placeholder="Ngày đóng học phí lần 2"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th>Học phí lần 3</th>
                        <td>
                            <input type="text" class="form-control inputdate" v-model="customer.moneythird" placeholder="nhập học phí lần 3" />
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đóng lần 3</th>
                        <td>
                            <datepicker :typeable="true" :format="dateformatthird" class="form-control inputdate" v-model="customer.atethird" placeholder="Ngày đóng học phí lần 3"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <th> Đóng phí lần 4</th>
                        <td>
                            <input v-model="customer.moneyfour" type="text" class="form-control" placeholder="nhập học phí lần 4" />
                        </td>

                    </tr>
                    <tr>
                        <th>Ngày đóng lần 4</th>
                        <td>
                            <datepicker :typeable="true" :format="dateformatfour" class="form-control inputdate" v-model="customer.datefour" placeholder="Ngày đóng học phí lần 4"></datepicker>
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
                            <datepicker :typeable="true" :format="dateformathealth" class="form-control inputdate" v-model="customer.dayhealth" placeholder="Ngày đóng tiền sức khỏe"></datepicker>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="row justify-content-md-center">
                <div class="footer col-6">
                    <router-link to="/customers" class="btn btn-secondary">Cancel</router-link>
                    <input type="submit" value="Create" class="btn btn-primary" />
                </div>
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
    name: "New",

    components: {
        Datepicker
    },
    data() {
        return {
            activeItem: 'addinfo',

            customer: {
                CodeCustomer: "",
                name: "",
                birthday: "",
                dukienthi: "",
                email: "",
                phone: "",
                address: "",
                location: "",
                Owner: "",
                Facebook: "",
                createdBy: "",
                image: "",
                photo: "",
                school: "",
                type: "",
                moneyfirst: 0,
                moneysecond: 0,
                moneythird: 0,
                moneyfour: 0,
                dayhealth: '',
                datefirst: '',
                datesecond: '',
                datethird: '',
                datefour: '',
                healthyMoney:''
            },
            createdBy: "",
            errors: null,
            form: new FormData()
        };
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        },
    },
    methods: {
        dateformathealth(date){
            this.customer.dayhealth = moment(date).format('YYYY-MM-DD');
            return this.customer.dayhealth;
        },
        dateformatfirst(date) {
            this.customer.datefirst = moment(date).format('YYYY-MM-DD');
            return this.customer.datefirst.reverse();
        },
        dateformatsecond(date) {
            this.customer.datesecond = moment(date).format('YYYY-MM-DD');
            return this.customer.datesecond;
        },
        dateformatthird(date) {
            this.customer.datethird = moment(date).format('YYYY-MM-DD');
            return this.customer.datethird;
        },
        dateformatfour(date) {
            this.customer.datefour = moment(date).format('YYYY-MM-DD');
            return this.customer.datefour;
        },
        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        },
        datedukien(date) {
            this.customer.dukienthi = moment(date).format('YYYY-MM-DD');
            return this.customer.dukienthi;
        },
        customeDate(date) {
            this.customer.birthday = moment(date).format('YYYY-MM-DD');
            return this.customer.birthday;
        },
        chooseFile(event) {
            this.customer.image = event.target.files[0];
            let filename = event.target.files[0].name;
            if (!filename.match(/.(jpg|jpeg|png|gif)$/i))
                return this.e("This file is not iamge please choose image file");
            this.customer.photo = filename;

        },
        async add() {
           
            this.form.append('CodeCustomer', this.customer.CodeCustomer);
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
            this.form.append('type', this.customer.type);
            this.form.append('first', this.customer.moneyfirst);
            this.form.append('second', this.customer.moneysecond);
            this.form.append('third', this.customer.moneythird);
            this.form.append('four', this.customer.moneyfour);
            this.form.append('dayhealth', this.customer.dayhealth);
            this.form.append('healthyMoney', this.customer.healthyMoney);
            this.form.append('firstday', this.customer.datefirst);
            this.form.append('secondday', this.customer.datesecond);
            this.form.append('thirddday', this.customer.datethird);
            this.form.append('fourday', this.customer.datefour);
            
            if (this.customer.name == '') return this.i('Bạn cần nhập tên học viên !');
            if (this.customer.birthday == '') return this.i('Bạn cần nhập ngày sinh!');
            if (this.customer.phone == '') return this.i('Bạn cần nhập số điện thoại !');
            if (this.customer.address == '') return this.i('Bạn cần nhập số  địa chỉ !');
            if (this.customer.Owner == '') return this.i('Bạn cần nhập học viên của trung tâm nào !');
            if (this.customer.type == '') return this.i('Bạn cần nhập loại bằng học viên đăng ký !');
            this.errors = null;
            const constraints = this.getConstraints();
            const errors = validate(this.$data.customer, constraints);
            if (errors) {
                this.errors = errors;
                return;
            }
            const res = await this.callApi('post', '/api/customers/new', this.form);

            if (res.status === 200) {
                this.$router.push("/customers");
                this.s('Tạo Học Viên Thanh Công');
                this.customer.CodeCustomer = '';
                this.customer.name = '';
                this.customer.birthday = '';
                this.customer.dukeinthi = '';
                this.customer.photo = '';
                this.customer.phone = '';
                this.customer.email = '';
                this.customer.address = '';
                this.customer.location = '';
                this.customer.Owner = '';
                this.customer.Facebook = '';
                this.customer.image = '';
                this.customer.school = '';
            }
            if (res.status === 300) {
                // console.log(res.data.mesg);
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


.footer {
  
    text-align: center;
    display: flex;
    justify-content: space-between;
} 

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
