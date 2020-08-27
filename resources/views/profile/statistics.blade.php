@extends('profile.layout')

@section('profile')
<div class="col-lg-9 order-lg-1">
	<div class="pb-7 mb-7">

		<!-- Title -->
		<div class="border-bottom border-color-1 mb-5">
			<h3 class="section-title mb-0 pb-2 font-size-25">Статистика</h3>
		</div>
        <!-- End Title -->
        
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="/img/profile.png"  style="max-width: 250px;">
            <h2>Фамилия Имя Отчество</h2>
            <p>+7 (495) 777-77-77</p>
            <p>info@site.com</p>
            <p>www.site.com</p>
            <p>live:seller1</p>
            <button>РЕДАКТИРОВАТЬ</button>
        </div>
        <div class="col-md-3">
            <div class="col-12">
                <h1>Продажи за месяц</h1>
                <h6>
                    <strong>Кол-во продаж:</strong>
                    <p>15</p>
                </h6>
                <h6>
                    <strong>Сумма продаж:</strong>
                    <p>432 665.64</p>
                </h6>
            </div>
            <div class="col-12">
                <h1>Статистика</h1>
                <h6>
                    <strong>Кол-во продаж:</strong>
                    <p>15</p>
                </h6>
                <h6>
                    <strong>Сумма продаж:</strong>
                    <p>432 665.64</p>
                </h6>
            </div>
        </div>
        <div class="col-md-3">
            <h1>Товары</h1>
            <h6>
                <strong>Категорий:</strong>
                <p>15</p>
            </h6>
            <h6>
                <strong>Товаров:</strong>
                <p>432 665.64</p>
            </h6>
            <h6>
                <strong>Цены</strong>
                <p>138</p>
            </h6>
            <button>В КАТАЛОГ</button>
        </div>
        <div class="col-md-3">
            <h1>
                <h6>
                  <small>  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore alias a incidunt. Ea, provident et dolor deserunt quibusdam quae. Tenetur commodi cum modi amet voluptatum praesentium quam magni fuga deserunt!</small>
                </h6>
                <button>В ЧАТ</button>
            </h1>
        </div>
    </div>
</div>



@stop