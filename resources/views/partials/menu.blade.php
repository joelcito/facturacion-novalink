<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        {{-- <span class="menu-heading fw-bold text-uppercase fs-7">MENUS</span> --}}
                        <span class="fs-7 text-white fw-boldn">MENUS</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->

                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-university"></i>
                        </span>
                        <span class="menu-title text-white">Administracion</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <div class="menu-sub menu-sub-accordion">

                        <!-- Reporte Procesos -->
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('rol.listado') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Roles</span>
                            </a>
                        </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ route('empresa.listado') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Empresas</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('sucursal.listado') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Sucursales</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('plan.listado') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Planes</span>
                            </a>
                        </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ route('suscripcion.listado') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Suscripciones</span>
                            </a>
                        </div>
                        <!-- NUEVO: Stock Histórico -->
                        {{-- <div class="menu-item">
                            <a class="menu-link" href="{{ route('reporte.stock.formulario') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Stock Histórico</span>
                            </a>
                        </div> --}}
                    </div>
                    <!--end:Menu link-->
                </div>

                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
</div>
