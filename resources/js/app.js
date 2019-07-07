
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data:{
    	testmsg:'CONTACT US',
        responsemsg:'',
        search:'',
        enquiries:[],
    },
    ready:function(){
        this.created();
    },
    created(){
        axios.get('/admin/get-enquiries')
        .then(response => {
            this.enquiries = response.data;    
        })
        .catch(function (error){
            console.log(error);
        });    
    },
    computed:{
        filteredEnquiries(){
            return this.enquiries.filter(enquiry => {
                return enquiry.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    methods:{
    	addPost() {
                axios.post('/page/post', {name: this.name, email: this.email, subject: this.subject, message: this.message})
                    /*.then(post => this.$emit('completed', name));*/
                    .then(function (response){
                        /*alert(response.data);*/
                        app.responsemsg = response.data;
                    })
            }
    }
});
