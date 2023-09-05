<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Bumnsector;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BumnsectorCollection;

class UserBumnsectorsController extends Controller
{
    public function index(Request $request, User $user): BumnsectorCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $bumnsectors = $user
            ->bumnsectors()
            ->search($search)
            ->latest()
            ->paginate();

        return new BumnsectorCollection($bumnsectors);
    }

    public function store(
        Request $request,
        User $user,
        Bumnsector $bumnsector
    ): Response {
        $this->authorize('update', $user);

        $user->bumnsectors()->syncWithoutDetaching([$bumnsector->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        User $user,
        Bumnsector $bumnsector
    ): Response {
        $this->authorize('update', $user);

        $user->bumnsectors()->detach($bumnsector);

        return response()->noContent();
    }
}
