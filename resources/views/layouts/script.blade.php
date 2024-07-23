<!-- latest jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- scrollbar js-->
<script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script id="menu" src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
@yield('script')

@if (Route::current()->getName() != 'popover')
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
{{-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> --}}

<!-- bootstrap notify js -->
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/notify/notify-script.js"></script>

{{-- @if (Route::current()->getName() == 'index')
	<script src="{{asset('assets/js/layout-change.js')}}"></script>
@endif --}}

@if (Route::currentRouteName() == 'index')
    <script>
        new WOW().init();
    </script>
@endif

<script src="{{ asset('assets/js/toastify/toastify-js.js') }}"></script>

{{-- Custom Scripts --}}
<script>
    function toggleModal(checkboxId, event) {
        // if (event.target.checked) {
        //     $('#summaryModal').modal('show');
        // } else {
        //     $('#summaryModal').modal('hide');
        // }

        if (event.target.checked) {
            $('#termsModal').modal('show');
        } else {
            $('#termsModal').modal('hide');
        }
    }

    function formatPeso(input) {
        // Remove non-numeric characters
        let value = input.value.replace(/\D/g, '');

        // Format the number as Philippine peso
        value = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
        }).format(value / 100);

        // Update the input value
        input.value = value;
    }

    const dropdown = document.getElementById('optional');
    const inputText = document.getElementById('inputText');

    if (dropdown.value === 'Y') {
        inputText.style.display = 'block';
    }

    dropdown.addEventListener('change', function() {
        if (dropdown.value === 'Y') {
            inputText.style.display = 'block';
        } else {
            inputText.style.display = 'none';
        }
    });
</script>
