@include('layouts.header')

<main>

    @yield('content')


</main>

</div>
</section>


<!-- Start Global Script -->
<script src="{{ asset('assets/scripts/vendor/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/scripts/vendor/popper.min.js') }}"></script>
<script src="{{ asset('assets/scripts/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/scripts/vendor/jquery.validate.min.js') }}"></script>
@if (lang() == 'ar')
    
<script src="{{ asset('assets/scripts/vendor/jquery.validate.ar.js') }}"></script>
@endif
<script src="{{ asset('assets/Font-Awesome/all.min.js') }}"></script>
<script src="{{ asset('assets/scripts/vendor/jquery.nicescroll.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/scripts/vendor/dataTables.bootstrap4.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
@include('layouts.Footer')

<script src="{{ asset('assets/scripts/main.js') }}"></script>
<!-- End Global Script -->


@yield('scripts')
@stack('js')


@if (Session::has('delete'))
<script>
    Swal.fire({
        type: 'error',
        text: 'Something went wrong!',
        title: "{{ Session::get('delete') }}",
        timer: 3000,
        showConfirmButton: false,
    });
</script>
@endif


</body>

</html>

