<template>
	<div>
		<table class="table ingredients">
			<tbody>
				<tr v-for="(ingredient, num) in ingredients">
					<input type="hidden" :name="'ingredients['+num+'][id]'" :value="ingredient.id">
					<td>{{num+1}}</td>
					<td>{{ingredient.title}}</td>
					<input type="hidden" :name="'ingredients['+num+'][title]'" :value="ingredient.title">
					<td>
						<button type="button" class="btn btn-link" v-on:click="reduceCount(ingredient)"><i class="fas fa-minus"></i></button>
						<input type="text" :name="'ingredients['+num+'][pivot][quantity]'" v-model="ingredient.pivot.quantity" v-on:change="validate(ingredient)" class="field">
						<button type="button" class="btn btn-link" v-on:click="increaseCount(ingredient)"><i class="fas fa-plus"></i></button>
					</td>
					<td>{{ingredient.units}}</td>
					<input type="hidden" :name="'ingredients['+num+'][units]'" :value="ingredient.units">
					<td><button type="button" class="btn btn-primary btn-sm" v-on:click="deleteItem(ingredient.id, num)"><i class="fas fa-trash-alt"></i> Удалить</button></td>
				</tr>
			</tbody>
		</table>
		<div class="add-ingredient">
			{{ingredients.length + 1}}
			<select v-model="newIngredient" class="field">
		        <option v-for="ingredient in allIngredients" v-bind:value="ingredient.id">{{ingredient.title}}</option>
		    </select>
			<button  type="button" class="btn btn-primary btn-sm" v-on:click="addItem()"><i class="fas fa-plus"></i> Добавить ингредиент</button>
		</div>
		
		<div class="alert alert-danger" v-if="error">
			{{error}}
		</div>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				ingredients: window.ingredients,
				allIngredients: [],
				newIngredient: -1,
				error: ''
			}
		},
		mounted() {
			for (var i = this.ingredients.length - 1; i >= 0; i--) {
				this.ingredients[i].pivot.quantity = parseFloat(this.ingredients[i].pivot.quantity)
			}
			var app = this;
			axios.get('/ingredients/all')
				.then(function (resp) {
					app.allIngredients = resp.data;
				})
				.catch(function (resp) {
					app.error = 'Не удалось загрузить ингредиенты';
				});
		},


		methods: {
			increaseCount(ingredient) {
				ingredient.pivot.quantity = parseFloat(ingredient.pivot.quantity) + 1;
				console.log(this.ingredients);
			},

			reduceCount(ingredient) {
				ingredient.pivot.quantity = parseFloat(ingredient.pivot.quantity) - 1;
				if (ingredient.pivot.quantity < 0)
					ingredient.pivot.quantity = 0;
			},

			validate(ingredient) {
				if (isNaN(ingredient.pivot.quantity) || parseFloat(ingredient.pivot.quantity) < 0)
					ingredient.pivot.quantity = 0;
			},

			addItem() {
				for (var i = this.ingredients.length - 1; i >= 0; i--) {
					if (this.ingredients[i].id == this.newIngredient) {
						this.error = "Ингредиент уже есть в списке";
						var app = this;
						setTimeout(function() {app.error = ''}, 2000);
						return;
					}
				}

				for (var i = this.allIngredients.length - 1; i >= 0; i--) {
					if (this.allIngredients[i].id == this.newIngredient) {
						var ingredient = this.allIngredients[i];
						break; 
					}
				}

				if (ingredient === undefined) {
					this.error = "Выберите ингредиент из списка";
					var app = this;
					setTimeout(function() {app.error = ''}, 2000);
				}
				else {
					ingredient.pivot = {quantity: 0};
					this.ingredients.push(ingredient);
				}

			 	this.newIngredient = -1;
			 	console.log(this.ingredients);	
			},

			deleteItem(id, num) {
				this.ingredients.splice(num, 1);
			}
		}	
	}

</script>