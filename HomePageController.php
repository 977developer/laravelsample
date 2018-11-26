<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomePageController extends Controller
{
    public function index(Category $category)
    {	
        
    	$popular_categories = ['Inspiration', 'Love', 'Funny', 'Motivation'];

        $result = $category::
            with(['quotes' => function($q) {
                $q->with('author');
                $q->take(50);
                $q->inRandomOrder();
            }])
            ->whereIn('category', $popular_categories)
            ->get()
            ->map(function ($result) {
                $return['category'] = $result['category'];
                $return['id']       = $result['id'];
                $return['quotes'][$result['category']]   = $result['quotes']->take(9)->toArray();

                return $return;
            });

        $data['popular_categories'] = $popular_categories;
        $data['quote_data']         = $result->toArray();

    	return view('public.home', ['data' => $data]);
    }
}