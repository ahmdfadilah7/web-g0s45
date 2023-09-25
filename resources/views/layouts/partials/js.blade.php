@section('js')
    <!-- Js Plugins -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('berhasil'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
        }
                toastr.success("{{ session('berhasil') }}");
        @endif
        
        @if(Session::has('errors'))
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            @foreach ($errors->all() as $errors)
                toastr.error("{{ $errors }}");
            @endforeach
        @endif
        
        @if(Session::has('warning'))
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.warning("{{ session('warning') }}");
        @endif
    
        var proQty = $('.pro-qty');
        @if (Request::segment(1)=='produk' && Request::segment(2)=='detail')
            proQty.prepend('<span class="dec qtybtn">-</span>');
            proQty.append('<span class="inc qtybtn">+</span>');
        @else
            proQty.prepend('<button class="dec qtybtn">-</button>');
            proQty.append('<button class="inc qtybtn">+</button>');
        @endif
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });
    </script>
@endsection
