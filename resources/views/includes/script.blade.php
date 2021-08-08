<!-- Bootstrap core JavaScript -->
        <script src="/vendor/jquery/jquery.slim.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        <script src="/script/navbar-scroll.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            //sweetalert script

            @if (session()->has('success'))

                swal({
                    type: "success",
                    icon: "success",
                    title: "BERHASIL!"
                    text: "{{ session('success') }}",
                    timer: 1500,
                    showConfirmButton: false,
                    showCancelButton: false,
                    button: false,
                });
            @elseif (session()->has('error'))
                swal({
                    type: "error",
                    icon: "error",
                    title: "GAGAL!"
                    text: "{{ session('error') }}",
                    timer: 1500,
                    showConfirmButton: false,
                    showCancelButton: false,
                    button: false,
                });
            @endif
        </script>
        <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6106ca6e234a3100191b962e&product=inline-share-buttons" async="async"></script>