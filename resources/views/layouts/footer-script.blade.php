  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  {{-- <script>
      $.widget.bridge('uibutton', $.ui.button)
  </script> --}}
  @yield('script')
  <!-- Bootstrap 4 -->
  {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  {{-- SweetAlert --}}
  <script>
      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });
      @if (session('sweetAlert'))
          Toast.fire({
              icon: '{{ session('sweetAlert.icon') }}',
              title: '{{ session('sweetAlert.title') }}'
          });
      @endif
  </script>
  {{-- pwa --}}
  <script src="{{ asset('/sw.js') }}"></script>
  <script>
      if ("serviceWorker" in navigator) {
          // Register a service worker hosted at the root of the
          // site using the default scope.
          navigator.serviceWorker.register("/sw.js").then(
              (registration) => {
                  console.log("Service worker registration succeeded:", registration);
              },
              (error) => {
                  console.error(`Service worker registration failed: ${error}`);
              },
          );
      } else {
          console.error("Service workers are not supported.");
      }
  </script>
  @yield('script-bottom')
