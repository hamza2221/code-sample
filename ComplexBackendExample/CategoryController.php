<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductSpecification;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryListing(Request $request, Category $category)
    {
        $productsQB = Product::select('products.id', 'products.category_id', 'products.slug', 'products.name', 'products.currency_id', 'products.price')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->join('categories', 'categories.id', 'subCategories.category_id')
            ->join('product_specifications', 'products.id', 'product_specifications.product_id')
            ->where('categories.id', $category->id)
            ->distinct();

        if ($request->query('orders')) {
            $os = explode(',', $request->query('orders'));
            foreach ($os as $o) {
                $r = explode(':', $o);
                $productsQB = $productsQB->orderBy('products.' . $r[0], $r[1]);
            }
        }

        if ($request->query('filters')) {
            $fs = explode(',', $request->query('filters'));

            $anyAdded = false;
            foreach ($fs as $f) {
                $i = explode(':', $f);
                if (count($i)) {
                    if (preg_match("/[a-z]/i", $i[0])) {
                        if ($i[0] == 'price') {
                            $l = explode('-', $i[1]);
                            $productsQB = $productsQB->whereBetween('products.' . $i[0], [$l[0], $l[1]]);
                        } else {
                            $productsQB = $productsQB->orWhere('products.' . $i[0], $i[1]);
                        }
                    } else {
                        if (!$anyAdded) {
                            $productsQB = $productsQB->whereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                        if ($anyAdded) {
                            $productsQB = $productsQB->orWhereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                    }
                    $anyAdded = true;
                }
            }
        }

        $products = $productsQB->paginate($request->query('paginate'));
        $category->load('categories');
        $products->load('category.category.category');

        return view('public/category/index')->with('category', $category)->with('products', $products);
    }

    public function apiCategorySearch(Request $request, Category $category)
    {

        $specificationsQB = ProductSpecification::select('specifications.id', 'specifications.name', 'specifications.unit', 'product_specifications.value')
            ->join('specifications', 'specifications.id', 'product_specifications.specification_id')
            ->join('products', 'product_specifications.product_id', 'products.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->join('categories', 'categories.id', 'subCategories.category_id')
            ->where('categories.id', $category->id)
            ->orderBy('specifications.id', 'ASC')
            ->distinct();

        $brandsQB = Brand::select('brands.id', 'brands.name', 'brands.slug')
            ->join('products', 'products.brand_id', 'brands.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->join('categories', 'categories.id', 'subCategories.category_id')
            ->where('categories.id', $category->id)
            ->orderBy('brands.id', 'ASC')
            ->distinct();

        $specifications = $specificationsQB->get();
        $brands = $brandsQB->get();

        return [
            'filters' => $specifications,
            'brands' => $brands,
        ];
    }

    public function subCategoryListing(Request $request, $categorySlug, Category $subCategory)
    {
        $productsQB = Product::select('products.id', 'products.category_id', 'products.slug', 'products.name', 'products.currency_id', 'products.price')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->join('product_specifications', 'products.id', 'product_specifications.product_id')
            ->where('subCategories.id', $subCategory->id)
            ->distinct();

        if ($request->query('orders')) {
            $os = explode(',', $request->query('orders'));
            foreach ($os as $o) {
                $r = explode(':', $o);
                $productsQB = $productsQB->orderBy('products.' . $r[0], $r[1]);
            }
        }

        if ($request->query('filters')) {
            $fs = explode(',', $request->query('filters'));

            $anyAdded = false;
            foreach ($fs as $f) {
                $i = explode(':', $f);
                if (count($i)) {
                    if (preg_match("/[a-z]/i", $i[0])) {
                        if ($i[0] == 'price') {
                            $l = explode('-', $i[1]);
                            $productsQB = $productsQB->whereBetween('products.' . $i[0], [$l[0], $l[1]]);
                        } else {
                            $productsQB = $productsQB->where('products.' . $i[0], $i[1]);
                        }
                    } else {
                        if (!$anyAdded) {
                            $productsQB = $productsQB->whereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                        if ($anyAdded) {
                            $productsQB = $productsQB->orWhereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                    }
                    $anyAdded = true;
                }
            }
        }

        $products = $productsQB->paginate($request->query('paginate'));

        $subCategory->load('categories');
        $products->load('category.category.category');

        return view('public/subCategory/index')->with('subCategory', $subCategory)->with('products', $products);
    }
    public function apiSubCategorySearch(Request $request, $categorySlug, Category $subCategory)
    {

        $specificationsQB = ProductSpecification::select('specifications.id', 'specifications.name', 'specifications.unit', 'product_specifications.value')
            ->join('specifications', 'specifications.id', 'product_specifications.specification_id')
            ->join('products', 'product_specifications.product_id', 'products.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->where('subCategories.id', $subCategory->id)
            ->orderBy('specifications.id', 'ASC')
            ->distinct();

        $brandsQB = Brand::select('brands.id', 'brands.name', 'brands.slug')
            ->join('products', 'products.brand_id', 'brands.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('categories AS subCategories', 'subCategories.id', 'subSubCategories.category_id')
            ->where('subCategories.id', $subCategory->id)
            ->orderBy('brands.id', 'ASC')
            ->distinct();

        $specifications = $specificationsQB->get();
        $brands = $brandsQB->get();

        return [
            'filters' => $specifications,
            'brands' => $brands,
        ];
    }

    public function subSubCategoryListing(Request $request, $categorySlug, $subCategorySlug, Category $subSubCategory)
    {
        $productsQB = Product::select('products.id', 'products.category_id', 'products.slug', 'products.name', 'products.currency_id', 'products.price')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->join('product_specifications', 'products.id', 'product_specifications.product_id')
            ->where('subSubCategories.id', $subSubCategory->id)
            ->distinct();
        if ($request->query('orders')) {
            $os = explode(',', $request->query('orders'));
            foreach ($os as $o) {
                $r = explode(':', $o);
                $productsQB = $productsQB->orderBy('products.' . $r[0], $r[1]);
            }
        }

        if ($request->query('filters')) {
            $fs = explode(',', $request->query('filters'));

            $anyAdded = false;
            foreach ($fs as $f) {
                $i = explode(':', $f);
                if (count($i)) {
                    if (preg_match("/[a-z]/i", $i[0])) {
                        if ($i[0] == 'price') {
                            $l = explode('-', $i[1]);
                            $productsQB = $productsQB->whereBetween('products.' . $i[0], [$l[0], $l[1]]);
                        } else {
                            $productsQB = $productsQB->where('products.' . $i[0], $i[1]);
                        }
                    } else {
                        if (!$anyAdded) {
                            $productsQB = $productsQB->whereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                        if ($anyAdded) {
                            $productsQB = $productsQB->orWhereRaw("(product_specifications.specification_id = " . $i[0] . " AND product_specifications.value = '" . $i[1] . "')");
                        }
                    }
                    $anyAdded = true;
                }
            }
        }

        $products = $productsQB->paginate($request->query('paginate') ? $request->query('paginate') : 15);
        $products->load('category.category.category');
        $subSubCategory->load('category.category');
        return view('public/subSubCategory/index')->with('subSubCategory', $subSubCategory)->with('products', $products);
    }

    public function apiSubSubCategorySearch(Request $request, $categorySlug, $subCategorySlug, Category $subSubCategory)
    {

        $specificationsQB = ProductSpecification::select('specifications.id', 'specifications.name', 'specifications.unit', 'product_specifications.value')
            ->join('specifications', 'specifications.id', 'product_specifications.specification_id')
            ->join('products', 'product_specifications.product_id', 'products.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->where('subSubCategories.id', $subSubCategory->id)
            ->orderBy('specifications.id', 'ASC')
            ->distinct();

        $brandsQB = Brand::select('brands.id', 'brands.name', 'brands.slug')
            ->join('products', 'products.brand_id', 'brands.id')
            ->join('categories AS subSubCategories', 'subSubCategories.id', 'products.category_id')
            ->where('subSubCategories.id', $subSubCategory->id)
            ->orderBy('brands.id', 'ASC')
            ->distinct();

        $specifications = $specificationsQB->get();
        $brands = $brandsQB->get();

        return [
            'filters' => $specifications,
            'brands' => $brands,
        ];
    }
}
