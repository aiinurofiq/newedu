<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LTransactionResource;
use App\Http\Resources\LTransactionCollection;

class UserLTransactionsController extends Controller
{
    public function index(Request $request, User $user): LTransactionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $lTransactions = $user
            ->lTransactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new LTransactionCollection($lTransactions);
    }

    public function store(Request $request, User $user): LTransactionResource
    {
        $this->authorize('create', LTransaction::class);

        $validated = $request->validate([
            'uuid' => ['required', 'max:255'],
            'learning_id' => ['required', 'exists:learnings,id'],
            'lpayment_id' => ['required', 'exists:lpayments,id'],
            'coupon_id' => ['required', 'exists:coupons,id'],
            'totalamount' => ['required', 'numeric'],
        ]);

        $lTransaction = $user->lTransactions()->create($validated);

        return new LTransactionResource($lTransaction);
    }
}
