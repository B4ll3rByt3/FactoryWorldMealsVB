<?php

namespace App\Http\Controllers\Api;

use App\Models\Meal;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealCollection;

class MealController extends Controller
{
    public function meals(MealRequest $request)
    {
        if ($request->lang) {
            App::setLocale($request->lang);
        }

        if ($request->per_page) {
            $perPage = $request->per_page;
        } else {
            $perPage = 10;
        }

        $allRelations = array (
            'category',
            'tags',
            'ingredients'
        );

        if ($request->with) {
            $with = explode(',', $request->with);
            if (array_diff($with, $allRelations)) {
                $response = [
                    'message' =>
                    'Krivo upisan query u parametar with. Mora bit upisano nesto od: tags,category,ingredients',
                ];
                return response()->json($response, 200);
            } else {
                $meal_query = Meal::with($with);
            }
        } else {
            $meal_query = Meal::where('meal_status', '!=', 'deleted');
        }

        if ($request->diff_time > 0) {
            $meal_query->orWhere('created_at', '>=', date($request->diff_time))->withTrashed();
        }

        if ($request->category) {
            if ($request->category === 'null' or $request->category === 'NULL') {
                $meal_query->whereNull('category_id');
            } elseif ($request->category === '!null' or $request->category === '!NULL') {
                $meal_query->where('category_id', '!=', 'null')->orderBy('id', 'ASC');
            } elseif (is_numeric($request->category)) {
                $meal_query->where('category_id', $request->category);
            } else {
                $response = [
                    'message' => 'Krivo upisan query. Mora biti pozitivan broj, null ili !null',
                ];
                return response()->json($response, 200);
            }
        }

        if ($request->tags) {
            $tag = explode(',', $request->tags);
            foreach ($tag as $tags) {
                $meal_query->whereRelation('tags', 'tag_id', $tags);
            }
        }

        $meal = $meal_query->paginate($perPage);

        return new MealCollection($meal);
    }
}
