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
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 h-100" style="background-image: url({{ image('misc/auth-bg.png') }})">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100 h-100">
                <!--begin::Logo-->
                <a href="{{ route('dashboard') }}" class="mb-12">
                    <img alt="Logo" src="{{ image('logos/custom-1.png') }}" class="h-60px h-lg-75px"/>
                </a>
                <!--end::Logo-->

                <!--begin::Image-->
                <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ image('misc/auth-screens.png') }}" alt=""/>
                <!--end::Image-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::App-->

@endsection
