@extends('layout.master')

@section('content')
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root min-vh-100" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid h-100">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1 h-100">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid flex-grow-1 h-100">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px">
                        <!--begin::Page-->
                        {{ $slot }}
                        <!--end::Page-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap px-5 mt-auto">
                    <!--begin::Links-->
                    <div class="d-flex fw-semibold text-primary fs-base">
                        <a href="https://cusco.gob.pe/" class="px-5" target="_blank">Municipalidad Provincial del Cusco</a>

                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->

            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 h-100 position-relative"
                style="background-image: url({{ image('misc/auth-bg.webp') }});">
                <!--begin::Content-->
                <div class="d-flex flex-column align-items-center py-5 px-5 px-md-15 w-100 h-100">
                    <!--begin::Logo-->
                    <a href="{{ route('dashboard') }}" class="mb-3 mt-3">
                        <img alt="Logo" src="{{ image('logos/logo-cusco.svg') }}" class="h-100px h-lg-100px" />
                    </a>
                    <!--end::Logo-->

                    <!--begin::Title-->
                    <h2 class="text-white text-center mt-2">Municipalidad Provincial del Cusco</h2>
                    <!--end::Title-->
                </div>
                <!--end::Content-->

                <!--begin::Bottom Image (Visible only on large screens)-->
                <div class="position-absolute bottom-0 w-100 d-none d-lg-block">
                    <img src="{{ image('misc/auth-screens.webp') }}" alt="" class="img-fluid">
                </div>
                <!--end::Bottom Image-->
            </div>



            <!--end::Aside-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::App-->
@endsection
