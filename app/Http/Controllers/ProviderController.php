<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Provider\ProviderServiceIntersect;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Utils\ArraySess;
use App\Utils\Crumbs\BreadFactory;
use App\Utils\Crumbs\Crumb;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    private $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository, CatalogRepositoryInterface $catalogRepository)
    {
        $this->providerRepository = $providerRepository;
        $this->catalogRepository  = $catalogRepository;
    }

    public function list($lang)
    {
        $filterPrices  = $this->catalogRepository->getMinMaxPrices();
        $filterCategories = $this->providerRepository->getProviderFilterCats();
        $providers     = $this->providerRepository->getProvidersList();
        $providersCats = $this->providerRepository->getCatsGroupedByProviders();

        return view('public/providers/catalog', compact(['providers', 'filterCategories', 'filterPrices', 'providersCats']));
    }

    public function viewProvider($lang, $id)
    {
        return redirect()->back();
        $provider = $this->providerRepository->getProvider($id);
        $services = $this->providerRepository->getProviderServices($provider->id);
        $breads   = $this->generateBreads($provider);

        return view('public/providers/view', compact(['provider', 'breads', 'services']));
    }

    private function generateBreads($provider)
    {
        $crumb   = BreadFactory::init();
        $page    = \Pages::pageData('suppliers');
        $crumb->add(
            Crumb::name($page->name_ru)->link(setUri(\Pages::getUriByType('suppliers')))
        )->add(
            Crumb::name($provider->name)
        );

        return $crumb->toHtml();
    }
}
