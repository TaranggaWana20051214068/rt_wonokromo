<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Retrieves a paginated list of users based on the provided search criteria.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @return \Illuminate\View\View The view containing the paginated list of users.
     */
    public function index(Request $request): View
    {
        // Ambil input pencarian dan jumlah item per halaman
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        // Query dasar untuk model Category
        $query = User::query();

        // Jika ada input pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        // Tambahkan pagination ke query
        $users = $query->paginate($perPage);
        // Append kata kunci pencarian ke URL pagination
        $users->appends([
            'search' => $search,
            'per_page' => $perPage,
        ]);
        return view('users.index', compact('users'));
    }

    /**
     * Deletes the given user and returns a JSON response indicating success.
     *
     * @param \App\Models\User $user The user to be deleted.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the deletion was successful.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        session()->flash('sweetAlert', [
            'icon' => 'success',
            'title' => 'User berhasil dihapus'
        ]);
        return response()->json(['success' => RouteServiceProvider::USER]);
    }
}
