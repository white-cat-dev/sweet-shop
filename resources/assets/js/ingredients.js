require('./bootstrap');

Vue.component('ingredients', require('./components/Ingredients.vue'));

new Vue({
	el: '.ingredients'
})
