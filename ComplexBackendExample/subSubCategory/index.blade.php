@extends('public/layouts/public')

@section('breadCrumbs')
    <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
    <a href="{{ route('category.list', $subSubCategory->category->category->slug) }}"> {{$subSubCategory->category->category->name}}</a>
    <a href="{{ route('category.subCategory.list', [$subSubCategory->category->category->slug, $subSubCategory->category->slug]) }}"> {{$subSubCategory->category->name}}</a>
    <span>{{$subSubCategory->name}}</span>
@endsection

@section('title', $subSubCategory->name  . " | " . $subSubCategory->category->name)

@section('content')
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div id="subSubCategoryPageContainer" ></div>
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