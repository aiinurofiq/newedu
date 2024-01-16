<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Learning;
use App\Models\Lpayment;
use Illuminate\View\View;
use App\Models\LTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LTransactionStoreRequest;
use App\Http\Requests\LTransactionUpdateRequest;

class LTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', LTransaction::class);

        $search = $request->get('search', '');

        $lTransactions = LTransaction::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.l_transactions.index',
            compact('lTransactions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', LTransaction::class);

        $users = User::pluck('name', 'id');
        $learnings = Learning::pluck('title', 'id');
        $lpayments = Lpayment::pluck('name', 'id');
        $coupons = Coupon::pluck('code', 'id');

        return view(
            'app.l_transactions.create',
            compact('users', 'learnings', 'lpayments', 'coupons')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LTransactionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', LTransaction::class);

        $validated = $request->validated();

        $lTransaction = LTransaction::create($validated);

        return redirect()
            ->route('l-transactions.edit', $lTransaction)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LTransaction $lTransaction): View
    {
        $this->authorize('view', $lTransaction);

        return view('app.l_transactions.show', compact('lTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, LTransaction $lTransaction): View
    {
        $this->authorize('update', $lTransaction);

        $users = User::pluck('name', 'id');
        $learnings = Learning::pluck('title', 'id');
        $lpayments = Lpayment::pluck('name', 'id');
        $coupons = Coupon::pluck('code', 'id');

        return view(
            'app.l_transactions.edit',
            compact(
                'lTransaction',
                'users',
                'learnings',
                'lpayments',
                'coupons'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LTransactionUpdateRequest $request,
        LTransaction $lTransaction
    ): RedirectResponse {
        $this->authorize('update', $lTransaction);

        $validated = $request->validated();

        $lTransaction->update($validated);

        return redirect()
            ->route('l-transactions.edit', $lTransaction)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        LTransaction $lTransaction
    ): RedirectResponse {
        $this->authorize('delete', $lTransaction);

        $lTransaction->delete();

        return redirect()
            ->route('l-transactions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
