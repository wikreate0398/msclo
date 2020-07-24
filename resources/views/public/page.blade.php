@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-wd">
                <div class="min-width-1100-wd">
                    <article class="card mb-8 border-0" style="min-height: 400px;">

                        <div class="card-body pt-5 pb-0 px-0">
                            <div class="d-block d-md-flex flex-center-between mb-md-0">
                                <h4 class="mb-md-3 mb-1">{{ $page_data["name_$lang"] }}</h4>
                            </div>
                            <hr class="mb-4">
                            {!! $page_data["text_$lang"] !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <!-- Brand Carousel -->
            @if($brands->count())
                <div class="mb-6">
                    @include('public/blocks/brands')
                </div>
            @endif
        <!-- End Brand Carousel -->
    </div>
@stop

