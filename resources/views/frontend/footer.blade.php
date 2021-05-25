
  <!-- FOOTER -->
  <footer style="background-color: #555; color: #fff">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h4 class="space30">{{ __('setting.app_name') }}</h4>
          {{ __('setting.description') }}</br>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.6261458376875!2d{{ __('setting.map_long') }}!3d{{ __('setting.map_lat') }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c8b445f408f%3A0x938ca02e638223e9!2sRabat%20Agdal!5e0!3m2!1sen!2sus!4v1621473141992!5m2!1sen!2sus" style="border:0;width: 100%;height: 250px;" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

          <br><br>
        </div>
      </div>
    </div>
  </footer>

  <!-- FOOTER COPYRIGHT -->
  <div class="footer-" style="background: #110f0f;padding: 20px 0 10px 0;">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <p style="color: #fff;">&copy; {{ __('setting.app_name') }} - {{ date('Y') }}</p>
        </div>
        <div class="col-md-4">
          <div class="f-social pull-left">
            <a class="fa fa-youtube" href="{{ __('setting.youtube') }}" target="_blank"></a>
            <a class="fa fa-facebook" href="{{ __('setting.facebook') }}" target="_blank"></a>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>