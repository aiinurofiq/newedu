<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Bumnclass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BumnclassCollection;

class UserBumnclassesController extends Controller
{
    public function index(Request $request, User $user): BumnclassCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $bumnclasses = $user
            ->bumnclasses()
            ->search($search)
            ->latest()
            ->paginate();

        return new BumnclassCollection($bumnclasses);
    }

    public function store(
        Request $request,
        User $user,
        Bumnclass $bumnclass
    ): Response {
        $this->authorize('update', $user);

        $user->bumnclasses()->syncWithoutDetaching([$bumnclass->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        User $user,
        Bumnclass $bumnclass
    ): Response {
        $this->authorize('update', $user);

        $user->bumnclasses()->detach($bumnclass);

        return response()->noContent();
    }
}
