<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Learning;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Categorylearn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LearningStoreRequest;
use App\Http\Requests\LearningUpdateRequest;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Learning::class);

        $search = $request->get('search', '');

        $learnings = Learning::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.learnings.index', compact('learnings', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Learning::class);

        $users = User::pluck('name', 'id');
        $categorylearns = Categorylearn::pluck('name', 'id');

        return view('app.learnings.create', compact('users', 'categorylearns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LearningStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Learning::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $learning = Learning::create($validated);

        return redirect()
            ->route('learnings.edit', $learning)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Learning $learning): View
    {
        $this->authorize('view', $learning);

        return view('app.learnings.show', compact('learning'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Learning $learning): View
    {
        $this->authorize('update', $learning);

        $users = User::pluck('name', 'id');
        $categorylearns = Categorylearn::pluck('name', 'id');

        return view(
            'app.learnings.edit',
            compact('learning', 'users', 'categorylearns')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LearningUpdateRequest $request,
        Learning $learning
    ): RedirectResponse {
        $this->authorize('update', $learning);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($learning->image) {
                Storage::delete($learning->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $learning->update($validated);

        return redirect()
            ->route('learnings.edit', $learning)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Learning $learning
    ): RedirectResponse {
        $this->authorize('delete', $learning);

        if ($learning->image) {
            Storage::delete($learning->image);
        }

        $learning->delete();

        return redirect()
            ->route('learnings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
