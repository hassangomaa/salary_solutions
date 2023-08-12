 @extends("web-view.app")

@section('content')
<!-- site -->
<body>

<!-- site__body -->
<div class="site__body">
    <div class="block-finder block">
        <div class="decor block-finder__decor decor--type--bottom">
            <div class="decor__body">
                <div class="decor__start"></div>
                <div class="decor__end"></div>
                <div class="decor__center"></div>
            </div>
        </div>
        <div class="block-finder__image" style="background-image: url('images/finder-1903x500.jpg');"></div>
        <div class="block-finder__body container container--max--xl">
            <div class="block-finder__title">ابحث عن قطعه الغيار المناسبه لك</div>
            <div class="block-finder__subtitle">أكثر من مئات العلامات التجارية وعشرات الآلاف من الأجزاء</div>
            <form class="block-finder__form">
                <div class="block-finder__form-control block-finder__form-control--select">
                    <select name="year" aria-label="Vehicle Year" id="year-dropdown">
                        <option value="none">اختار السنه</option>
                        @foreach($years as $year)
                        <option value="{{$year->id}}" >{{$year->year}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="block-finder__form-control block-finder__form-control--select">

                    <select name="brand_id" id="brand-dropdown" aria-label="Vehicle Make" disabled="disabled">
                        <option value="none">اختار الماركه</option>
                    </select></div>
                <div class="block-finder__form-control block-finder__form-control--select">
                    <select name="modeel_id" id="modeel-dropdown" aria-label="Vehicle Model" disabled="disabled">
                        <option  value="none">اختار الموديل</option>
                    </select></div>
                <button class="block-finder__form-control block-finder__form-control--button"
                        type="submit">بحث</button>
            </form>
        </div>
    </div>




    <div class="block-space block-space--layout--divider-nl"></div>
    <div class="block block-products-carousel" data-layout="grid-5">
        <div class="container">
            <div class="section-header">
                <div class="section-header__body">
                    <h2 class="section-header__title">منتجات مميزه</h2>
                    <div class="section-header__spring"></div>
                    <ul class="section-header__groups">
                        <li class="section-header__groups-item"><button type="button"
                                                                        class="section-header__groups-button section-header__groups-button--active">الكل</button>
                        </li>
                        <li class="section-header__groups-item"><button type="button"
                                                                        class="section-header__groups-button">منتجات مستعمله </button></li>
                        <li class="section-header__groups-item"><button type="button"
                                                                        class="section-header__groups-button">منتجات جديده</button></li>

                    </ul>
                    <div class="section-header__arrows">
                        <div class="arrow section-header__arrow section-header__arrow--prev arrow--prev"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path
                                        d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z" />
                                </svg></button></div>
                        <div class="arrow section-header__arrow section-header__arrow--next arrow--next"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
	C-0.1,9.8-0.1,10.4,0.3,10.7z" />
                                </svg></button></div>
                    </div>
                    <div class="section-header__divider"></div>
                </div>
            </div>
{{--            %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%--}}
                <div class="block-products-carousel__carousel">
                <div class="block-products-carousel__carousel-loader"></div>
                <div class="owl-carousel">
                    @foreach($products as $product)
                        <div class="block-zone__carousel-item">
                            <div class="product-card">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16"
                                                                                   height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button> <button
                                        class="product-card__action product-card__action--wishlist"
                                        type="button" aria-label="Add to wish list"><svg width="16"
                                                                                         height="16">
                                            <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
	l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                                        </svg></button> <button
                                        class="product-card__action product-card__action--compare"
                                        type="button" aria-label="Add to compare"><svg width="16"
                                                                                       height="16">
                                            <path
                                                d="M9,15H7c-0.6,0-1-0.4-1-1V2c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v12C10,14.6,9.6,15,9,15z" />
                                            <path
                                                d="M1,9h2c0.6,0,1,0.4,1,1v4c0,0.6-0.4,1-1,1H1c-0.6,0-1-0.4-1-1v-4C0,9.4,0.4,9,1,9z" />
                                            <path
                                                d="M15,5h-2c-0.6,0-1,0.4-1,1v8c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V6C16,5.4,15.6,5,15,5z" />
                                        </svg></button></div>
                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-1-245x245.jpg" alt=""></a>
                                    </div>
                                    <div
                                        class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
                                        <div class="status-badge__body">
                                            <div class="status-badge__icon"><svg width="13" height="13">
                                                    <path
                                                        d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z" />
                                                </svg></div>
                                            <div class="status-badge__text">Part Fit for 2011 Ford Focus
                                                S</div>
                                            <div class="status-badge__tooltip" tabindex="0"
                                                 data-toggle="tooltip"
                                                 title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-card__info">
                                    <div class="product-card__meta"><span
                                            class="product-card__meta-title">SKU:</span> 140-10440-B
                                    </div>
                                    <div class="product-card__name">
                                        <div>
                                            <div class="product-card__badges">
                                                <div class="tag-badge tag-badge--خصم">خصم</div>
                                                <div class="tag-badge tag-badge--جديد">جديد</div>
                                                <div class="tag-badge tag-badge--رائج">رائج</div>
                                            </div><a href="product-full.html"> {{$product->name}}
                                                ASR-400</a>
                                        </div>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="rating product-card__rating-stars">
                                            <div class="rating__body">
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star"></div>
                                            </div>
                                        </div>
                                        <div class="product-card__rating-label">4 on 3 reviews</div>
                                    </div>
                                </div>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <div class="product-card__price product-card__price--current">
                                            {{$product->price}}</div>
                                    </div><button class="product-card__addtocart-icon" type="button"
                                                  aria-label="Add to cart"><svg width="20" height="20">
                                            <circle cx="7" cy="17" r="2" />
                                            <circle cx="15" cy="17" r="2" />
                                            <path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6
	V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4
	C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z" />
                                        </svg></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
{{--                    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </div>
    <div class="block-space block-space--layout--divider-sm"></div>
    <div class="block block-zone">
        <div class="container">
            <div class="block-zone__body">
                <div class="block-zone__card category-card category-card--layout--overlay">
                    <div class="category-card__body">
                        <div class="category-card__overlay-image"><img
                                srcset="images/categories/category-overlay-2-mobile.jpg 530w, images/categories/category-overlay-2.jpg 305w"
                                src="images/categories/category-overlay-2.jpg"
                                sizes="(max-width: 575px) 530px, 305px" alt=""></div>
                        <div class="category-card__overlay-image category-card__overlay-image--blur"><img
                                srcset="images/categories/category-overlay-2-mobile.jpg 530w, images/categories/category-overlay-2.jpg 305w"
                                src="images/categories/category-overlay-2.jpg"
                                sizes="(max-width: 575px) 530px, 305px" alt=""></div>
                        <div class="category-card__content">
                            <div class="category-card__info">
                                <div class="category-card__name"><a
                                        href="category-4-columns-sidebar.html">Interior Parts</a></div>
                                <ul class="category-card__children">
                                    <li><a href="category-4-columns-sidebar.html">Dashboards</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Seat Covers</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Floor Mats</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Sun Shades</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Visors</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Car Covers</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Accessories</a></li>
                                </ul>
                                <div class="category-card__actions"><a href="shop-grid-4-columns-sidebar.html"
                                                                       class="btn btn-primary btn-sm">المتجرAll</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-zone__widget">
                    <div class="block-zone__widget-header">
                        <div class="block-zone__tabs"><button
                                class="block-zone__tabs-button block-zone__tabs-button--active"
                                type="button">المميز</button> <button class="block-zone__tabs-button"
                                                                      type="button">الافضل مبيعا</button> <button class="block-zone__tabs-button"
                                                                                                                  type="button">منتشر</button></div>
                        <div class="arrow block-zone__arrow block-zone__arrow--prev arrow--prev"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path
                                        d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z" />
                                </svg></button></div>
                        <div class="arrow block-zone__arrow block-zone__arrow--next arrow--next"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
	C-0.1,9.8-0.1,10.4,0.3,10.7z" />
                                </svg></button></div>
                    </div>
                    <div class="block-zone__widget-body">
                        <div class="block-zone__carousel">
                            <div class="block-zone__carousel-loader"></div>
                            <div class="owl-carousel">
{{--                                ##               المميز          --}}
                                @foreach($products as $product)
                                <div class="block-zone__carousel-item">
                                    <div class="product-card">
                                        <div class="product-card__actions-list"><button
                                                class="product-card__action product-card__action--quickview"
                                                type="button" aria-label="Quick view"><svg width="16"
                                                                                           height="16">
                                                    <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                                </svg></button> <button
                                                class="product-card__action product-card__action--wishlist"
                                                type="button" aria-label="Add to wish list"><svg width="16"
                                                                                                 height="16">
                                                    <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
	l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                                                </svg></button> <button
                                                class="product-card__action product-card__action--compare"
                                                type="button" aria-label="Add to compare"><svg width="16"
                                                                                               height="16">
                                                    <path
                                                        d="M9,15H7c-0.6,0-1-0.4-1-1V2c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v12C10,14.6,9.6,15,9,15z" />
                                                    <path
                                                        d="M1,9h2c0.6,0,1,0.4,1,1v4c0,0.6-0.4,1-1,1H1c-0.6,0-1-0.4-1-1v-4C0,9.4,0.4,9,1,9z" />
                                                    <path
                                                        d="M15,5h-2c-0.6,0-1,0.4-1,1v8c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V6C16,5.4,15.6,5,15,5z" />
                                                </svg></button></div>
                                        <div class="product-card__image">
                                            <div class="image image--type--product"><a href="product-full.html"
                                                                                       class="image__body"><img class="image__tag"
                                                                                                                src="images/products/product-1-245x245.jpg" alt=""></a>
                                            </div>
                                            <div
                                                class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
                                                <div class="status-badge__body">
                                                    <div class="status-badge__icon"><svg width="13" height="13">
                                                            <path
                                                                d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z" />
                                                        </svg></div>
                                                    <div class="status-badge__text">Part Fit for 2011 Ford Focus
                                                        S</div>
                                                    <div class="status-badge__tooltip" tabindex="0"
                                                         data-toggle="tooltip"
                                                         title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-card__info">
                                            <div class="product-card__meta"><span
                                                    class="product-card__meta-title">SKU:</span> 140-10440-B
                                            </div>
                                            <div class="product-card__name">
                                                <div>
                                                    <div class="product-card__badges">
                                                        <div class="tag-badge tag-badge--خصم">خصم</div>
                                                        <div class="tag-badge tag-badge--جديد">جديد</div>
                                                        <div class="tag-badge tag-badge--رائج">رائج</div>
                                                    </div><a href="product-full.html"> {{$product->name}}
                                                        ASR-400</a>
                                                </div>
                                            </div>
                                            <div class="product-card__rating">
                                                <div class="rating product-card__rating-stars">
                                                    <div class="rating__body">
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star"></div>
                                                    </div>
                                                </div>
                                                <div class="product-card__rating-label">4 on 3 reviews</div>
                                            </div>
                                        </div>
                                        <div class="product-card__footer">
                                            <div class="product-card__prices">
                                                <div class="product-card__price product-card__price--current">
                                                    {{$product->price}}</div>
                                            </div><button class="product-card__addtocart-icon" type="button"
                                                          aria-label="Add to cart"><svg width="20" height="20">
                                                    <circle cx="7" cy="17" r="2" />
                                                    <circle cx="15" cy="17" r="2" />
                                                    <path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6
	V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4
	C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z" />
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
{{--                                &&&&&&&&&&&&&--}}

{{--                                &&&&&&&&&&&&--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-space block-space--layout--divider-sm"></div>
    <div class="block block-zone">
        <div class="container">
            <div class="block-zone__body">
                <div class="block-zone__card category-card category-card--layout--overlay">
                    <div class="category-card__body">
                        <div class="category-card__overlay-image"><img
                                srcset="images/categories/category-overlay-3-mobile.jpg 530w, images/categories/category-overlay-3.jpg 305w"
                                src="images/categories/category-overlay-3.jpg"
                                sizes="(max-width: 575px) 530px, 305px" alt=""></div>
                        <div class="category-card__overlay-image category-card__overlay-image--blur"><img
                                srcset="images/categories/category-overlay-3-mobile.jpg 530w, images/categories/category-overlay-3.jpg 305w"
                                src="images/categories/category-overlay-3.jpg"
                                sizes="(max-width: 575px) 530px, 305px" alt=""></div>
                        <div class="category-card__content">
                            <div class="category-card__info">
                                <div class="category-card__name"><a
                                        href="category-4-columns-sidebar.html">Engine & Drivetrain</a></div>
                                <ul class="category-card__children">
                                    <li><a href="category-4-columns-sidebar.html">Timing Belts</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Spark Plugs</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Oil Pans</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Engine Gaskets</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Oil Filters</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Engine Mounts</a></li>
                                    <li><a href="category-4-columns-sidebar.html">Accessories</a></li>
                                </ul>
                                <div class="category-card__actions"><a href="shop-grid-4-columns-sidebar.html"
                                                                       class="btn btn-primary btn-sm">المتجرAll</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-zone__widget">
                    <div class="block-zone__widget-header">
                        <div class="block-zone__tabs"><button
                                class="block-zone__tabs-button block-zone__tabs-button--active"
                                type="button">المميز</button> <button class="block-zone__tabs-button"
                                                                      type="button">الافضل مبيعا</button> <button class="block-zone__tabs-button"
                                                                                                                  type="button">منتشر</button></div>
                        <div class="arrow block-zone__arrow block-zone__arrow--prev arrow--prev"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path
                                        d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z" />
                                </svg></button></div>
                        <div class="arrow block-zone__arrow block-zone__arrow--next arrow--next"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
	C-0.1,9.8-0.1,10.4,0.3,10.7z" />
                                </svg></button></div>
                    </div>

                    <div class="block-zone__widget-body">
                        <div class="block-zone__carousel">
                            <div class="block-zone__carousel-loader"></div>
                            <div class="owl-carousel">

{{--                        start product--}}
                                <div class="block-zone__carousel-item">
                                    <div class="product-card">
                                        <div class="product-card__actions-list"><button
                                                class="product-card__action product-card__action--quickview"
                                                type="button" aria-label="Quick view"><svg width="16"
                                                                                           height="16">
                                                    <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                                </svg></button> <button
                                                class="product-card__action product-card__action--wishlist"
                                                type="button" aria-label="Add to wish list"><svg width="16"
                                                                                                 height="16">
                                                    <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
	l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                                                </svg></button> <button
                                                class="product-card__action product-card__action--compare"
                                                type="button" aria-label="Add to compare"><svg width="16"
                                                                                               height="16">
                                                    <path
                                                        d="M9,15H7c-0.6,0-1-0.4-1-1V2c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v12C10,14.6,9.6,15,9,15z" />
                                                    <path
                                                        d="M1,9h2c0.6,0,1,0.4,1,1v4c0,0.6-0.4,1-1,1H1c-0.6,0-1-0.4-1-1v-4C0,9.4,0.4,9,1,9z" />
                                                    <path
                                                        d="M15,5h-2c-0.6,0-1,0.4-1,1v8c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V6C16,5.4,15.6,5,15,5z" />
                                                </svg></button></div>
                                        <div class="product-card__image">
                                            <div class="image image--type--product"><a href="product-full.html"
                                                                                       class="image__body"><img class="image__tag"
                                                                                                                src="images/products/product-8-245x245.jpg" alt=""></a>
                                            </div>
                                            <div
                                                class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
                                                <div class="status-badge__body">
                                                    <div class="status-badge__icon"><svg width="13" height="13">
                                                            <path
                                                                d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z" />
                                                        </svg></div>
                                                    <div class="status-badge__text">Part Fit for 2011 Ford Focus
                                                        S</div>
                                                    <div class="status-badge__tooltip" tabindex="0"
                                                         data-toggle="tooltip"
                                                         title="Part&#x20;Fit&#x20;for&#x20;2011&#x20;Ford&#x20;Focus&#x20;S">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-card__info">
                                            <div class="product-card__meta"><span
                                                    class="product-card__meta-title">SKU:</span> 472-67382-Z
                                            </div>
                                            <div class="product-card__name">
                                                <div><a href="product-full.html">اسم القطعه</a>
                                                </div>
                                            </div>
                                            <div class="product-card__rating">
                                                <div class="rating product-card__rating-stars">
                                                    <div class="rating__body">
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star rating__star--active"></div>
                                                        <div class="rating__star"></div>
                                                        <div class="rating__star"></div>
                                                    </div>
                                                </div>
                                                <div class="product-card__rating-label">3 on 7 reviews</div>
                                            </div>
                                        </div>
                                        <div class="product-card__footer">
                                            <div class="product-card__prices">
                                                <div class="product-card__price product-card__price--current">
                                                    $345.00</div>
                                            </div><button class="product-card__addtocart-icon" type="button"
                                                          aria-label="Add to cart"><svg width="20" height="20">
                                                    <circle cx="7" cy="17" r="2" />
                                                    <circle cx="15" cy="17" r="2" />
                                                    <path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6
	V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4
	C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z" />
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
{{--                                End product --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-space block-space--layout--divider-nl"></div>
    <div class="block-banners block">
        <div class="container">
            <div class="block-banners__list"><a href="#"
                                                class="block-banners__item block-banners__item--style--one"><span
                        class="block-banners__item-image"><img src="images/banners/banner1.jpg"
                                                               alt=""></span><span
                        class="block-banners__item-image block-banners__item-image--blur"><img
                            src="images/banners/banner1.jpg" alt=""></span><span
                        class="block-banners__item-title">زيوت توتال</span> <span
                        class="block-banners__item-details"> شحن مجانى للزيوت توتال<br></span><span
                        class="block-banners__item-button btn btn-primary btn-sm">المتجر </span></a><a
                    href="#" class="block-banners__item block-banners__item--style--two"><span
                        class="block-banners__item-image"><img src="images/banners/banner2.jpg"
                                                               alt=""></span><span
                        class="block-banners__item-image block-banners__item-image--blur"><img
                            src="images/banners/banner2.jpg" alt=""></span><span
                        class="block-banners__item-title">وفر 40 جنيه</span> <span
                        class="block-banners__item-details">اشترى ووفر <br>مواصفات المنتج واكتر. </span><span
                        class="block-banners__item-button btn btn-primary btn-sm">المتجر</span></a></div>
        </div>
    </div>
    <div class="block-space block-space--layout--divider-nl"></div>
    <div class="block block-products-carousel" data-layout="horizontal">
        <div class="container">
            <div class="section-header">
                <div class="section-header__body">
                    <h2 class="section-header__title">منتجات جديده </h2>
                    <div class="section-header__spring"></div>
                    <ul class="section-header__links">
                        <li class="section-header__links-item"><a href="#"
                                                                  class="section-header__links-link">سيارات</a></li>
                        <li class="section-header__links-item"><a href="#"
                                                                  class="section-header__links-link">شاحنات </a></li>
                        <li class="section-header__links-item"><a href="#"
                                                                  class="section-header__links-link">الكل</a></li>
                    </ul>
                    <div class="section-header__arrows">
                        <div class="arrow section-header__arrow section-header__arrow--prev arrow--prev"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path
                                        d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z" />
                                </svg></button></div>
                        <div class="arrow section-header__arrow section-header__arrow--next arrow--next"><button
                                class="arrow__button" type="button"><svg width="7" height="11">
                                    <path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
	C-0.1,9.8-0.1,10.4,0.3,10.7z" />
                                </svg></button></div>
                    </div>
                    <div class="section-header__divider"></div>
                </div>
            </div>
            <div class="block-products-carousel__carousel">
                <div class="block-products-carousel__carousel-loader"></div>
                <div class="owl-carousel">

                    <div class="block-products-carousel__column">
                        <div class="block-products-carousel__cell">##cell1
                            <div class="product-card product-card--layout--horizontal">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16" height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button></div>
                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-7-245x245.jpg" alt=""></a></div>
                                </div>
                                <div class="product-card__info">
                                    <div class="product-card__name">
                                        <div><a href="product-full.html">اسم القطعه</a></div>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="rating product-card__rating-stars">
                                            <div class="rating__body">
                                                <div class="rating__star"></div>
                                                <div class="rating__star"></div>
                                                <div class="rating__star"></div>
                                                <div class="rating__star"></div>
                                                <div class="rating__star"></div>
                                            </div>
                                        </div>
                                        <div class="product-card__rating-label">0 on 0 reviews</div>
                                    </div>
                                </div>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <div class="product-card__price product-card__price--current">$452.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        #cell2
                        <div class="block-products-carousel__cell">
                            <div class="product-card product-card--layout--horizontal">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16" height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	                            M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button></div>
                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-8-245x245.jpg" alt=""></a></div>
                                </div>
                                <div class="product-card__info">
                                    <div class="product-card__name">
                                        <div><a href="product-full.html">اسم القطعه</a></div>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="rating product-card__rating-stars">
                                            <div class="rating__body">
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star"></div>
                                                <div class="rating__star"></div>
                                            </div>
                                        </div>
                                        <div class="product-card__rating-label">3 on 7 reviews</div>
                                    </div>
                                </div>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <div class="product-card__price product-card__price--current">$345.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-space block-space--layout--divider-nl"></div>

    <div class="block-space block-space--layout--divider-nl"></div>

    <div class="block-space block-space--layout--divider-nl d-xl-block d-none"></div>
    <div class="block block-products-columns">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="block-products-columns__title">افضل المنتجات</div>

                    <div class="block-products-columns__list">
                        <div class="block-products-columns__list-item">
                            <div class="product-card">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16" height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button>


                                </div>



                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-1-245x245.jpg" alt=""></a></div>
                                </div>
{{--                                #the best products--}}
                                @foreach($products as $product)
                                <div class="product-card__info">
                                    <div class="product-card__name">
                                        <div>
                                            <div class="product-card__badges">
                                                <div class="tag-badge tag-badge--خصم">خصم</div>
                                                <div class="tag-badge tag-badge--جديد">جديد</div>
                                                <div class="tag-badge tag-badge--رائج">رائج</div>
                                            </div><a href="product-full.html">{{$product->title}}</a>
                                        </div>
                                    </div>
                                    <div class="product-card__rating">
                                        <div class="rating product-card__rating-stars">
                                            <div class="rating__body">
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star rating__star--active"></div>
                                                <div class="rating__star"></div>
                                            </div>
                                        </div>
                                        <div class="product-card__rating-label">4 on 3 reviews</div>
                                    </div>
                                </div>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <div class="product-card__price product-card__price--current">{{$product->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
                <div class="col-4">
                    <div class="block-products-columns__title">عروض مميزه</div>
                    <div class="block-products-columns__list">
                        <div class="block-products-columns__list-item">
                            <div class="product-card">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16" height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button></div>

                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-1-245x245.jpg" alt=""></a></div>
                                </div>
                                {{--                                #the best products--}}
                                @foreach($best_products as $product)
                                    <div class="product-card__info">
                                        <div class="product-card__name">
                                            <div>
                                                <div class="product-card__badges">
                                                    <div class="tag-badge tag-badge--خصم">خصم</div>
                                                    <div class="tag-badge tag-badge--جديد">جديد</div>
                                                    <div class="tag-badge tag-badge--رائج">رائج</div>
                                                </div><a href="product-full.html">{{$product->title}}</a>
                                            </div>
                                        </div>
                                        <div class="product-card__rating">
                                            <div class="rating product-card__rating-stars">
                                                <div class="rating__body">
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star"></div>
                                                </div>
                                            </div>
                                            <div class="product-card__rating-label">4 on 3 reviews</div>
                                        </div>
                                    </div>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <div class="product-card__price product-card__price--current">{{$product->price}}
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="block-products-columns__title">الافضل مبيعا</div>
                    <div class="block-products-columns__list">
                        <div class="block-products-columns__list-item">
                            <div class="product-card">
                                <div class="product-card__actions-list"><button
                                        class="product-card__action product-card__action--quickview"
                                        type="button" aria-label="Quick view"><svg width="16" height="16">
                                            <path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z
	 M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z" />
                                        </svg></button></div>

                                <div class="product-card__image">
                                    <div class="image image--type--product"><a href="product-full.html"
                                                                               class="image__body"><img class="image__tag"
                                                                                                        src="images/products/product-1-245x245.jpg" alt=""></a></div>
                                </div>
                                {{--                                #the best products--}}
                                @foreach($products as $product)
                                    <div class="product-card__info">
                                        <div class="product-card__name">
                                            <div>
                                                <div class="product-card__badges">
                                                    <div class="tag-badge tag-badge--خصم">خصم</div>
                                                    <div class="tag-badge tag-badge--جديد">جديد</div>
                                                    <div class="tag-badge tag-badge--رائج">رائج</div>
                                                </div><a href="product-full.html">{{$product->title}}</a>
                                            </div>
                                        </div>
                                        <div class="product-card__rating">
                                            <div class="rating product-card__rating-stars">
                                                <div class="rating__body">
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star rating__star--active"></div>
                                                    <div class="rating__star"></div>
                                                </div>
                                            </div>
                                            <div class="product-card__rating-label">4 on 3 reviews</div>
                                        </div>
                                    </div>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <div class="product-card__price product-card__price--current">{{$product->price}}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                     </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-space block-space--layout--before-footer"></div>
</div><!-- site__body / end -->





</div><!-- site / end -->



<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- quickview-modal / end --><!-- add-vehicle-modal -->
<div id="add-vehicle-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="vehicle-picker-modal modal-dialog modal-dialog-centered">
        <div class="modal-content"><button type="button" class="vehicle-picker-modal__close"><svg width="12"
                                                                                                  height="12">
                    <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
	c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
	C11.2,9.8,11.2,10.4,10.8,10.8z" />
                </svg></button>
            <div class="vehicle-picker-modal__panel vehicle-picker-modal__panel--active">
                <div class="vehicle-picker-modal__title card-title">Add A Vehicle</div>
                <div class="vehicle-form vehicle-form--layout--modal">
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Year">
                            <option value="none">Select Year</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Brand" disabled="disabled">
                            <option value="none">Select Brand</option>
                            <option>Audi</option>
                            <option>BMW</option>
                            <option>Ferrari</option>
                            <option>Ford</option>
                            <option>KIA</option>
                            <option>Nissan</option>
                            <option>Tesla</option>
                            <option>Toyota</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Model" disabled="disabled">
                            <option value="none">Select Model</option>
                            <option>Explorer</option>
                            <option>Focus S</option>
                            <option>Fusion SE</option>
                            <option>Mustang</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Engine" disabled="disabled">
                            <option value="none">Select Engine</option>
                            <option>Gas 1.6L 125 hp AT/L4</option>
                            <option>Diesel 2.5L 200 hp AT/L5</option>
                            <option>Diesel 3.0L 250 hp MT/L5</option>
                        </select></div>
                    <div class="vehicle-form__divider">Or</div>
                    <div class="vehicle-form__item"><input type="text" class="form-control"
                                                           placeholder="Enter VIN number" aria-label="VIN number"></div>
                </div>
                <div class="vehicle-picker-modal__actions"><button type="button"
                                                                   class="btn btn-sm btn-secondary vehicle-picker-modal__close-button">Cancel</button> <button
                        type="button" class="btn btn-sm btn-primary">Add A Vehicle</button></div>
            </div>
        </div>
    </div>
</div><!-- add-vehicle-modal / end --><!-- vehicle-picker-modal -->
<div id="vehicle-picker-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="vehicle-picker-modal modal-dialog modal-dialog-centered">
        <div class="modal-content"><button type="button" class="vehicle-picker-modal__close"><svg width="12"
                                                                                                  height="12">
                    <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
	c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
	C11.2,9.8,11.2,10.4,10.8,10.8z" />
                </svg></button>
            <div class="vehicle-picker-modal__panel vehicle-picker-modal__panel--active" data-panel="list">
                <div class="vehicle-picker-modal__title card-title">Select Vehicle</div>
                <div class="vehicle-picker-modal__text">Select a vehicle to find exact fit parts</div>
                <div class="vehicles-list">
                    <div class="vehicles-list__body"><label class="vehicles-list__item"><span
                                class="vehicles-list__item-radio input-radio"><span class="input-radio__body"><input
                                        class="input-radio__input" name="header-vehicle" type="radio"> <span
                                        class="input-radio__circle"></span> </span></span><span
                                class="vehicles-list__item-info"><span class="vehicles-list__item-name">2011 Ford
										Focus S</span> <span class="vehicles-list__item-details">Engine 2.0L 1742DA L4
										FI Turbo</span> </span><button type="button"
                                                                       class="vehicles-list__item-remove"><svg width="16" height="16">
                                    <path
                                        d="M2,4V2h3V1h6v1h3v2H2z M13,13c0,1.1-0.9,2-2,2H5c-1.1,0-2-0.9-2-2V5h10V13z" />
                                </svg></button></label> <label class="vehicles-list__item"><span
                                class="vehicles-list__item-radio input-radio"><span class="input-radio__body"><input
                                        class="input-radio__input" name="header-vehicle" type="radio"> <span
                                        class="input-radio__circle"></span> </span></span><span
                                class="vehicles-list__item-info"><span class="vehicles-list__item-name">2019 Audi Q7
										Premium</span> <span class="vehicles-list__item-details">Engine 3.0L 5626CC L6
										QK</span> </span><button type="button" class="vehicles-list__item-remove"><svg
                                    width="16" height="16">
                                    <path
                                        d="M2,4V2h3V1h6v1h3v2H2z M13,13c0,1.1-0.9,2-2,2H5c-1.1,0-2-0.9-2-2V5h10V13z" />
                                </svg></button></label></div>
                </div>
                <div class="vehicle-picker-modal__actions"><button type="button"
                                                                   class="btn btn-sm btn-secondary vehicle-picker-modal__close-button">Cancel</button> <button
                        type="button" class="btn btn-sm btn-primary" data-to-panel="form">Add A Vehicle</button>
                </div>
            </div>
            <div class="vehicle-picker-modal__panel" data-panel="form">
                <div class="vehicle-picker-modal__title card-title">Add A Vehicle</div>
                <div class="vehicle-form vehicle-form--layout--modal">
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Year">
                            <option value="none">Select Year</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Brand" disabled="disabled">
                            <option value="none">Select Brand</option>
                            <option>Audi</option>
                            <option>BMW</option>
                            <option>Ferrari</option>
                            <option>Ford</option>
                            <option>KIA</option>
                            <option>Nissan</option>
                            <option>Tesla</option>
                            <option>Toyota</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Model" disabled="disabled">
                            <option value="none">Select Model</option>
                            <option>Explorer</option>
                            <option>Focus S</option>
                            <option>Fusion SE</option>
                            <option>Mustang</option>
                        </select></div>
                    <div class="vehicle-form__item vehicle-form__item--select"><select
                            class="form-control form-control-select2" aria-label="Engine" disabled="disabled">
                            <option value="none">Select Engine</option>
                            <option>Gas 1.6L 125 hp AT/L4</option>
                            <option>Diesel 2.5L 200 hp AT/L5</option>
                            <option>Diesel 3.0L 250 hp MT/L5</option>
                        </select></div>
                    <div class="vehicle-form__divider">Or</div>
                    <div class="vehicle-form__item"><input type="text" class="form-control"
                                                           placeholder="Enter VIN number" aria-label="VIN number"></div>
                </div>
                <div class="vehicle-picker-modal__actions"><button type="button" class="btn btn-sm btn-secondary"
                                                                   data-to-panel="list">Back to list</button> <button type="button"
                                                                                                                      class="btn btn-sm btn-primary">Add A Vehicle</button></div>
            </div>
        </div>
    </div>
</div><!-- vehicle-picker-modal / end --><!-- photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                                                         title="Close (Esc)"></button><!--<button class="pswp__button pswp__button&#45;&#45;share" title="Share"></button>-->
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button
                    class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div><!-- photoswipe / end --><!-- scripts -->


<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- AJAX CDN --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<script type="text/javascript">

    $(document).ready(function () {
        $('#year-dropdown').change(function(){
            let id = $(this).val();

            $('select[name="brand_id"]').empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                }
            });
            // alert(id);
            //call country on region selected
            $.ajax({
                dataType: "json",
                url: "/get-brand/"+id,
                type: "GET",
                _token: '{{csrf_token()}}',
                success: function (data) {

                    // console.log(data);
                    $('select[name="brand_id"]').empty();
                    $.each(data, function(key,data){
                        $('select[name="brand_id"]').append('<option value="'+ data.id +'">'+ data.name_ar +'</option>');
                    });
                },
                error: function(error) {
                    // console.log(error);
                }
            });
        });

        $('#brand-dropdown').change(function(){
            let id = $(this).val();

            // $('select[name="modeel_id"]').empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                }
            });
            // alert(id);
            //call country on region selected
            $.ajax({
                dataType: "json",
                url: "/get-modeel/"+id,
                type: "GET",
                _token: '{{csrf_token()}}',
                success: function (data) {

                    console.log(data);
                    $('select[name="modeel_id"]').empty();
                    $.each(data, function(key,data){
                        $('select[name="modeel_id"]').append('<option value="'+ data.id +'">'+ data.name_ar +'</option>');
                    });
                },
                error: function(error) {
                    // console.log(error);
                }
            });
        });


    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>





@endsection
