<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use App\Models\SessionHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AssetController extends Controller
{
    /**
     * Display a listing of the assets.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $resultTypes = $request->get('result_types');
        $sortOrder = $request->get('sort_order', 'desc');
        $perPage = $request->input('per_page', 10);

        $query = Asset::search($search)
            ->when($resultTypes, function ($query) use ($resultTypes) {
                return $query->where('category', $resultTypes);
            })
            ->orderBy('id', $sortOrder);

        $assets = $query->paginate($perPage);
        $assets->appends(['search' => $search]);

        $categoryOptions = Asset::pluck('category')->unique();

        return view('assets.index', compact('assets', 'categoryOptions', 'search'));
    }


    /**
     * Displays the form to create a new asset.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View The view for the create form.
     */
    public function create(Request $request): View
    {
        return view('assets.create', [
            'category' => Category::all(),
        ]);
    }

    /**
     * Stores a new asset in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the asset data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the asset index page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'value' => 'required|numeric',
            'amount' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $validatedData['user_id'] = Auth::id();

        $asset = Asset::create($validatedData);

        SessionHelper::setSuccessMessage('Barang berhasil ditambahkan');

        return redirect(RouteServiceProvider::ASSET);
    }

    /**
     * Displays the edit form for the given asset.
     *
     * @param \App\Models\Asset $asset The asset to be edited.
     * @return \Illuminate\View\View The view for the edit form.
     */
    public function edit(Asset $asset): View
    {
        return view('assets.edit', compact('asset'));
    }

    /**
     * Updates an existing asset.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Asset $asset): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'nullable',
            'purchase_date' => 'required|date',
            'value' => 'required|numeric',
            'amount' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $updated = $asset->update($validatedData);

        if (!$updated) {
            SessionHelper::setErrorMessage('Terjadi kesalahan, gagal mengupdate data.');
            return redirect(RouteServiceProvider::ASSET);
        }

        SessionHelper::setSuccessMessage('Barang berhasil diperbarui.');
        return redirect(RouteServiceProvider::ASSET);
    }

    // public function show(Asset $asset): View
    // {
    //     $schedules = MaintenanceSchedule::where('asset_id', $asset->id)->orderBy('id', 'desc')->get();
    //     return view('assets.detail', compact('asset', 'schedules'));
    // }
    /**
     * Deletes an asset by the given ID.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $asset = Asset::findOrFail($request->id);
            $isDeleted = $asset->delete();

            if ($isDeleted) {
                SessionHelper::setSuccessMessage('Data deleted successfully.');
            } else {
                SessionHelper::setErrorMessage('Terjadi kesalahan, gagal menghapus data.');
            }
        } catch (ModelNotFoundException $e) {
            SessionHelper::setErrorMessage('Data tidak ditemukan.');
        }

        return response()->json(['success' => RouteServiceProvider::ASSET]);
    }
}
