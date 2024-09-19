<?php

namespace App\Http\Controllers;
use App\Models\posyandu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use App\Models\SessionHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostyanduController extends Controller
{

    /**
     * Retrieves a paginated list of posyandu records based on the provided search, result types, and sort order.
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

        $query = posyandu::search($search)
            ->when($resultTypes, function ($query) use ($resultTypes) {
                return $query->where('kategori', $resultTypes);
            })
            ->orderBy('id', $sortOrder);

        $posyandu = $query->paginate($perPage);
        $posyandu->appends(['search' => $search]);

        $categoryOptions = ['bayi', 'balita', 'remaja', 'ibu hamil', 'lansia'];

        return view('posyandu.index', compact('posyandu', 'categoryOptions', 'search'));
    }


    /**
     * Displays the view for creating a new posyandu record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $categoryOptions = ['bayi', 'balita', 'remaja', 'ibu hamil', 'lansia'];
        return view('posyandu.create', [
            'category' => array_combine($categoryOptions, $categoryOptions),
        ]);
    }

    /**
     * Stores a new posyandu record in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'kategori' => 'required|in:bayi,balita,remaja,ibu hamil,lansia',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
        ]);

        $validatedData['status_aktif'] = true;

        $posyandu = posyandu::create($validatedData);

        SessionHelper::setSuccessMessage('Data posyandu berhasil ditambahkan');

        return redirect(RouteServiceProvider::POSYANDU);
    }

    public function show(posyandu $posyandu): View
    {
        return view('posyandu.detail', compact('posyandu'));
    }

    public function edit(posyandu $posyandu): View
    {
        $categoryOptions = ['bayi', 'balita', 'remaja', 'ibu hamil', 'lansia'];
        return view('posyandu.edit', compact('posyandu', 'categoryOptions'));
    }

    public function update(Request $request, posyandu $posyandu): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'kategori' => 'required|in:bayi,balita,remaja,ibu hamil,lansia',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'status_aktif' => 'boolean',
        ]);

        $updated = $posyandu->update($validatedData);

        if (!$updated) {
            SessionHelper::setErrorMessage('Terjadi kesalahan, gagal mengupdate data.');
            return redirect(RouteServiceProvider::POSYANDU);
        }

        SessionHelper::setSuccessMessage('Data posyandu berhasil diperbarui.');
        return redirect(RouteServiceProvider::POSYANDU);
    }
    /**
     * Deletes an posyandu by the given ID.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $posyandu = posyandu::findOrFail($request->id);
            $isDeleted = $posyandu->delete();

            if ($isDeleted) {
                SessionHelper::setSuccessMessage('Data posyandu berhasil dihapus.');
            } else {
                SessionHelper::setErrorMessage('Terjadi kesalahan, gagal menghapus data posyandu.');
            }
        } catch (ModelNotFoundException $e) {
            SessionHelper::setErrorMessage('Data posyandu tidak ditemukan.');
        }

        return response()->json(['success' => RouteServiceProvider::POSYANDU]);
    }
}
