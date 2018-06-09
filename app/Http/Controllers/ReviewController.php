<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    { 
        $reviews = Review::all();

        return view('reviews')->with(['reviews' => $reviews]);
    }


    public function delete($id)
    { 
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect('/reviews');
    }
}
