import Home from "./components/Home.vue";
import Login from "./components/auth/Login.vue";
import CustomersMain from "./components/customers/Main.vue";
import CustomerList from "./components/customers/List.vue";
import NewCustomer from "./components/customers/New.vue";
import Customer from "./components/customers/View.vue";
import Edit from "./components/customers/Edit.vue";
import Register from "./components/auth/Register.vue";
import CarManager from "./components/managecar/CarManage.vue";
import CarsList from "./components/managecar/List.vue";
import EditCar from "./components/managecar/Edit.vue";
import NewCar from "./components/managecar/New.vue";


const routes = [{
        path: "/",
        component: Home,    
        meta: {
            requiresAuth: true //the route need authen -> need add meta
        },
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/register",
        component: Register
    },
    {
        path: "/cars",
        component: CarManager,
        meta: {
            requiresAuth: true //the route need authen -> need add meta
        },
        children: [{
            path: "/",
            component: CarsList
        },
        {
            path: "new",
            component: NewCar
        },     
        {
            path: "edit/:id",
            component: EditCar
        },
    ]
    },
    {
        path: "/customers",
        component: CustomersMain,
        meta: {
            requiresAuth: true //the route need authen -> need add meta
        },
        children: [{
                path: "/",
                component: CustomerList
            },
            {
                path: "new",
                component: NewCustomer
            },
            {
                path: ":id",
                component: Customer
            },      
            {
                path: "edit/:id",
                component: Edit
            },
        ]
    }
];
export { routes };