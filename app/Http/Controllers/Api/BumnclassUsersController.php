<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Bumnclass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class BumnclassUsersController extends Controller
{
    public function index(
        Request $request,
        Bumnclass $bumnclass
    ): UserCollection {
        $this->authorize('view', $bumnclass);

        $search = $request->get('search', '');

        $users = $bumnclass
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        Bumnclass $bumnclass,
        User $user
    ): Response {
        $this->authorize('update', $bumnclass);

        $bumnclass->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Bumnclass $bumnclass,
        User $user
    ): Response {
        $this->authorize('update', $bumnclass);

        $bumnclass->users()->detach($user);

        return response()->noContent();
    }
}
