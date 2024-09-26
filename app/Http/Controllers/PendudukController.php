<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use App\Models\SessionHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PendudukController extends Controller
{
    /**
     * Display a listing of the Penduduk resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $resultTypes = $request->get('result_types');
        $sortOrder = $request->get('sort_order', 'desc');
        $perPage = $request->input('per_page', 10);

        $query = Penduduk::search($search)
            ->when($resultTypes, function ($query) use ($resultTypes) {
                return $query->where('status_kesejahteraan', $resultTypes);
            })
            ->orderBy('id', $sortOrder);

        $penduduk = $query->paginate($perPage);
        $penduduk->appends(['search' => $search]);

        $categoryOptions = ['Sejahtera', 'Pra-sejahtera', 'Rentan ekonomi', 'Penerima bantuan sosial'];

        return view('penduduk.index', compact('penduduk', 'categoryOptions', 'search'));
    }
    /**
     * Display the form to create a new Penduduk (resident) record.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $keluarga = Category::pluck('name');
        return view('penduduk.create', [
            'title' => 'Tambah Data Penduduk',
            'agamas' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
            'pendidikans' => ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'],
            'status_perkawinans' => ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
            'umur_kategoris' => ['Kanak-kanak', 'Remaja', 'Dewasa', 'Lansia'],
            'status_kesejahteraans' => ['Sejahtera', 'Pra-sejahtera', 'Rentan ekonomi', 'Penerima bantuan sosial'],
            'keluargas' => $keluarga,
        ]);
    }

    /**
     * Store a newly created Penduduk (resident) resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'no_kk' => 'required|string|max:20',
            'nik' => 'required|string|unique:penduduks,nik|max:16|min:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:255',
            'status_dalam_keluarga' => 'nullable|string|max:255',
            'umur_kategori' => 'required|in:Kanak-kanak,Remaja,Dewasa,Lansia',
            'status_kesejahteraan' => 'required|in:Sejahtera,Pra-sejahtera,Rentan ekonomi,Penerima bantuan sosial',
            'keluarga' => 'required|string|max:255',
        ]);
        $validatedData['status_aktif'] = true;

        Penduduk::create($validatedData);
        SessionHelper::setSuccessMessage('Data penduduk berhasil ditambahkan');

        return redirect(RouteServiceProvider::PENDUDUK);
    }

    /**
     * Display the details of a specific Penduduk (resident) record.
     *
     * @param  \App\Models\Penduduk  $penduduk  The Penduduk model instance to display.
     * @return \Illuminate\View\View  The view to display the Penduduk details.
     */
    public function show(Penduduk $penduduk): View
    {
        $category = Category::where('name', $penduduk->keluarga)->first();
        $dokumen = $category['kk'];
        return view('penduduk.detail', [
            'title' => 'Detail Penduduk',
            'penduduk' => $penduduk,
            'dokumen' => $dokumen,
        ]);
    }

    /**
     * Renders the view for editing a Penduduk (resident) record.
     *
     * @param  \App\Models\Penduduk  $penduduk  The Penduduk model instance to edit.
     * @return \Illuminate\View\View  The view to display the Penduduk edit form.
     */
    public function edit(Penduduk $penduduk): View
    {
        $keluarga = Category::pluck('name');
        return view('penduduk.edit', [
            'title' => 'Perbarui Data Penduduk',
            'penduduk' => $penduduk,
            'agamas' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
            'pendidikans' => ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'],
            'status_perkawinans' => ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
            'umur_kategoris' => ['Kanak-kanak', 'Remaja', 'Dewasa', 'Lansia'],
            'status_kesejahteraans' => ['Sejahtera', 'Pra-sejahtera', 'Rentan ekonomi', 'Penerima bantuan sosial'],
            'keluarga' => $keluarga,
        ]);
    }


    /**
     * Update the specified Penduduk (resident) record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the updated data.
     * @param  \App\Models\Penduduk  $penduduk  The Penduduk model instance to update.
     * @return \Illuminate\Http\RedirectResponse  A redirect response to the Penduduk index page.
     */
    public function update(Request $request, Penduduk $penduduk): RedirectResponse
    {
        $validatedData = $request->validate([
            'no_kk' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:penduduks,nik,' . $penduduk->id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:255',
            'status_dalam_keluarga' => 'nullable|string|max:255',
            'umur_kategori' => 'nullable|in:Kanak-kanak,Remaja,Dewasa,Lansia',
            'status_kesejahteraan' => 'required|in:Sejahtera,Pra-sejahtera,Rentan ekonomi,Penerima bantuan sosial',
            'status_aktif' => 'boolean',
            'keterangan_tidak_aktif' => 'nullable|string',
            'keluarga' => 'required|string',
        ]);

        if ($request->status_aktif == 0) {
            $validatedData['status_aktif'] = 0;
            if ($request->keterangan_tidak_aktif == null) {
                return redirect()->back()->with('error', 'Keterangan tidak aktif harus diisi');
            }
            ;
        }

        $updated = $penduduk->update($validatedData);
        if (!$updated) {
            SessionHelper::setErrorMessage('Terjadi kesalahan, gagal mengupdate data.');
            return redirect(RouteServiceProvider::PENDUDUK);
        }

        SessionHelper::setSuccessMessage('Data penduduk berhasil diperbarui.');
        return redirect(RouteServiceProvider::PENDUDUK);
    }

    /**
     * Deletes the specified Penduduk (resident) record.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the ID of the record to delete.
     * @return \Illuminate\Http\JsonResponse  A JSON response indicating the success or failure of the delete operation.
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $penduduk = Penduduk::findOrFail($request->id);
            $isDeleted = $penduduk->delete();

            if ($isDeleted) {
                SessionHelper::setSuccessMessage('Data penduduk berhasil dihapus.');
            } else {
                SessionHelper::setErrorMessage('Terjadi kesalahan, gagal menghapus data penduduk.');
            }
        } catch (ModelNotFoundException $e) {
            SessionHelper::setErrorMessage('Data penduduk tidak ditemukan.');
        }

        return response()->json(['success' => RouteServiceProvider::PENDUDUK]);
    }

}