<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SessionHelper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Retrieves a paginated list of categories based on the provided search criteria and pagination settings.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the search and pagination parameters.
     * @return \Illuminate\View\View The view containing the paginated list of categories.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $categoriesQuery = Category::query();

        if ($search) {
            $categoriesQuery->search($search);
        }

        $categories = $categoriesQuery->paginate($perPage);
        $categories->appends([
            'search' => $search,
            'per_page' => $perPage,
        ]);
        return view('category.index', compact('categories'));
    }


    /**
     * Store a newly created category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('kk')) {

            // Store new file
            $fileName = time() . '_' . $request->name . '.' . $request->file('kk')->getClientOriginalExtension();
            $request->file('kk')->storeAs('/dokumen_pendukung', $fileName);
            $validatedData['kk'] = $fileName;
        }
        $category = Category::create($validatedData);
        SessionHelper::setSuccessMessage('Kartu Keluarga berhasil ditambahkan.');
        return redirect()->back();
    }

    /**
     * Renders the edit view for the specified category.
     *
     * @param \App\Models\Category $category The category to be edited.
     * @return \Illuminate\View\View The edit view for the category.
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Updates an existing category in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the updated category data.
     * @param \App\Models\Category $category The category model instance to be updated.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the category index page.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('kk')) {
            // Delete old file if exists
            if ($category->kk) {
                Storage::delete('dokumen_pendukung/' . $category->kk);
            }

            // Store new file
            $fileName = time() . '_' . $request->name . '.' . $request->file('kk')->getClientOriginalExtension();
            $request->file('kk')->storeAs('/dokumen_pendukung', $fileName);
            $validatedData['kk'] = $fileName;
        }
        $category->update($validatedData);

        SessionHelper::setSuccessMessage('Kartu Keluarga berhasil diperbarui.');
        return Redirect::route('category.index')->with('success', 'Kartu Keluarga berhasil diperbarui.');
    }
    /**
     * Deletes a category from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $category = Category::findOrFail($request->id);

            // Delete the associated file
            if ($category->kk) {
                Storage::delete('dokumen_pendukung/' . $category->kk);
            }

            $isDeleted = $category->delete();

            if ($isDeleted) {
                SessionHelper::setSuccessMessage('Data berhasil dihapus.');
            } else {
                SessionHelper::setErrorMessage('Terjadi kesalahan, gagal menghapus data.');
            }
        } catch (ModelNotFoundException $e) {
            SessionHelper::setErrorMessage('Data tidak ditemukan.');
        }

        return response()->json(['success' => RouteServiceProvider::CATEGORY]);
    }

}
