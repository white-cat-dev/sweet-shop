<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cake;
use App\Ingredient;
use App\Image;

class CakeController extends Controller 
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $cakes = Cake::all();

        return view('cakes')->with(['cakes' => $cakes]);
    }


    public function edit($id) 
    {
        $cake = Cake::find($id);

        return view('cake')->with(['cake' => $cake]);
    }


    public function create(Request $request) 
    {
    	return view('newcake');
    }


    public function save(Request $request) 
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric|between:0,99',
        ]);

        $cakeInfo = $request->all();
        $cakeInfo['image_id'] = 0;

        $cake = Cake::create($cakeInfo);

        if (!empty($cakeInfo['ingredients'])) {

            foreach ($cakeInfo['ingredients'] as $ingredientInfo) {
                $id = $ingredientInfo['id'];

                $cake->ingredients()->attach([
                    $id => [
                        'quantity' =>  $ingredientInfo['pivot']['quantity']
                    ],
                ]);
            }
        };
        $cake->image()->associate(Image::first())->save();

        return redirect('/cakes');
    }


    public function update($id, Request $request) 
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric|between:0,99',
        ]);

        $cake = Cake::findOrFail($id);
        $oldIngredients = $cake->ingredients()->select('id')->pluck('id', 'id');

        $cakeInfo = $request->all();

        $cake->update($cakeInfo);

        foreach ($cakeInfo['ingredients'] as $ingredientInfo) {
            $id = $ingredientInfo['id'];

            if ($oldIngredients->has($id)) {
                $oldIngredients->forget($id);
            }

            $ingredient = $cake->ingredients->find($id);

            if (!$ingredient) {
                $cake->ingredients()->attach([
                    $id => [
                        'quantity' =>  $ingredientInfo['pivot']['quantity']
                    ],
                ]);
            }
            else {
                $ingredient->pivot->quantity = $ingredientInfo['pivot']['quantity'];
                $ingredient->pivot->save();
            }
        }

        $cake->ingredients()->detach($oldIngredients);

        return redirect('/cakes');
    }

    public function delete($id)
    {
        $cake = Cake::findOrFail($id);

        $cake->ingredients()->detach();
        $cake->delete();


        return redirect('/cakes');
    }
 
}
