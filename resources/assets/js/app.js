
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

Vue.filter("formatNumber", function (value) {
  return numeral(value).format("0,0"); 
});

const api = axios.create({
    baseURL: 'http://localhost/be_platform/public/',
    headers: {
        common: {
            'Accept': 'application/json',
            'Authorization': "Beauty "
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
            selectedData:{}
        }
    },
    methods:{
        setEditService(data){
            console.log(data)
            this.selectedData = data;
            return;
        },
        getServices(){
            api.get('api/services')
            .then(response => {
                // JSON responses are automatically parsed.
                this.servicesData = response.data
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
        }
    },
    created(){
        this.getServices();
    }
});

