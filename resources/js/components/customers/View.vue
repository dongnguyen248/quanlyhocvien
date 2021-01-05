<template>
<div class="customer-view" v-if="customer">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('info')" :class="{ active: isActive('info') }" href="#info">Thông tin học viên</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('money')" :class="{ active: isActive('money') }" href="#money">Lịch sử nộp học phí</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click.prevent="setActive('need')" :class="{ active: isActive('need') }" href="#need">Trạng Thái Học Viên</a>
        </li>
    </ul>
    <div class="tab-content py-3" id="myTabContent">
        <div class="tab-pane fade" :class="{ 'active show': isActive('info') }" id="info">
            <div class="user-img">
                <img v-bind:src="'../public/uploads/' + customer.photo" alt="Photo" />
            </div>
            <div class="user-info">
                <table class="table">
                    <tr>
                        <th>Khóa Học</th>
                        <td>{{ customer.CodeCustomer }}</td>
                    </tr>
                    <tr>
                        <th>Tên Học Viên</th>
                        <td>{{ customer.name }}</td>
                    </tr>
                    <tr>
                        <th>Ngày Sinh</th>
                        <td>{{ customer.birthday }}</td>
                    </tr>
                    <tr>
                        <th>Số điện Thoại</th>
                        <td>{{ customer.phone }}</td>
                    </tr>
                    <tr>
                        <th>Số Chứng Minh</th>
                        <td>{{ customer.email }}</td>
                    </tr>
                    <tr>
                        <th>Loại Bằng</th>
                        <td>{{ customer.Type }}</td>
                    </tr>
                    <tr>
                        <th>Dự Kiến Thi</th>
                        <td>{{ customer.dukienthi }}</td>
                    </tr>
                    <tr>
                        <th>Trường Thi</th>
                        <td>{{ customer.school }}</td>
                    </tr>
                    <tr>
                        <th>Thầy Phụ Trách</th>
                        <td>{{ customer.Facebook }}</td>
                    </tr>

                    <tr>
                        <th>Địa Chỉ</th>
                        <td>{{ customer.address }}</td>
                    </tr>
                    <tr>
                        <th>Khu Vực</th>
                        <td>{{ customer.location }}</td>
                    </tr>
                    <tr>
                        <th>Người Tạo</th>
                        <td>{{ customer.createdBy }}</td>
                    </tr>
                    <tr>
                        <th>Ngày Tạo</th>
                        <td>{{ customer.created_at}}</td>
                    </tr>
                </table>
                <router-link to="/customers">Back to all Customers</router-link>
            </div>
        </div>
        <div class="tab-pane fade" :class="{ 'active show': isActive('money') }" id="money">
            <table class="table">
                <tr>
                    <th>Học phí lần 1</th>
                    <td>{{ customer.first }}</td>

                </tr>
                <tr>
                    <th>Ngày đóng lần 1</th>

                    <td>{{ customer.datefirst }}</td>

                </tr>
                <tr>
                    <th>Học phí lần 2</th>
                    <td>{{ customer.second }}</td>
                </tr>
                <tr>
                    <th>Ngày đóng lần 2</th>
                    <td>{{ customer.datesecond }}</td>
                </tr>
                <tr>
                    <th>Học phí lần 3</th>
                    <td>{{ customer.moneythird }}</td>
                </tr>
                <tr>
                    <th>Ngày đóng lần 3</th>
                    <td>{{ customer.datethird }}</td>
                </tr>
                <tr>
                    <th> Đóng phí lần 4</th>
                    <td>{{ customer.moneyfour }}</td>
                </tr>
                <tr>
                    <th>Ngày đóng lần 4</th>
                    <td>{{ customer.datefour }}</td>
                </tr>
                <tr>
                    <th>Tiền sức khỏe</th>
                    <td class="text-center">
                        {{customer.healthyMoney}}
                    </td>
                </tr>
                <tr>
                    <th>Ngày đóng tiền sức khỏe</th>
                    <td class="text-center">
                        {{customer.dayhealth}}
                    </td>
                </tr>

            </table>
        </div>
        <div class="tab-pane fade" :class="{ 'active show': isActive('need') }" id="need">
           <p>Học Phí Cần thanh toán: {{customer.needMoney}}</p>
           <p>Trạng thái thi cử : {{customer.statusExam}}</p>
        </div>

    </div>

</div>
</template>

<script>
import datepicker from 'vuejs-datepicker';
import moment, {
    months
} from 'moment';
export default {
    name: "View-customer",
    components: {
        datepicker
    },
    data() {
        return {
            customer: null,
            activeItem: 'info',

        };
    },
    created() {
        if (this.customers.length) {
            this.customer = this.customers.find(
                (customer) => customer.id == this.$route.params.id
            );
        } else {
            axios
                .get(`../api/customers/${this.$route.params.id}`)
                .then((response) => {
                    this.customer = response.data.customer;
                });
        }

    },
    computed: {
        customers() {
            return this.$store.getters.customers;
        },
        currentUser() {
            return this.$store.getters.currentUser;
        },

    },
    mounted() {
        this.getHistoryMoney();
    },
    methods: {
        async getHistoryMoney() {
            const res = this.callApi('get', '../history');
            if (res == 200) {
                console.log(res);
                this.money = res.data;
            }
        },

        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        },

    }

};
</script>

<style scoped>
.notyet {
    color: red;
}

.yes {
    color: #3490dc;
}

.customer-view {
    /* display: flex; */
    align-items: center;
}

.user-img {
    float: left;
}

.user-img img {
    max-width: 160px;
}

.user-info {
    float: right;
}
</style>
