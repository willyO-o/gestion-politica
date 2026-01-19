@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container text-center">





            {{-- <div class="row row-50 text-start">
                <div class="col-md-12">
                    <div class="row row-50">
                        <div class="col-lg-6">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Billing Address
                                    </h5>
                                </div>
                            </article>
                            <form class="rd-form">
                                <div class="form-wrap">
                                    <div class="row row-10 row-narrow">
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-first-name">First Name</label>
                                                <input class="form-input" id="biling-first-name" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-family-name">Family Name</label>
                                                <input class="form-input" id="biling-family-name" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-company">Company</label>
                                                <input class="form-input" id="biling-company" type="text" name="name"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-address">Address</label>
                                                <input class="form-input" id="biling-address" type="text" name="name"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-country">Country</label>
                                                <input class="form-input" id="biling-country" type="text" name="name"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-city">City/Town</label>
                                                <input class="form-input" id="biling-city" type="text" name="name"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-apartment">Apartment/Suite No.</label>
                                                <input class="form-input" id="biling-apartment" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="biling-phone">Phone</label>
                                                <input class="form-input" id="biling-phone" type="text" name="phone"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Delivery Address
                                    </h5>
                                </div>
                            </article>
                            <form class="rd-form">
                                <div class="form-wrap">
                                    <div class="row row-10 row-narrow">
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-first-name">First Name</label>
                                                <input class="form-input" id="addres-first-name" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-family-name">Family Name</label>
                                                <input class="form-input" id="addres-family-name" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-company">Company</label>
                                                <input class="form-input" id="addres-company" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-address">Address</label>
                                                <input class="form-input" id="addres-address" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-country">Country</label>
                                                <input class="form-input" id="addres-country" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-city">City/Town</label>
                                                <input class="form-input" id="addres-city" type="text" name="name"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-apartment">Apartment/Suite
                                                    No.</label>
                                                <input class="form-input" id="addres-apartment" type="text"
                                                    name="name" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-wrap">
                                                <label class="form-label" for="addres-phone">Phone</label>
                                                <input class="form-input" id="addres-phone" type="text"
                                                    name="phone" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <label class="checkbox-inline checkbox-inline-lg checkbox-light">
                            <input name="input-checkbox-1" value="checkbox-1" type="checkbox">My Billing Address And
                            Shipping Address are The Same
                        </label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Your shopping cart
                            </h5>
                        </div>
                    </article>
                    <div class="product-cart">
                        <div class="table-custom-responsive">
                            <table class="table-custom table-product">
                                <thead>
                                    <tr>
                                        <th>Product name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-cart-name"><a class="product-cart-media"
                                                    href="product-page.html"><img src="images/shop/product-cart-1.png"
                                                        alt=""></a>
                                                <p class="product-cart-title"><a href="product-page.html">Nike Air Zoom
                                                        Pegasus</a></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-color product-cart-color-red"></div>
                                        </td>
                                        <td>
                                            <div class="product-cart-size"><span>M</span></div>
                                        </td>
                                        <td>
                                            <div class="stepper-modern">
                                                <input class="form-input" type="number" data-zeros="true"
                                                    value="1" min="1" max="100">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-price"><span>$290</span></div>
                                        </td>
                                        <td>
                                            <div class="product-cart-delete"><span
                                                    class="icon fl-bigmug-line-recycling10"></span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-cart-name"><a class="product-cart-media"
                                                    href="product-page.html"><img src="images/shop/product-cart-2.png"
                                                        alt=""></a>
                                                <p class="product-cart-title"><a href="product-page.html">Nike dark grey
                                                        snapback</a></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-color product-cart-color-dark"></div>
                                        </td>
                                        <td>
                                            <div class="product-cart-size"><span>M</span></div>
                                        </td>
                                        <td>
                                            <div class="stepper-modern">
                                                <input class="form-input" type="number" data-zeros="true"
                                                    value="1" min="1" max="100">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-cart-price"><span>$290</span></div>
                                        </td>
                                        <td>
                                            <div class="product-cart-delete"><span
                                                    class="icon fl-bigmug-line-recycling10"></span></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Payment Methods
                            </h5>
                        </div>
                    </article>
                    <div class="card-shop">
                        <ul class="list-md form-wrap">
                            <li>
                                <div class="radio-panel">
                                    <label class="radio-inline radio-inline-lg active">
                                        <input name="input-radio" value="radio-1" type="radio" checked="">Direct
                                        Bank Transfer
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>
                                            Make your payment directly to our bank account. Please use your OrderID as the
                                            payment reference. Contact support for more information.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="radio-panel">
                                    <label class="radio-inline radio-inline-lg">
                                        <input name="input-radio" value="radio-2" type="radio">PayPal
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State /
                                            County, Store Postcode.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="radio-panel">
                                    <label class="radio-inline radio-inline-lg">
                                        <input name="input-radio" value="radio-3" type="radio">Cheque Payment
                                    </label>
                                    <div class="radio-panel-content">
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                            account.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Cart Total
                            </h5>
                        </div>
                    </article>
                    <div class="table-custom-responsive">
                        <table class="table-custom card-shop-table">
                            <tr>
                                <td>cart subtotal</td>
                                <td>$580</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>$580</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> --}}
            <a class="button button-lg button-primary" href="#">Proximamente</a>
        </div>
    </section>
@endsection




@extends('public.layouts.base')


@section('css')
@endsection

@section('breadcrumb')
    <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="images/bg-breadcrumbs-1-1920x726.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <h3 class="breadcrumbs-custom-title">Inscripciones</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active">Inscripción Online</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')
@endsection
