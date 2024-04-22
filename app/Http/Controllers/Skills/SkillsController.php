<?php

namespace App\Http\Controllers\Skills;

use App\Http\Controllers\CommonControllerMethods;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;
use App\Models\Skill;
use Carbon\Carbon;

class SkillsController extends Controller
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
        return Skill::where('status', 1)->orWhereNull('status')->get();

        $skills = Skill::with(['user', 'skillCategory'])->paginate();

        return response(['results' => $skills]);
    }

    /**
     * store skills
     */
    public function store()
    {

        request()->validate([
            'name' => 'required|unique:skills,name,' . request()->id . ',_id',
            'start_date' => 'required|date',
            'level' => 'required|string',
            'skills_category_id' => 'required|string'
        ]);

        $data = \request()->all();

        $data['start_date'] = Carbon::parse(request()->start_date)->format('Y-m');

        if (!isset($data['user_id'])) {
            if (Schema::hasColumn('skills', 'user_id'))
                $data['user_id'] = currentUser()->id;
        }

        if (\request()->id) {
            $action = "updated";
        } else {
            $action = "saved";
            $data['status'] = 1;
        }

        $res = Skill::updateOrCreate(['_id' => request()->id ?? str()->random(20)], $data);
        return response(['type' => 'success', 'message' => 'Skill ' . $action . ' successfully', 'data' => $res], $action == 'saved' ? 201 : 200);
    }

    public function update()
    {
        return $this->store();
    }

    function show($id)
    {

        $res = Skill::find($id);
        return response(['type' => 'success', 'message' => 'successfully', 'data' => $res], 200);
    }
}
