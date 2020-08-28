@extends('profile.layout')

@section('profile')
<div class="col-lg-9 order-lg-1">
    <!-- Title -->
    <div class="border-bottom border-color-1 mb-5">
        <h3 class="section-title mb-0 pb-2 font-size-25">Статистика</h3>
    </div>
    <!-- End Title -->
    <div class="row">
        <div class="col-md-3">
            <div class="custom-card">
                <img src="{{ $user->image }}"  style="max-width: 250px;">
                <h4>{{ $user->full_name }}</h4>
                <p class="mb-0"><i class="fas fa-phone mr-1"></i>{{ $user->phone }}7</p>
                <p class="mb-0"><i class="fas fa-envelope mr-1"> </i>{{ $user->email }}</p>
                <p class="mb-0"><i class="fab fa-internet-explorer mr-1"> </i>{{ $user->site }}</p>
                <p class="mb-3"><i class="fab fa-skype mr-1"> </i>{{ $user->skype }}</p>
                <a class="custom-button" href="{{ route('account', ['lang' => $lang]) }}">РЕДАКТИРОВАТЬ</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-12 mb-5">
                <div class="custom-card">
                    <h6 class="text-center"><strong>Продажи за месяц</strong></h6>
                    <section class=readonly-box">
                        <p class="readonly-field"><strong>Кол-во продаж:</strong><span class="float-right">15</span></p>
                    </section>
                    <section class="readonly-box">
                        <p class="readonly-field"><strong>Сумма продаж:</strong><span class="float-right">432 665.64</span></p>
                    </section>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-card">
                    <h6 class="text-center"><strong>Статистика</strong></h6>
                    <section class=readonly-box">
                        <p class="readonly-field"><strong>Кол-во продаж:</strong><span class="float-right">15</span></p>
                    </section>
                    <section class="readonly-box">
                        <p class="readonly-field"><strong>Сумма продаж:</strong><span class="float-right">432 665.64</span></p>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center"><strong>Товары</strong></h6>
                <section class=readonly-box">
                    <p class="readonly-field"><strong>Категорий:</strong><span class="float-right">15</span></p>
                </section>
                <section class="readonly-box">
                    <p class="readonly-field"><strong>Товаров:</strong><span class="float-right">156</span></p>
                </section>
                <section class="readonly-box">
                    <p class="readonly-field"><strong>Цены:</strong><span class="float-right">217 - 63 548</span></p>
                </section>
                <a class="custom-button" href="{{ route('view_catalog', ['lang' => $lang, 'url' => '']) }}">В КАТАЛОГ</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="custom-card">
                <h6 class="text-center"><strong>Служба поддержки</strong></h6>
                <section class="readonly-box">
                    <p class="readonly-field"><span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore alias a incidunt. Ea, provident et dolor deserunt quibusdam quae. Tenetur commodi cum modi amet voluptatum praesentium quam magni fuga deserunt!</span></p>
                </section>
                <a class="custom-button" href="">В ЧАТ</a>
            </div>
        </div>
    </div>
</div>



@stop