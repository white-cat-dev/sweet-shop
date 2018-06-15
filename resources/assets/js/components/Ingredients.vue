<template>
	<div>
		<div class="for-ingredients">
			<table class="table">
				<thead>
					<th>№</th>
					<th>Название</th>
					<th>Количество</th>
					<th>Ед. изм.</th>
					<th></th>
				</thead>
				<tbody>
					<tr v-for="(ingredient, num) in ingredients">
						<td>{{num+1}}</td>
						<td>{{ingredient.title}}</td>
						<td>
							<button class="btn btn-link" v-on:click="reduceCount(num)"><i class="fas fa-minus"></i></button>
							<input type="text" v-model="ingredient.count" v-on:change="validate(num)" class="field">
							<button class="btn btn-link" v-on:click="increaseCount(num)"><i class="fas fa-plus"></i></button>
						</td>
						<td>{{ingredient.units}}</td>
						<td><button class="btn btn-primary btn-sm" v-on:click="deleteItem(ingredient.id, num)"><i class="fas fa-trash-alt"></i> Удалить</button></td>
					</tr>
					<tr v-if="addingItem">
						<td>{{ingredients.length+1}}</td>
						<td><input type="text" v-model="newIngredient.title" class="field wide"></td>
						<td>
							<button class="btn btn-link" v-on:click="reduceCount()"><i class="fas fa-minus"></i></button>
							<input type="text" v-model="newIngredient.count" class="field" v-on:change="validate(num)">
							<button class="btn btn-link" v-on:click="increaseCount()"><i class="fas fa-plus"></i></button>
						</td>
						<td>
							<input type="text" v-model="newIngredient.units" class="field wide">
						</td>
						<td>
							<button class="btn btn-primary btn-sm" v-on:click="saveItem()"><i class="fas fa-plus"></i> Добавить</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="alert alert-danger" v-if="error">
			<p>{{error}}</p>
			<ul>
				<li v-for="error in errors">{{error[0]}}</li>
			</ul>
		</div>
		<div class="alert alert-success" v-if="info">
			{{info}}
		</div>
		<div class="buttons">
			<button class="btn btn-primary" v-on:click="addItem()" :disabled="addingItem"><i class="fas fa-plus"></i> Новый ингредиент</button>
			<button class="btn btn-primary" v-on:click="updateAll()"><i class="fas fa-save"></i> Сохранить изменения</button>
		</div>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				ingredients: [],
				newIngredient: {
					title: '',
					count: 0,
					units: ''
				},
				addingItem: false,
				error: '',
				errors: '',
				info: ''
			}
		},
		mounted() {
			var app = this;
			axios.get('/ingredients/all')
				.then(function (resp) {
					app.ingredients = resp.data;
				})
				.catch(function (resp) {
					app.error = 'Не удалось загрузить ингредиенты';
				});
		},


		methods: {
			increaseCount(num) {
				if (num === undefined) {
					this.newIngredient.count = parseFloat(this.newIngredient.count) + 1;
					if (isNaN(this.newIngredient.count))
						this.newIngredient.count = 0;
				}
				else {
					this.ingredients[num].count = parseFloat(this.ingredients[num].count) + 1;
					if (isNaN(this.ingredients[num].count))
						this.ingredients[num].count = 0;
				}
			},

			reduceCount(num) {
				if (num === undefined) {
					this.newIngredient.count = parseFloat(this.newIngredient.count) - 1;
					if (this.newIngredient.count < 0)
						this.newIngredient.count = 0;
				}
				else {
					this.ingredients[num].count = parseFloat(this.ingredients[num].count) - 1;
					if (this.ingredients[num].count < 0)
						this.ingredients[num].count = 0;
				}
			},
			validate(num) {
				if (num === undefined) {
					if (isNaN(this.newIngredient.count) || (parseFloat(this.newIngredient.count) < 0))
						this.newIngredient.count = 0;
				}
				else {
					if (isNaN(this.ingredients[num].count) || (parseFloat(this.ingredients[num].count) < 0))
						this.ingredients[num].count = 0;
				}
			},

			addItem() {
				this.addingItem = true;
			},

			saveItem() {
				var app = this;

				axios.post('/ingredient', app.newIngredient)
					.then(function (resp) {
						var ingredient = resp.data;
						app.ingredients.push(ingredient); 
						app.newIngredient = {
							title: '',
							count: 0,
							units: ''
						};
						app.addingItem = false;
						app.error = '';
						app.info = 'Новый ингредиент успешно добавлен';
						setTimeout(function() {app.info = ''}, 3000);
					})
					.catch(function (resp) {
						app.error = 'Не удалось добавить ингредиент';
						app.errors = resp.response.data.errors;
						console.log(resp.response.data.errors);
						
					});
			},

			updateAll() {
				var app = this;

				axios.put('/ingredients', app.ingredients)
					.then(function (resp) {
						app.info = 'Все изменения сохранены успешно';
						setTimeout(function() {app.info = ''}, 3000);
						app.error = '';
					})
					.catch(function (resp) {
						app.error = 'Не удалось сохранить изменения';
					});
			},

			deleteItem(id, num) {
				if (confirm("Вы действительно хотите удалить ингредиент "+this.ingredients[num].title+"?")){
					var app = this;
					axios.delete('/ingredient/'+id)
						.then(function (resp) {
							app.ingredients.splice(num, 1);
							app.info = 'Ингредиент успешно удалён';
							setTimeout(function() {app.info = ''}, 3000);
						})
						.catch(function (resp) {
							app.error = 'Не удалось удалить ингредиент';
						});
				}
			}
		}	
	}

</script>