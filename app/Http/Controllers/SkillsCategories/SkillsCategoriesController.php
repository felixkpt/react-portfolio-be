<?php

namespace App\Http\Controllers\SkillsCategories;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;
use App\Models\SkillsCategory;

class SkillsCategoriesController extends Controller
{

    /**
     *  Controller Trait
     */
    use CommonControllerMethods;

    /**
     * return skills's index view
     */
    public function index()
    {
        if (request()->all == 1)
            return SkillsCategory::where('status', 1)->orWhereNull('status')->get();

        $skills = SkillsCategory::with('user')->paginate();

        return response(['results' => $skills]);
    }

    /**
     * store skills
     */
    public function store()
    {

        request()->validate([
            'name' => 'required|unique:skills_categories,name,' . request()->id,
            'start_date' => 'required|date',
            'experience_level_id' => 'required|exists:experience_levels,id',
            'skills_category_id' => 'required|exists:skills_categories,id',
        ]);

        $data = \request()->all();

        if (!isset($data['user_id'])) {
            if (Schema::hasColumn('skills_categories', 'user_id'))
                $data['user_id'] = currentUser()->id;
        }

        if (\request()->id) {
            $action = "updated";
        } else {
            $action = "saved";
            $data['status'] = 1;
        }

        $res = SkillsCategory::updateOrCreate(['_id' => request()->id ?? str()->random(20)], $data);
        $res->touch();
        return response(['type' => 'success', 'message' => 'SkillsCategory ' . $action . ' successfully', 'data' => $res], $action == 'saved' ? 201 : 200);
    }

    public function update()
    {
        return $this->store();
    }

    function show($id)
    {

        $res = SkillsCategory::find($id);
        return response(['type' => 'success', 'message' => 'successfully', 'data' => $res], 200);
    }
}
