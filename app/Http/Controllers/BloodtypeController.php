<?php

namespace App\Http\Controllers;

use App\Models\Bloodtype;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BloodtypeStoreRequest;
use App\Http\Requests\BloodtypeUpdateRequest;

class BloodtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Bloodtype::class);

        $search = $request->get('search', '');

        $bloodtypes = Bloodtype::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.bloodtypes.index', compact('bloodtypes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Bloodtype::class);

        return view('app.bloodtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BloodtypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Bloodtype::class);

        $validated = $request->validated();

        $bloodtype = Bloodtype::create($validated);

        return redirect()
            ->route('bloodtypes.edit', $bloodtype)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bloodtype $bloodtype): View
    {
        $this->authorize('view', $bloodtype);

        return view('app.bloodtypes.show', compact('bloodtype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Bloodtype $bloodtype): View
    {
        $this->authorize('update', $bloodtype);

        return view('app.bloodtypes.edit', compact('bloodtype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BloodtypeUpdateRequest $request,
        Bloodtype $bloodtype
    ): RedirectResponse {
        $this->authorize('update', $bloodtype);

        $validated = $request->validated();

        $bloodtype->update($validated);

        return redirect()
            ->route('bloodtypes.edit', $bloodtype)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Bloodtype $bloodtype
    ): RedirectResponse {
        $this->authorize('delete', $bloodtype);

        $bloodtype->delete();

        return redirect()
            ->route('bloodtypes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
