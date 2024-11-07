
<x-auth-layout>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <!--begin::Form-->
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}" style="max-width: 400px;">
            @csrf
            <!--begin::Heading-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-gray-900 fw-bolder mb-3">
                    TRANSPARENCIA INSTITUCIONAL
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Separator-->
            <div class="separator separator-content my-14">
                <span class="w-125px text-gray-500 fw-semibold fs-7">Administrador</span>
            </div>
            <!--end::Separator-->

            <!--begin::Input group--->
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="text" placeholder="Correo Electrónico" name="email" autocomplete="off" class="form-control bg-transparent"/>
                <!--end::Email-->
            </div>
            <!--end::Input group--->

            <!--begin::Input group-->
            <div class="fv-row mb-8">
                <!--begin::Password-->
                <input type="password" placeholder="Contraseña" name="password" autocomplete="off" class="form-control bg-transparent"/>
                <!--end::Password-->
            </div>
            <!--end::Input group-->

            <!--begin::Submit button-->
            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    Iniciar Sesión
                </button>
            </div>
            <!--end::Submit button-->
        </form>
        <!--end::Form-->
    </div>

</x-auth-layout>
