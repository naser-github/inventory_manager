<?php

namespace App\Http\Controllers\Settings\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Category\LevelOneCategory\LevelOneCategoryUpdateRequest;
use App\Http\Requests\Setting\Category\LevelTwoCategory\LevelTwoCategoryStoreRequest;
use App\Http\Requests\Setting\Category\LevelTwoCategory\LevelTwoCategoryUpdateRequest;
use App\Http\Services\setting\Category\LevelTwoCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LevelTwoCategoryController extends Controller
{

    public function index(LevelTwoCategoryService $levelTwoCategoryService): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $level_two_categories = $levelTwoCategoryService->index();

        return view('pages.settings.category.level_two_category.index', compact('level_two_categories'));
    }

    public function create()
    {
        //
    }

    public function store(LevelTwoCategoryStoreRequest $request, LevelTwoCategoryService $levelTwoCategoryService)
    {
        $validateData = $request->validated();

        $levelTwoCategoryService->store($validateData);

        Session::flash('success', 'Level Two Category has been created');
        return back();
    }

    public function edit(Request $request, LevelTwoCategoryService $levelTwoCategoryService)
    {
        $level_two_category = $levelTwoCategoryService->findById($request->id);

        if ($level_two_category) return view('pages.settings.category.level_two_category.edit', compact('level_two_category'));
        else return back();
    }

    public function update($id, LevelTwoCategoryUpdateRequest $request, LevelTwoCategoryService $levelTwoCategoryService)
    {
        $validateData = $request->validated();

        $level_two_category = $levelTwoCategoryService->findById($id);

        if ($level_two_category) {
            $levelTwoCategoryService->update($level_two_category, $validateData);
        }
        Session::flash('success', 'Level Two Category has been updated');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
