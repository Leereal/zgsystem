/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');
require('bootstrap/dist/js/bootstrap.js');
require('gentelella/build/js/custom.js');
//require('datatables.net-dt')();
import dt from 'datatables.net'

window.axios = require('axios'); //Require Axios for it to work after installing it

//Datatables Custom Js
$(document).ready(function() {
    $('#table1').DataTable({
        "scrollX": true
    });

});

//import sweetalert 2
import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})
window.toast = toast;





window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '',
});




//Custom functions
window.del = function(url) {
    swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_method': 'DELETE'
                },
                success: function(data) {
                    swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(function() { window.location.reload(); });
                },
                error: function(data) {
                    swal.fire(
                        'Ooops... failed!',
                        'Failed',
                        "error",
                        '6500'
                    );
                }
            });
        };
    })
}