<?php

namespace App\Http\Controllers\Profile;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Utils\Facades\Catalog\CatalogCrud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class ProductsController extends Controller
{
    private $repository;

    public function __construct(ProviderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->getProviderProducts(user()->id);
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
        $this->repository->deleteProduct($id, user()->id);
        return redirect()->back();
    }

    public function create($lang, Request $request)
    {
        $response = (new CatalogCrud(user()->id, $request))->create();
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route('view_profile_product', ['lang' => $lang])], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }

    public function update($lang, $id, Request $request)
    {
        $response = (new CatalogCrud(user()->id, $request))->update($id);
        if ($response->status) {
            return \JsonResponse::success(['redirect' => route('view_profile_product', ['lang' => $lang])], trans('admin.save'));
        } else {
            return \JsonResponse::error(['messages' => $response->error]);
        }
    }
}
