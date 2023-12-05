<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Jenisarsip;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JenisarsipStoreRequest;
use App\Http\Requests\JenisarsipUpdateRequest;

class JenisarsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Jenisarsip::class);

        $search = $request->get('search', '');

        $jenisarsips = Jenisarsip::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.jenisarsips.index', compact('jenisarsips', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Jenisarsip::class);

        return view('app.jenisarsips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisarsipStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Jenisarsip::class);

        $validated = $request->validated();

        $jenisarsip = Jenisarsip::create($validated);

        return redirect()
            ->route('jenisarsips.edit', $jenisarsip)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Jenisarsip $jenisarsip): View
    {
        $this->authorize('view', $jenisarsip);

        return view('app.jenisarsips.show', compact('jenisarsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Jenisarsip $jenisarsip): View
    {
        $this->authorize('update', $jenisarsip);

        return view('app.jenisarsips.edit', compact('jenisarsip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JenisarsipUpdateRequest $request,
        Jenisarsip $jenisarsip
    ): RedirectResponse {
        $this->authorize('update', $jenisarsip);

        $validated = $request->validated();

        $jenisarsip->update($validated);

        return redirect()
            ->route('jenisarsips.edit', $jenisarsip)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Jenisarsip $jenisarsip
    ): RedirectResponse {
        $this->authorize('delete', $jenisarsip);

        $jenisarsip->delete();

        return redirect()
            ->route('jenisarsips.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
