<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\KnowledgeStoreRequest;
use App\Http\Requests\KnowledgeUpdateRequest;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Knowledge::class);

        $search = $request->get('search', '');

        $knowledges = Knowledge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.knowledges.index', compact('knowledges', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Knowledge::class);

        $users = User::pluck('name', 'id');
        $topics = Topic::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view(
            'app.knowledges.create',
            compact('users', 'topics', 'categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KnowledgeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Knowledge::class);

        $validated = $request->validated();
        // Generate UUID
        $validated['uuid'] = Str::uuid();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $knowledge = Knowledge::create($validated);

        return redirect()
            ->route('knowledges.edit', $knowledge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Knowledge $knowledge): View
    {
        $this->authorize('view', $knowledge);

        return view('app.knowledges.show', compact('knowledge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Knowledge $knowledge): View
    {
        $this->authorize('update', $knowledge);

        $users = User::pluck('name', 'id');
        $topics = Topic::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view(
            'app.knowledges.edit',
            compact('knowledge', 'users', 'topics', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KnowledgeUpdateRequest $request,
        Knowledge $knowledge
    ): RedirectResponse {
        $this->authorize('update', $knowledge);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($knowledge->photo) {
                Storage::delete($knowledge->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $knowledge->update($validated);

        return redirect()
            ->route('knowledges.edit', $knowledge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Knowledge $knowledge
    ): RedirectResponse {
        $this->authorize('delete', $knowledge);

        if ($knowledge->photo) {
            Storage::delete($knowledge->photo);
        }

        $knowledge->delete();

        return redirect()
            ->route('knowledges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
