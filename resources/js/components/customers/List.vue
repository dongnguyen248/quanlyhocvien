<template>
<div>
    <div class="btn-wrapper">
        <router-link to="/customers/new" class="btn btn-primary btn-sm">Thêm Học Viên</router-link>
    </div>

    <div class="projects">
        <div class="tableFilters">
            <input class="input form-control" type="text" v-model="tableData.search" placeholder="Search học viên" @input="getCustomers()">

            <div class="control">
                <div class="select">
                    <select class="form-control" v-model="tableData.length" @change="getCustomers()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                    </select>
                </div>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{customer.name}}</td>
                    <td>{{customer.CodeCustomer}}</td>
                    <td>{{customer.phone}}</td>
                    <td class="text-center">
                        <router-link :to="`/customers/${customer.id}`" class="btn btn-info">Xem thông tin học viên</router-link>
                        <span v-if="currentUser.name === customer.createdBy">
                            <router-link :to="`/customers/edit/${customer.id}`" class="btn btn-primary">Sửa thông tin học viên</router-link>
                        </span>
                    </td>

                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination" @prev="getCustomers(pagination.prevPageUrl)" @next="getCustomers(pagination.nextPageUrl)">
        </pagination>
    </div>
</div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';
export default {
    name: "CustomersList",

    components: {
        datatable: Datatable,
        pagination: Pagination
    },
    created() {
        this.getCustomers();
    },
    data() {
        let sortOrders = {};

        let columns = [{
                // width: '33%',
                label: 'Name',
                name: 'name'
            },
            {
                // width: '33%',
                label: 'Khóa Học',
                name: 'CodeCustomer'
            },
            {
                // width: '33%',
                label: 'Số điện thoại',
                name: 'phone'
            },
            {
                label: 'Action',
                //  name: 'Action'
            }
        ];

        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            customers: [],
            columns: columns,
            sortKey: 'deadline',
            sortOrders: sortOrders,
            perPage: ['10', '20', '30'],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },

    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        },

    },
    methods: {
        getCustomers(url = '/api/customers') {
            this.tableData.draw++;
            axios.get(url, {
                    params: this.tableData,
                })
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.customers = data.data.data;
                        // console.log(this.customers);
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            console.log(data);
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getCustomers();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
    mounted() {
        this.getCustomers();
    }

};
</script>

<style scoped>
thead>tr{
  background-color:  #26a96a;
}
.sorting{
    text-align: center;
}
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}

.searchhv {
    float: left;
    width: 250px;
}
</style>
