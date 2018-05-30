/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
var app = {
    isLoading: true,
}

document.getElementById('image').addEventListener('change', function () {
    app.imageReload();
})

document.getElementById('catalog-control').addEventListener('click', function () {
    app.openCatalog();
})

app.imageReload = function () {
    var input = document.getElementById('image').files[0];
    var image = document.querySelector('.image');
    var file = new FileReader();
    file.onload = function () {
        image.src = this.result;
        image.classList.remove('image-ctrl');
    }
    file.readAsDataURL(input);
}

app.openCatalog = function () {
    document.querySelector('.catalog-box').hidden = false;
    document.getElementById('catalog-control').hidden = true;
}
