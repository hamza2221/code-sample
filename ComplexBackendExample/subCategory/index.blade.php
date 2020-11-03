@extends('public/layouts/public')

@section('breadCrumbs')
    <a href="{{ config('app.url')}}"><i class="fa fa-home"></i> Home</a>
    <a href="{{ route('category.list', $subCategory->category->slug) }}"> {{$subCategory->category->name}}</a>
    <span>{{$subCategory->name}}</span>
@endsection

@section('title', $subCategory->name  . " | " . $subCategory->category->name)

@section('content')
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        @foreach($subCategory->categories as $subSubCategory)
                            <li><a href="{{ route('category.subCategory.subSubCategory.list', [$subCategory->category->slug, $subCategory->slug, $subSubCategory->slug])}}">{{$subSubCategory->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div id="subCategoryPageContainer" ></div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 text-left">
                            Show {{$products->firstItem()}} - {{$products->lastItem()}} Of {{ $products->total()}} Product
                        </div>
                        <div class="col-lg-8 col-md-8 text-right">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                @include('/public/components/smallProductView')
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>


@endsection