<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Provider\ProviderServiceIntersect;
use App\Models\ProviderFile;
use App\Models\User;
use App\Notifications\ConfirmRegistration;
use App\Notifications\SendContactToProvider;
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
        $provider = $this->providerRepository->getProvider($id);
        $services = $this->providerRepository->getProviderServices($provider->id);
        $breads   = $this->generateBreads($provider);
        $providersCats = $this->providerRepository->getCatsGroupedByProviders($id);
        $products = $this->providerRepository->getProviderProducts($id);

        return view('public/providers/view', compact(['provider', 'breads', 'services', 'providersCats', 'products']));
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

    public function downloadFile($lang, $id)
    {
        $file = ProviderFile::whereId($id)->with('provider')->has('provider')->firstOrFail();
        return response()->streamDownload(function () use ($file) {
            echo file_get_contents(url('uploads/provider_files/' . $file->file));
        }, 'provider-' . str_replace(' ', '_', $file->name_ru) . '.' . explode('.', $file->file)[1]);
    }

    public function leaveMessage($lang, $id_provider, Request $request)
    {
        $provider = User::provider()->whereId($id_provider)->firstOrFail();
        $provider->notify(new SendContactToProvider($request->all()));
        return \JsonResponse::success([
            'messages' => 'Ваше сообщение успешно оправлено поставщику. В скором он с вами свяжется'
        ]);
    }
}
