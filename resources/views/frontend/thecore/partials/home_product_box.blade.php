@php
    $cart_added = [];
@endphp
<div class="edge-product-card position-relative overflow-hidden bg-white">
    <div class="position-relative product-image-container overflow-hidden">
        @php
            $product_url = route('product', $product->slug);
            if ($product->auction_product == 1) {
                $product_url = route('auction-product', $product->slug);
            }
        @endphp
        <!-- Image -->
        <a href="{{ $product_url }}" class="d-block position-relative image-hover-effect">
            <img
                class="lazyload w-100 product-main-image has-transition"
                src="{{ get_image($product->thumbnail) }}"
                alt="{{ $product->getTranslation('name') }}"
                title="{{ $product->getTranslation('name') }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            <img
                class="lazyload mx-auto img-fit rounded-2 has-transition product-hover-image position-absolute"
                src="{{ get_first_product_image($product->thumbnail, $product->photos) }}"
                alt="{{ $product->getTranslation('name') }}"
                title="{{ $product->getTranslation('name') }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
        </a>
        @php
            $badgeIndex = 0;
        @endphp

        <!-- Discount percentage tag -->
        @if (discount_in_percentage($product) > 0)
            <span class="absolute-top-left rounded rounded-4 bg-primary ml-1 mt-1 fs-11 fw-700 text-white w-35px text-center"
                style="padding-top:2px; padding-bottom:2px; top:{{ 25 * $badgeIndex }}px;">
                -{{ discount_in_percentage($product) }}%
            </span>
            @php $badgeIndex++; @endphp
        @endif

        <!-- Wholesale tag -->
        @if ($product->wholesale_product)
            <span class="absolute-top-left rounded rounded-4 fs-11 text-white fw-700 px-2 lh-1-8 ml-1 mt-1"
                style="background-color:#455a64; top:{{ 25 * $badgeIndex }}px;">
                {{ translate('Wholesale') }}
            </span>
            @php $badgeIndex++; @endphp
        @endif

            <!-- Custom Labels -->
            @php
                $customLabels = get_custom_labels($product->custom_label_id);
            @endphp
            @if ($customLabels)
                @foreach ($customLabels as $key => $customLabel)
                    <span class="badge px-2 py-1 fs-10 fw-600 mb-1 d-block"
                        style="background-color:{{ $customLabel->background_color }};
                            color:{{ $customLabel->text_color }};
                            border-radius: 12px; margin-bottom: 4px;">
                        {{ $customLabel->text }}
                    </span>
                    @php $badgeIndex++; @endphp
                @endforeach
            @endif
        </div>

        @if ($product->auction_product == 0)
            <!-- Action Icons -->
            <div class="position-absolute" style="top: 8px; right: 8px; z-index: 3;">
                <div class="d-flex flex-column gap-1">
                    <!-- Wishlist Icon -->
                    <button type="button" class="btn btn-sm p-1 bg-white shadow-sm rounded-circle action-btn" 
                        onclick="addToWishList({{ $product->id }})" 
                        style="width: 32px; height: 32px; opacity: 0.9;" 
                        data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}">
                        <i class="las la-heart text-muted" style="font-size: 14px;"></i>
                    </button>
                    
                    <!-- Compare Icon -->
                    <button type="button" class="btn btn-sm p-1 bg-white shadow-sm rounded-circle action-btn" 
                        onclick="addToCompare({{ $product->id }})" 
                        style="width: 32px; height: 32px; opacity: 0.9;" 
                        data-toggle="tooltip" data-title="{{ translate('Add to compare') }}">
                        <i class="las la-exchange-alt text-muted" style="font-size: 14px;"></i>
                    </button>
                </div>
            </div>

            <!-- Quick Add to Cart Button -->
            <div class="position-absolute w-100" style="bottom: 0; left: 0; z-index: 2;">
                @php
                    $colors = is_string($product->colors) ? json_decode($product->colors, true) : $product->colors;
                    $attributes = is_string($product->attributes) ? json_decode($product->attributes, true) : $product->attributes;
                @endphp

                @if ( (is_array($colors) && count($colors) > 0) || (is_array($attributes) && count($attributes) > 0) )
                    <button type="button" class="btn btn-dark w-100 fs-12 fw-600 py-2 quick-cart-btn @if (in_array($product->id, $cart_added)) active @endif"
                        onclick="showAddToCartModal({{ $product->id }})" 
                        style="border-radius: 0; opacity: 0; transition: all 0.3s ease;">
                        <i class="las la-sliders-h me-1"></i> {{ translate('Options') }}
                    </button>
                @else
                    <button type="button" class="btn btn-dark w-100 fs-12 fw-600 py-2 quick-cart-btn @if (in_array($product->id, $cart_added)) active @endif"
                        @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCartSingleProduct({{ $product->id }})" @else onclick="showLoginModal()" @endif
                        style="border-radius: 0; opacity: 0; transition: all 0.3s ease;">
                        <i class="las la-shopping-cart me-1"></i> {{ translate('Add to Cart') }}
                    </button>
                @endif
            </div>
        @endif

        @if (
            $product->auction_product == 1 &&
                $product->auction_start_date <= strtotime('now') &&
                $product->auction_end_date >= strtotime('now'))
            <!-- Place Bid -->
            @php
                $carts = get_user_cart();
                if (count($carts) > 0) {
                    $cart_added = $carts->pluck('product_id')->toArray();
                }
                $highest_bid = $product->bids->max('amount');
                $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $product->starting_bid;
            @endphp
            <div class="position-absolute w-100" style="bottom: 0; left: 0; z-index: 2;">
                <button type="button" class="btn btn-warning w-100 fs-12 fw-600 py-2 quick-cart-btn @if (in_array($product->id, $cart_added)) active @endif"
                    onclick="bid_single_modal({{ $product->id }}, {{ $min_bid_amount }})"
                    style="border-radius: 0; opacity: 0; transition: all 0.3s ease;">
                    <i class="las la-gavel me-1"></i> {{ translate('Place Bid') }}
                </button>
            </div>
        @endif
    </div>

    <!-- Product Details -->
    <div class="product-info p-2">
        <!-- Product name -->
        <h3 class="fs-12 fw-500 text-truncate-2 lh-1-3 mb-1" style="height: 32px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            <a href="{{ $product_url }}" class="text-reset text-decoration-none"
                title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>
        </h3>
        
        <!-- Price Section -->
        <div class="price-section">
            @if ($product->auction_product == 0)
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="fs-13 fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                        @if (home_base_price($product) != home_discounted_base_price($product))
                            <br><del class="fs-11 text-muted">{{ home_base_price($product) }}</del>
                        @endif
                    </div>
                    <!-- Quick Cart Button -->
                    <button type="button" class="btn btn-outline-dark btn-sm px-2 py-1 fs-10 mobile-cart-btn" 
                        @if ( (is_array($colors) && count($colors) > 0) || (is_array($attributes) && count($attributes) > 0) )
                            onclick="showAddToCartModal({{ $product->id }})"
                        @else
                            @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCartSingleProduct({{ $product->id }})" @else onclick="showLoginModal()" @endif
                        @endif
                        style="border-radius: 15px; min-width: 60px;">
                        <i class="las la-shopping-cart" style="font-size: 12px;"></i>
                    </button>
                </div>
            @endif
            @if ($product->auction_product == 1)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fs-13 fw-700 text-warning">{{ single_price($product->starting_bid) }}</span>
                    <button type="button" class="btn btn-outline-warning btn-sm px-2 py-1 fs-10" 
                        onclick="bid_single_modal({{ $product->id }}, {{ $min_bid_amount }})"
                        style="border-radius: 15px; min-width: 60px;">
                        <i class="las la-gavel" style="font-size: 12px;"></i>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
