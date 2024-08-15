<!doctype html>
<html class="no-js" lang="en">

<head>
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '956248698410070');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=956248698410070&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$icon->title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('header_meta')

    <link rel="shortcut icon" type="image/x-icon" href="{{url('logo_images/'.$icon->icon)}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend_assets/css/plugins.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend_assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <style type="text/css">
        .ui-autocomplete-row {
            padding: 8px;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ccc;
            font-weight: bold;
        }

        .ui-autocomplete-row:hover {
            background-color: #ddd;
        }
    </style>

    @yield('header_css')
</head>

<body>

    <!-- Load Facebook SDK for JavaScript -->
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>






    @if($about != null && $about->contact!= null)
    <div class="whatsapp">
        <a href="https://api.whatsapp.com/send?phone={{$about->contact}}" target="_blank">
            <h5><i class="fab fa-whatsapp fa-3x"></i></h5>
        </a>
    </div>
    @endif



    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay"></div>
    <div class="Offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                    <div class="Offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                        <div class="antomi_message">
                            <p>Store Location : @if($about != null && $about->location!= null) {{$about->location}} @endif</p>

                        </div>
                        <div class="header_top_settings text-right">
                            <ul>

                                <li>Hotline : <a href="tel:+@if($about != null && $about->contact!= null) {{$about->contact}} @endif">@if($about != null && $about->contact!= null) {{$about->contact}} @endif</a></li>
                            </ul>
                        </div>
                        <div class="search_container">
                            <form action="{{url('search/product')}}" method="POST">
                                @csrf
                                {{-- <div class="hover_category">
                                    <select class="select_option" name="category_id" id="categori2" required>
                                        <option selected value="0">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                </select>
                        </div> --}}
                        <!--<div class="search_box">-->
                        <!--    <input type="text" name="product_name" placeholder="Search product..." style="border-left: 2px solid rgb(209, 209, 209)">-->
                        <!--    <button type="submit">Search</button>-->
                        <!--</div>-->
                        </form>
                    </div>

                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{url('/shop')}}">Shop</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{url('about/us')}}">About Us</a>
                            </li>
                        </ul>
                    </div>



                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Offcanvas menu area end-->

    <!--header area start-->
    <header>
        <div class="main_header">
            <div>
                <!--header top start-->
                <div class="header_top">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-5">
                                <div class="antomi_message">
                                    <p><i class="fa fa-map-marker" style="color:rgb(182, 16, 16)"></i> @if($about != null && $about->location!= null) {{$about->location}} @endif &nbsp;&nbsp;&nbsp; @if($about != null && $about->contact!= null) {{$about->contact}}(বিকাশ পেমেন্ট) @endif</p>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7">
                                <div class="header_top_settings text-right">
                                    <ul>

                                        <li><i class="fa fa-phone" style="color:rgb(182, 16, 16)"></i> <a href="tel:+@if($about != null && $about->contact!= null) {{$about->contact}} @endif">@if($about != null && $about->contact!= null) {{$about->contact}} @endif</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header top start-->

                <!--header middel start-->


                <div class="header_middle sticky-header">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-3">
                                <div class="logo">
                                    <a href="{{url('/')}}"><img class="logo_image" src="{{url('logo_images/'.$icon->logo)}}" alt="" style="padding-left:20px"></a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-6">
                                <div class="main_menu menu_position text-center">
                                    <nav>
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="{{url('/')}}">Home</a></li>
                                            <li><a href="{{url('/shop')}}">Shop</a></li>
                                            <li><a href="{{url('/authors')}}">Authors</a></li>
                                            <li><a href="{{url('/publishers')}}">Publishers</a></li>
                                            <li class="d-none d-md-block"><a href="{{url('delivery-process')}}">Delivery & Return Policy</a></li>
                                            <li class="d-none d-md-block"><a href="{{url('faq')}}">FAQ/Help</a></li>
                                            <li class="d-none d-md-block"><a href="{{url('about/us')}}">About Us</a></li>
                                            @guest
                                            <li class="d-none d-md-block"><a href="{{url('/login')}}">Sign In</a></li>
                                            @endguest

                                            @auth
                                            <li><a href="{{url('/customer/dashboard')}}">Dashboard</a></li>
                                            @endauth

                                            @auth
                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                            @endauth

                                        </ul>
                                    </nav>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-3 col-3 pe-3">
                                <div class="header_configure_area">

                                    <div class="mini_cart_wrapper">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-shopping-bag"></i>
                                            @php
                                            $amount = 0;
                                            foreach ($cart as $key => $value) {
                                            $amount = $amount+($value->price*$value->qty);
                                            }
                                            @endphp
                                            <span class="cart_price">Tk. {{$amount}} <i class="ion-ios-arrow-down"></i></span>
                                            <span class="cart_count">{{$cart_number}}</span>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header middel end-->

                <!--mini cart-->
                <div class="mini_cart">
                    <div class="cart_close">
                        <div class="cart_text">
                            <h3>cart</h3>
                        </div>
                        <div class="mini_cart_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                    </div>

                    @foreach ($cart as $item)
                    <div class="cart_item">
                        <div class="cart_img">
                            <a href="{{url('product/details')}}/{{$item->product_slug}}"><img src="{{url('product_images/'.$item->product_image)}}" alt=""></a>
                        </div>
                        <div class="cart_info">
                            <a href="{{url('product/details')}}/{{$item->product_slug}}">{{$item->product_name}}</a>
                            <p>Qty: {{$item->qty}} X <span> Tk. {{$item->price}} </span></p>
                        </div>
                        <div class="cart_remove">
                            <a href="{{url('delete/cart/item')}}/{{$item->id}}"><i class="ion-android-close"></i></a>
                        </div>
                    </div>
                    @endforeach

                    <div class="mini_cart_table">
                        <div class="cart_total">
                            <span>Sub total:</span>
                            <span class="price">Tk. {{$amount}}</span>
                        </div>
                    </div>
                    <div class="mini_cart_footer">
                        <div class="cart_button">
                            <a href="{{url('view/cart')}}">View cart</a>
                        </div>
                        <div class="cart_button">
                            @if(App\Cart::where('random_number',session('random_number'))->exists())
                            <a class="active" href="{{url('checkout/page')}}">Checkout</a>
                            @endif
                        </div>

                    </div>
                </div>

                <!--mini cart end-->

                <!--header bottom satrt-->
                <div class="header_bottom">
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-lg-9 col-md-9 col-12">
                                <div class="search_container">
                                    <form action="{{url('search/product')}}" method="POST" id="searchForm">
                                        @csrf

                                        <div class="search_box">
                                            <div id="typewriter-container"></div>
                                            <input type="text" id="search_data" name="slug" autocomplete="off" placeholder="বই, লেখক অথবা প্রকাশনীর নাম লিখুন" style="border-left: 2px solid rgb(209, 209, 209)">

                                            <button type="submit">Search</button>
                                        </div>


                                        <ul class="list-group" id="result"></ul>

                                    </form>
                                </div>

                            </div>
                            <!-- <div class="column3 col-lg-3 col-md-6">
                                <div class="header_bigsale">
                                    <a href="{{url('offer/products')}}">Offer Products/Price Dropped</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!--header bottom end-->
            </div>
        </div>
    </header>
    <!--header area end-->



    @yield('content')


    <!--footer area start-->
    <footer class="footer_widgets">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="widgets_container contact_us">
                            <h3>@if($icon->title != null){{$icon->title}}@endif</h3>
                            <div class="dd">
                                @if($footer != null && $footer->footer_text != null)<p style="color:#fff;">{!! $footer->footer_text !!}</p>@endif
                            </div>
                        </div>


                    </div>


                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="widgets_container widget_menu">
                            <h3>Useful Link</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="{{url('about/us')}}">About Us</a></li>
                                    <li><a href="{{url('view/cart')}}">Cart</a></li>
                                    <!-- <li><a href="{{url('wish/list')}}">WishList</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7 col-sm-12">
                        <div class="widgets_container">
                            <h3>CONTACT INFO</h3>
                            <div class="footer_contact">
                                <div class="footer_contact_inner">
                                    <div class="contact_icone">
                                        <img src="{{url('/')}}/frontend_assets/img/icon/icon-phone.png" alt="">
                                    </div>
                                    <div class="contact_text">
                                        <p>Hotline Number: <br> <strong>@if($about != null && $about->contact != null) {{$about->contact}} @endif</strong></p>
                                    </div>
                                </div>
                                <p>@if($about != null && $about->location != null) {{$about->location}} @endif</p>
                            </div>

                            <div class="footer_social">
                                <ul>
                                    <li><a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-square"></i></a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright_area">
                            @if($footer != null && $footer->copyright_text != null){!! $footer->copyright_text !!}@endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer_payment text-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{url('/')}}/frontend_assets/js/plugins.js"></script>
    <script src="{{url('/')}}/frontend_assets/js/main.js"></script>
    {{-- <script src="https://kit.fontawesome.com/b98d090fd4.js" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    @yield('footer_js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    {!! Toastr::message() !!}

    <script>
        $(document).ready(function() {


            var typed = new Typed('#typewriter-container', {
                strings: ['বই, লেখক অথবা প্রকাশনীর নাম লিখুন', 'অর্থনীতি প্রকাশনীর নাম লিখুন।'],
                typeSpeed: 50,
                backSpeed: 25,
                loop: true
            });

            $('#search_data').autocomplete({

                source: "/api/product/search",
                minLength: 1,
                select: function(event, ui) {
                    console.log(ui)
                    $('#search_data').val(ui.item.value);
                    $('#slug').val(ui.item.slug);
                    $('#searchForm').submit();
                }

            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };
        });
    </script>

    <script>


    </script>

</body>

</html>