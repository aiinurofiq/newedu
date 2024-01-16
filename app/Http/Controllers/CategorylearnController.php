<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Categorylearn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategorylearnStoreRequest;
use App\Http\Requests\CategorylearnUpdateRequest;

class CategorylearnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Categorylearn::class);

        $search = $request->get('search', '');

        $categorylearns = Categorylearn::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.categorylearns.index',
            compact('categorylearns', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Categorylearn::class);

        return view('app.categorylearns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorylearnStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Categorylearn::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $categorylearn = Categorylearn::create($validated);

        return redirect()
            ->route('categorylearns.edit', $categorylearn)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Categorylearn $categorylearn): View
    {
        $this->authorize('view', $categorylearn);

        return view('app.categorylearns.show', compact('categorylearn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Categorylearn $categorylearn): View
    {
        $this->authorize('update', $categorylearn);

        return view('app.categorylearns.edit', compact('categorylearn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CategorylearnUpdateRequest $request,
        Categorylearn $categorylearn
    ): RedirectResponse {
        $this->authorize('update', $categorylearn);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($categorylearn->image) {
                Storage::delete($categorylearn->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $categorylearn->update($validated);

        return redirect()
            ->route('categorylearns.edit', $categorylearn)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Categorylearn $categorylearn
    ): RedirectResponse {
        $this->authorize('delete', $categorylearn);

        if ($categorylearn->image) {
            Storage::delete($categorylearn->image);
        }

        $categorylearn->delete();

        return redirect()
            ->route('categorylearns.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
