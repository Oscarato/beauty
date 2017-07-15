
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import axios from 'axios';
import numeral from "numeral"
import VueLocalStorage from 'vue-localstorage';

Vue.use(VueLocalStorage)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

Vue.filter("formatNumber", function (value) {
  return numeral(value).format("0,0"); 
});

var url = 'http://asociadosbe.com';
//var url = 'http://localhost:8000';
var token = Vue.localStorage.get('token');
token = token ? token:'';

const api = axios.create({
    baseURL: url,
    headers: {
        common: {
            'Accept': 'application/json',
            'content-type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': "Beauty "+token
        },
        post: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    },
    validateStatus: function(status) {
        return status < 500
    },
})

const app = new Vue({
    el: '#app',
    props: ['services'],
    data(){
        return {
            city: 0,
            images: 6,
            servicesData:[],
            selectedData:{},
            selectOrder:{},
            ordersData: [],
            discount_service : 0,
            value_service : 0,
            discount_service_edit : 0,
            value_service_edit : 0,
            email: '',
            password: '',
            messageLogin: ''
        }
    },
    methods:{
        setEditService(data){
            this.selectedData = Object.assign({}, data);
            this.discount_service_edit = data.discount
            this.value_service_edit = data.value
            return;
        },
        setEditOrder(data){
            console.log(data)
            this.selectOrder = Object.assign({}, data);
            return;
        },
        getServices(){
            api.get('api/services')
            .then(response => {
                // JSON responses are automatically parsed.
                var res = response.data
                if(res.response){
                    // JSON responses are automatically parsed.
                    this.servicesData = res.data
                }
            })
            .catch(e => {
                console.log(e)
            })
        },
        getOrders(){
            api.get('api/orders')
            .then(response => {
                var res = response.data
                if(res.response){
                    // JSON responses are automatically parsed.
                    this.ordersData = res.data
                }

            })
            .catch(e => {
                console.log(e)
            })
        },
        status_services(status){
            
            switch (status) {
                case 1:
                    status = 'active';
                    break;
                case 2:
                    status = 'danger';
                    break;
                default:
                    status = 'active';
                    break;
            }

            return status;
        },
        status_orders(status){
            switch (status) {
                case 1:
                    status = 'active';
                    break;
                case 2:
                    status = 'warning';
                    break;
                case 3:
                    status = 'danger';
                    break;
                case 4:
                    status = 'success';
                    break;
                default:
                    status = 'active';
                    break;
            }

            return status;
        },
        submit(e) {
            if(this.email =='' || this.password == ''){
                $("#sendLogin").submit()
            }else{
                api.post('api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    // JSON responses are automatically parsed.
                    var res = response.data
                    if(res.response){
                        Vue.localStorage.set('token', res.data.token);
                        this.messageLogin = res.message
                        $("#sendLogin").submit()
                    }else{
                        this.messageLogin = res.message
                        $("#sendLogin").submit()
                    }
                })
                .catch(e => {
                    console.log(e)
                })
                return;
            }

        },
        closeSe(e){
            e.preventDefault();
            Vue.localStorage.remove('token')
            console.log('?')
            $("#logout-form").submit()
        }
    },
    created(){
        this.getServices();
        this.getOrders();
    },
    mounted(){
        $('#showProm').modal('show')
    }
});

