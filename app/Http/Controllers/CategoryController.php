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
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validatedData);
        SessionHelper::setSuccessMessage('Category created successfuly');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category->update($request->only(['name', 'description']));

        SessionHelper::setSuccessMessage('Category updated successfuly');
        return Redirect::route('category.index')->with('success', 'Category updated successfuly');
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
            $query = Category::findOrFail($request->id);
            $isDeleted = $query->delete();

            if ($isDeleted) {
                SessionHelper::setSuccessMessage('Data deleted successfully.');
            } else {
                SessionHelper::setErrorMessage('Terjadi kesalahan, gagal menghapus data.');
            }
        } catch (ModelNotFoundException $e) {
            SessionHelper::setErrorMessage('Data tidak ditemukan.');
        }

        return response()->json(['success' => RouteServiceProvider::CATEGORY]);
    }
}
