<?php

namespace App\Http\Controllers;

use App\Models\Lpayment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LpaymentStoreRequest;
use App\Http\Requests\LpaymentUpdateRequest;

class LpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Lpayment::class);

        $search = $request->get('search', '');

        $lpayments = Lpayment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.lpayments.index', compact('lpayments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Lpayment::class);

        return view('app.lpayments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LpaymentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Lpayment::class);

        $validated = $request->validated();

        $lpayment = Lpayment::create($validated);

        return redirect()
            ->route('lpayments.edit', $lpayment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Lpayment $lpayment): View
    {
        $this->authorize('view', $lpayment);

        return view('app.lpayments.show', compact('lpayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Lpayment $lpayment): View
    {
        $this->authorize('update', $lpayment);

        return view('app.lpayments.edit', compact('lpayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LpaymentUpdateRequest $request,
        Lpayment $lpayment
    ): RedirectResponse {
        $this->authorize('update', $lpayment);

        $validated = $request->validated();

        $lpayment->update($validated);

        return redirect()
            ->route('lpayments.edit', $lpayment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Lpayment $lpayment
    ): RedirectResponse {
        $this->authorize('delete', $lpayment);

        $lpayment->delete();

        return redirect()
            ->route('lpayments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
