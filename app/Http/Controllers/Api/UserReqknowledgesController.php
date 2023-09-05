<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReqknowledgeResource;
use App\Http\Resources\ReqknowledgeCollection;

class UserReqknowledgesController extends Controller
{
    public function index(Request $request, User $user): ReqknowledgeCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $reqknowledges = $user
            ->reqknowledges()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReqknowledgeCollection($reqknowledges);
    }

    public function store(Request $request, User $user): ReqknowledgeResource
    {
        $this->authorize('create', Reqknowledge::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
            'explanation_id' => ['required', 'exists:explanations,id'],
            'exsum_id' => ['required', 'exists:exsums,id'],
            'report_id' => ['required', 'exists:reports,id'],
            'jurnal_id' => ['required', 'exists:jurnals,id'],
        ]);

        $reqknowledge = $user->reqknowledges()->create($validated);

        return new ReqknowledgeResource($reqknowledge);
    }
}
