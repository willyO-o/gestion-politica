<footer class="section footer-classic footer-classic-dark context-dark">
    <div class="footer-classic-main">
        <div class="container">
            {{-- <p class="heading-7">Subscribe to our Newsletter</p>
            <!-- RD Mailform-->
            <form class="rd-mailform rd-form rd-inline-form-creative" data-form-output="form-output-global"
                data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                <div class="form-wrap">
                    <div class="form-input-wrap">
                        <input class="form-input" id="footer-form-email" type="email" name="email"
                            data-constraints="Required">
                        <label class="form-label" for="footer-form-email">Enter your E-mail</label>
                    </div>
                </div>
                <div class="form-button">
                    <button class="button button-primary-outline" type="submit" aria-label="Send"><span
                            class="icon fl-budicons-launch-right164"></span></button>
                </div>
            </form> --}}
            <div class="row row-50">
                <div class="col-lg-6 text-center text-sm-start">
                    <article
                        class="unit unit-sm-horizontal unit-middle justify-content-center justify-content-sm-start footer-classic-info">
                        <div class="unit-left"><a class="brand brand-md" href="{{ route('login') }}"><img class="brand-logo "
                                    src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" width="95"
                                    height="126"></a>
                        </div>
                        <div class="unit-body">
                            <p> {{ config('app.constants.full_name') }}</p>
                            <p>Legion Alteña</p>
                        </div>
                    </article>

                    <div class="group-md group-middle">
                        <div class="group-item">
                            <ul class="list-inline list-inline-xs">
                                <li><a class="icon icon-corporate fa fa-facebook" href="https://www.facebook.com/alcaldevaliente"  target="_blank"></a></li>
                                <li><a class="icon icon-corporate fa fa-whatsapp" href="#" target="_blank"></a>
                                </li>
                                <li><a class="icon icon-corporate fa fa-instagram" href="#"  target="_blank"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5> Dirección Central</h5>
                    <div class="divider-small divider-secondary"></div>
                    <div class="row row-20">
                        <div class="col-sm-6">
                            <!-- Post Classic-->
                            <article class="post-classic">

                                <div class="post-classic-main">

                                    <p class="post-classic-title"><a href="#">
                                        <i class="fa fa-map-marker"></i>
                                        El Alto</a></p>
                                    <p class="post-classic-title">
                                        La Paz - Bolivia
                                    </p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-classic-aside footer-classic-darken">
        <div class="container">
            <div class="layout-justify">
                <!-- Rights-->
                <p class="rights"><span>WalterPaco - WillyChana</span><span>&nbsp;&copy;&nbsp;</span><span
                        class="copyright-year"></span><span>.&nbsp;</span><a class="link-underline"
                        href="#">R.T.</a></p>
                <nav class="nav-minimal">
                    <ul class="nav-minimal-list">
                        <li class="active"><a href="{{route('login')}}">LOGIN</a></li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
