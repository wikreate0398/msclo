<?php

namespace App\Http\Controllers\Profile;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductImage;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class ProductsController extends Controller
{
    private $repository;

    private $catalogRepository;

    public function __construct(ProviderRepositoryInterface $repository, CatalogRepositoryInterface $catalogRepository)
    {
        $this->repository = $repository;
        $this->catalogRepository = $catalogRepository;
    }

    public function index()
    {
        $products = $this->repository->getProviderProducts(user()->id, false);
        return view('profile.products', compact('products'));
    }

    public function showAddForm()
    {
        $data = [
            'categories' => Category::orderByPageUp()->get(),
            'providers'  => User::provider()->get(),
            'chars'      => Char::orderByPageUp()->where('parent_id', 0)->with('childs')->get(),
        ];
        return view('profile.product.add', $data);
    }

    public function showeditForm($lang, $id)
    {
        return view('profile.product.edit', [
            'data'       => Product::with(['chars', 'prices', 'images'])->findOrFail($id),
            'categories' => Category::orderByPageUp()->get(),
            'chars'      => Char::orderByPageUp()->where('parent_id', 0)->with('childs')->get(),
        ]);
    }

    public function delete($lang, $id, Request $request)
    {
        $this->catalogRepository->deleteProduct($id, user()->id);
        return redirect()->back();
    }

    public function deleteImage($lang, Request $request)
    {
        ProductImage::where('image', $request->value)
                    ->whereHas('product', function ($query) {
                        return $query->where('id_provider', user()->id);
                    })
                    ->delete();
    }

    public function create($lang, Request $request, CatalogService $catalogService)
    {
        $response = $catalogService->create(user()->id);
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route('view_profile_product', ['lang' => $lang])], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }

    public function update($lang, $id, Request $request, CatalogService $catalogService)
    {
        $response = $catalogService->update($id, user()->id);
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route('view_profile_product', ['lang' => $lang])], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }
}
