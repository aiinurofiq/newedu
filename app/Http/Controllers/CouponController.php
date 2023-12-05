<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Coupon::class);

        $search = $request->get('search', '');

        $coupons = Coupon::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.coupons.index', compact('coupons', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Coupon::class);

        return view('app.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Coupon::class);

        $validated = $request->validated();

        $coupon = Coupon::create($validated);

        return redirect()
            ->route('coupons.edit', $coupon)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Coupon $coupon): View
    {
        $this->authorize('view', $coupon);

        return view('app.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Coupon $coupon): View
    {
        $this->authorize('update', $coupon);

        return view('app.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CouponUpdateRequest $request,
        Coupon $coupon
    ): RedirectResponse {
        $this->authorize('update', $coupon);

        $validated = $request->validated();

        $coupon->update($validated);

        return redirect()
            ->route('coupons.edit', $coupon)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Coupon $coupon): RedirectResponse
    {
        $this->authorize('delete', $coupon);

        $coupon->delete();

        return redirect()
            ->route('coupons.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
