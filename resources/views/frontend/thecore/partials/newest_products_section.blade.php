@if (count($newest_products) > 0)
<section class="py-0 edge-to-edge-section">
    <div class="container-fluid px-0">
        <div class="row g-0" id="newest-products-list">
            @foreach ($newest_products as $index => $new_product)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 edge-product-wrapper">
                    @include('frontend.'.get_setting('homepage_select').'.partials.home_product_box', ['product' => $new_product])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
