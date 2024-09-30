<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Item\ItemStoreRequest;
use App\Http\Requests\Setting\Item\ItemUpdateRequest;
use App\Http\Services\setting\Category\LevelOneCategoryService;
use App\Http\Services\setting\Category\LevelTwoCategoryService;
use App\Http\Services\setting\Category\MasterCategoryService;
use App\Http\Services\setting\ItemService;
use App\Models\Setting\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{

    /**
     * @param ItemService $itemService
     * @return Factory|View|Application
     */
    public function index(ItemService $itemService): Factory|View|Application
    {
        $items = $itemService->index();

        return view('pages.settings.item.index', compact('items'));
    }

    /**
     * @param MasterCategoryService $masterCategoryService
     * @param LevelOneCategoryService $levelOneCategoryService
     * @param LevelTwoCategoryService $levelTwoCategoryService
     * @return Factory|View|Application
     */
    public function create(
        MasterCategoryService   $masterCategoryService,
        LevelOneCategoryService $levelOneCategoryService,
        LevelTwoCategoryService $levelTwoCategoryService
    ): Factory|View|Application
    {
        $master_categories = $masterCategoryService->masterCategoryList();
        $level_one_categories = $levelOneCategoryService->levelOneCategoryList();
        $level_two_categories = $levelTwoCategoryService->levelTwoCategoryList();

        return view('pages.settings.item.create', compact(
            'master_categories', 'level_one_categories', 'level_two_categories'
        ));
    }


    /**
     * @param ItemStoreRequest $request
     * @param ItemService $itemService
     * @return RedirectResponse
     */
    public function store(ItemStoreRequest $request, ItemService $itemService): RedirectResponse
    {
        $validateData = $request->validated();

        $itemService->store($validateData);

        Session::flash('success', 'Items has been created');
        return Redirect::route('items.index');
    }


    public function show($id, ItemService $itemService)
    {
        $item = $itemService->findById($id);
        return view('pages.settings.item.show', compact('item'));
    }


    public function edit(
        $id,
        ItemService $itemService,
        MasterCategoryService $masterCategoryService,
        LevelOneCategoryService $levelOneCategoryService,
        LevelTwoCategoryService $levelTwoCategoryService)
    {
        $item = $itemService->findByIdWMLL($id);

        if ($item) {
            $master_categories = $masterCategoryService->masterCategoryList();
            $level_one_categories = $levelOneCategoryService->levelOneCategoryList();
//            $level_two_categories = $levelTwoCategoryService->levelTwoCategoryList();

            return view('pages.settings.item.edit', compact(
                'item', 'master_categories', 'level_one_categories'
            ));
        } else {
            Session::flash('error', 'No Item Found');
            return redirect()->back();
        }
    }

    public function update($id, ItemUpdateRequest $request, ItemService $itemService)
    {
        $validateData = $request->validated();

        $item = $itemService->findById($id);

        if ($item) {
            $itemService->update($item, $validateData);

            return redirect()->route('items.show', $id);
        }
        Session::flash('error', 'Item update failed');
        return redirect()->back();
    }

    public function destroy($id, ItemService $itemService)
    {
//        $item = $itemService->findById($id);
//
//        if ($item) {
//            $item->destroy($item);
//        } else {
//            Session::flash('error', 'No Item Found');
//            return redirect()->back();
//        }
    }
}
