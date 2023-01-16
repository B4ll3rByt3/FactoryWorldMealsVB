<?php
//FactoryWorldMealsVB
namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;

class MealController extends Controller
{
    public function meals(Request $request)
    {
        if ($request->lang) {
            App::setLocale($request->lang);
        }

        if ($request->per_page) {
            $perPage=$request->per_page;
        } else {
            $perPage=10;
        }

        if ($request->with) {
            $meal_query = Meal::with($request->with);
        } else {
            $meal_query = Meal::where('meal_status', '!=', 'deleted');
        }

        if (DateTime::createFromFormat('U', $request->diff_time) == true) {
            if ($request->diff_time>0) {
                $meal_query->orWhere('created_at', '>=', date($request->diff_time))->restore();
            }
        } elseif ($request->diff_time) {
            return response()->json(['Parametar dif_time mora bit u formatu UNIX timestamp']);
        }

        //koristim samo za testiranje

        if ($request->category) {
            if ($request->category==='null' or $request->category==='NULL') {
                $meal_query->whereNull('category_id');
            } elseif ($request->category==='!null' or $request->category==='!NULL') {
                $meal_query->where('category_id', '!=', 'null');
            } else {
                $meal_query->where('category_id', $request->category);
            }
        }

        if ($request->tags) {
            $tag=explode(',', $request->tags);
            foreach ($tag as $tags) {
                $meal_query->whereRelation('tags', 'tag_id', $tags);
            }
        }


        $meal=$meal_query->paginate($perPage);

        return MealResource::collection($meal);
    }
}
