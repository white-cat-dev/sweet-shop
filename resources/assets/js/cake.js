require('./bootstrap');

Vue.component('cakeingredients', require('./components/CakeIngredients.vue'));

new Vue({
	el: '.ingredients'
})
