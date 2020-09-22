<?php

namespace App\Http\View\Composers;

use App\Models\Brand;
use App\Models\Menu;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use Illuminate\View\View;

class PublicComposer
{
    protected $catalogRepository;

    public function __construct(CatalogRepositoryInterface $repository)
    {
        $this->catalogRepository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'lang'       => lang(),
            'page_data'  => \Pages::pageData(),
            'categories' => $this->catalogRepository->getCats(),
            'menu'       => Menu::getAll(),
            'brands'     => Brand::getAll()
        ]);
    }
}