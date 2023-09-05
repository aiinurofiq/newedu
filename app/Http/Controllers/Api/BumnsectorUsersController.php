<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Bumnsector;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class BumnsectorUsersController extends Controller
{
    public function index(
        Request $request,
        Bumnsector $bumnsector
    ): UserCollection {
        $this->authorize('view', $bumnsector);

        $search = $request->get('search', '');

        $users = $bumnsector
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        Bumnsector $bumnsector,
        User $user
    ): Response {
        $this->authorize('update', $bumnsector);

        $bumnsector->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Bumnsector $bumnsector,
        User $user
    ): Response {
        $this->authorize('update', $bumnsector);

        $bumnsector->users()->detach($user);

        return response()->noContent();
    }
}
