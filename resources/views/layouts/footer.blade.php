<footer class="ps-footer">
    <div class="container">
        <div class="ps-footer--contact">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <p class="contact__title">যোগাযোগ</p>
                    <p><b><i class="icon-telephone"> </i>Hotline: </b><span>(7:00 - 21:30)</span></p>
                    <p class="telephone">{{ $company->phone}}</p>
                    <p> <b>Head office: </b>{{ $company->address}}</p>
                    <p> <b>Email us: </b>{{ $company->email }}</p>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <p class="contact__title">প্রয়োজনীয় লিংক<span class="footer-toggle"><i
                                        class="icon-chevron-down"></i></span></p>
                            <ul class="footer-list">
                                <li><a href="#">আমাদের সম্পর্কে</a></li>
                                <li><a href="#">যোগাযোগ করুন</a></li>
                                <li><a href="#">প্রশ্নোত্তর</a></li>
                                <li><a href="#">শর্তাবলী</a></li
                            </ul>
                            <hr>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p class="contact__title">Corporate<span class="footer-toggle"><i
                                        class="icon-chevron-down"></i></span></p>
                            <ul class="footer-list">
                                <li><a href="#">Become a Vendor</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Farm Business</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Our Suppliers</a></li>
                                <li><a href="#">Accessibility</a></li>
                            </ul>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <p class="contact__title">Newsletter Subscription</p>
                    <p>Join our email subscription now to get updates on <b>promotions </b>and <b>coupons.</b></p>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="icon-envelope"></i></div>
                        <input class="form-control" type="text" placeholder="Enter your email...">
                        <div class="input-group-append">
                            <button class="btn">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ps-footer__copyright">
            <div class="col-12 col-lg-6 ps-footer__text">&copy; {{ date("Y")}} Tara Hura Life. All Rights Reversed.
            </div>
            <div class="col-12 col-lg-6 ps-footer__social"> 
                <a class="icon_social facebook" href="#">
                    <i class="fa fa-facebook-f"></i> 
                </a>
                <a class="icon_social twitter" href="#">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="icon_social google" href="#">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a class="icon_social youtube" href="#">
                    <i class="fa fa-youtube"></i>
                </a>
                <a class="icon_social wifi" href="#">
                    <i class="fa fa-wifi"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
