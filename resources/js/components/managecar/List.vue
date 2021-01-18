<template>
<div class="card-body">
    <div class="btn-wrapper mb-3">
        <router-link to="/cars/new" class="btn btn-primary btn-sm">Thêm Xe</router-link>
    </div>

    <div class="projects">
        <div class="tableFilters">
            <input class="input form-control" type="text" v-model="tableData.search" placeholder="Tìm xe" @input="getCars()">

            <div class="control">
                <div class="select">
                    <select class="form-control" v-model="tableData.length" @change="getCars()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                    </select>
                </div>
            </div>

        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody class="text-center tablecar">
                <tr v-for="car in cars" :key="car.id" v-bind:class="(getremainTime(car.endDate) <10)?'choose-class':'esle-class'">
                    <td>{{car.namecar}}</td>
                    <td>{{car.Center}}</td>
                    <td>{{car.LevelCar}}</td>
                    <td>{{car.startdate}}</td>
                    <td>{{car.endDate}}</td>
                    <td>
                        {{getremainTime(car.endDate) + ' ngày'}}
                    </td>
                    <td v-if="car.baohiem !== 'null'" v-bind:class="(getremainTime(car.baohiem) <10)?'choose-class':'esle-class'">{{ 'Bảo hiểm còn ' + getremainTime(car.baohiem) +' .Ngày đóng '+ car.baohiem }}</td>
                    <td v-else></td>
                    <td>{{car.note}}</td>
                    <td v-if=" getremainTime(car.endDate) <10"> <i class="fas fa-times-circle"></i></td>
                    <td v-else><i class="fas fa-check-circle"></i> </td>
                    <td>
                        <router-link :to="`/cars/edit/${car.id}`" class="btn btn-primary"><i class="fas fa-edit"></i></router-link>
                        <a @click.prevent="deleteCar(car.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination" @prev="getCars(pagination.prevPageUrl)" @next="getCars(pagination.nextPageUrl)">
        </pagination>
    </div>
</div>
</template>

<script>
import Datatable from '../datatable/Datatable';
import Pagination from '../datatable/Pagination';
import moment from 'moment';
import $ from 'jquery';
export default {
    name: "CarManager",
    components: {
        datatable: Datatable,
        pagination: Pagination
    },

    data() {
        let sortOrders = {};

        let columns = [{
                label: 'Số Xe',
                name: 'namecar'
            },
            {
                label: 'Trung Tâm',
                name: 'Center'
            },
            {
                label: 'Hạng Xe',
                name: 'LevelCar'
            },
            {
                label: 'Ngày Cấp',
                name: 'startdate'
            },
            {
                label: 'Ngày Hết Hạn',
                name: 'enddate'
            },
            {
                label: 'Hạn Còn lại ',
                name: 'dateremain'
            },
            {
                label: 'Bảo Hiểm ',
                name: 'baohiem'
            },
            {
                label: 'Note',
                name: 'note'
            },
            {
                label: 'Trạng Thái',
                name: 'status'
            },

            {
                label: 'Action',
                // name: 'status'
            }
        ];

        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            cars: [],
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
        deleteCar(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("api/cars/delete/" + id)
                        .then(response => {
                            Swal.fire("Deleted!", "User has been deleted.", "success");
                            this.getCars();
                        })
                        .catch(() => {
                            Swal.fire("Failed!", "There was something wronge.", "warning");
                        });
                }
            });

        },
        getremainTime(endtime) {
            var CurrentDate = new Date();
            endtime = new Date(endtime);
            let diffTime = Math.abs(endtime - CurrentDate);
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays;
        },
        getCars(url = '/api/cars') {
            this.tableData.draw++;
            axios.get(url, {
                    params: this.tableData,
                })
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.cars = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
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
            this.getCars();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
    mounted() {
        this.getCars();
    }
};
</script>

<style scoped>
.esle-class {
    color: #007bff;
}

.choose-class {
    color: #ffff;
    background: #dc3545;
}
</style>
