<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index() 
    {
    	$ingredients = Ingredient::all();

    	return view('ingredients')->with(['ingredients' => $ingredients]);
    }


    public function all() 
    {
    	$ingredients = Ingredient::all();

    	return $ingredients;
    }


    public function save(Request $request) 
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'units' => 'required|max:255',
            'count' => 'required|numeric'
        ]);
 
        $ingredient = Ingredient::create($request->all());

        return $ingredient;
    }

    public function updateAll(Request $request) 
    {
        $ingredientsInfo = $request->all();
        foreach ($ingredientsInfo as $ingredientInfo) {
            $id = $ingredientInfo['id'];
            $this->update($id, $ingredientInfo);
        }

    }

    public function update($id, $data) {
        $ingredient = Ingredient::findOrFail($id);

        $ingredient->update($data);
    }


    public function delete($id) 
    {
        $ingredient = Ingredient::findOrFail($id);

        $ingredient->delete();
    }
}
