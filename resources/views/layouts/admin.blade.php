<!doctype html>
<html lang="en">
<!--begin::Head-->
@include('layouts.partials.admin.header')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('layouts.partials.admin.navbar')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('layouts.partials.admin.sidebar')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-center">
                            <h3 class="mb-0">@yield('title')</h3>
                            @if(View::hasSection('name_btn_add') && View::hasSection('link_btn_add'))
                            <a href="@yield('link_btn_add')" class="ms-3 btn btn-xs btn-sm btn-outline-primary shadow bi bi-plus-lg"> @yield('name_btn_add') </a>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            @if(View::hasSection('title_cache') && View::hasSection('link_cache'))
                            <a class=" float-sm-end btn btn-sm btn-warning " href="@yield('link_cache')"><i class="bi bi-trash3-fill"></i> @yield('title_cache')</a>
                            @else
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                            @endif
                        </div>
                    </div>
                    <!--end::Row-->
                    <!-- begin::Alerts -->
                    <div class="row">
                        <div class="col">
                            @include('layouts.partials.admin.alerts')
                        </div>
                    </div>
                    <!-- end::Alerts -->

                </div>
                <!--end::Container-->
            </div>
            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
            <link rel="preload" as="script" href="//bizweb.dktcdn.net/assets/themes_support/api.jquery.js">

            <script src="//bizweb.dktcdn.net/assets/themes_support/api.jquery.js" type="text/javascript"></script>

            <div class="app-content">
                <!--begin::Container-->
                @yield('content')
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('layouts.partials.admin.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::All JavaScript dependencies are now handled by Vite.-->
    {{-- Tất cả JS dependencies (OverlayScrollbars, Popper, Bootstrap, AdminLTE) được load qua Vite --}}
    @vite(['resources/js/app.js'])
    <!--end::Required Plugin(AdminLTE)-->
    <!--All JavaScript configuration is now handled in app.js-->
    <!-- OPTIONAL SCRIPTS -->

    <!-- simple-notify -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.js"></script>

    <!-- jQuery đã được load trong header -->
    <!-- end:simple-notify  -->

    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
        crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        /* apexcharts
         * -------
         * Here we will create a few charts using apexcharts
         */

        //-----------------------
        // - MONTHLY SALES CHART -
        //-----------------------

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 180,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        // const sales_chart = new ApexCharts(
        //     document.querySelector('#sales-chart'),
        //     sales_chart_options,
        // );
        // sales_chart.render();

        //---------------------------
        // - END MONTHLY SALES CHART -
        //---------------------------

        // function createSparklineChart(selector, data) {
        //     const options = {
        //         series: [{
        //             data
        //         }],
        //         chart: {
        //             type: 'line',
        //             width: 150,
        //             height: 30,
        //             sparkline: {
        //                 enabled: true,
        //             },
        //         },
        //         colors: ['var(--bs-primary)'],
        //         stroke: {
        //             width: 2,
        //         },
        //         tooltip: {
        //             fixed: {
        //                 enabled: false,
        //             },
        //             x: {
        //                 show: false,
        //             },
        //             y: {
        //                 title: {
        //                     formatter() {
        //                         return '';
        //                     },
        //                 },
        //             },
        //             marker: {
        //                 show: false,
        //             },
        //         },
        //     };

        //     const chart = new ApexCharts(document.querySelector(selector), options);
        //     chart.render();
        // }

        // const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
        // const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
        // const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
        // const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
        // const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
        // const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
        // const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

        // createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
        // createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
        // createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
        // createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
        // createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
        // createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
        // createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

        //-------------
        // - PIE CHART -
        //-------------

        const pie_chart_options = {
            series: [700, 500, 400, 600, 300, 100],
            chart: {
                type: 'donut',
            },
            labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
            dataLabels: {
                enabled: false,
            },
            colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
        };

        // const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
        // pie_chart.render();

        //-----------------
        // - END PIE CHART -
        //-----------------

        // Color Mode Toggler
        (() => {
            "use strict";

            const storedTheme = localStorage.getItem("theme");

            const getPreferredTheme = () => {
                if (storedTheme) {
                    return storedTheme;
                }

                return window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "dark" :
                    "light";
            };

            const setTheme = function(theme) {
                const sidebar = document.querySelector(".app-sidebar");
                const effectiveTheme =
                    theme === "auto" && window.matchMedia("(prefers-color-scheme: dark)").matches ?
                    "dark" :
                    theme;

                document.documentElement.setAttribute("data-bs-theme", effectiveTheme);
                // if (sidebar) {
                //     sidebar.setAttribute("data-bs-theme", effectiveTheme);
                // }
            };


            setTheme(getPreferredTheme());

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector("#bd-theme");

                if (!themeSwitcher) {
                    return;
                }

                const themeSwitcherText = document.querySelector("#bd-theme-text");
                const activeThemeIcon = document.querySelector(".theme-icon-active i");
                const btnToActive = document.querySelector(
                    `[data-bs-theme-value="${theme}"]`
                );
                const svgOfActiveBtn = btnToActive.querySelector("i").getAttribute("class");

                for (const element of document.querySelectorAll("[data-bs-theme-value]")) {
                    element.classList.remove("active");
                    element.setAttribute("aria-pressed", "false");
                }

                btnToActive.classList.add("active");
                btnToActive.setAttribute("aria-pressed", "true");
                activeThemeIcon.setAttribute("class", svgOfActiveBtn);
                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
                themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

                if (focus) {
                    themeSwitcher.focus();
                }
            };

            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addEventListener("change", () => {
                    if (storedTheme !== "light" || storedTheme !== "dark") {
                        setTheme(getPreferredTheme());
                    }
                });

            window.addEventListener("DOMContentLoaded", () => {
                showActiveTheme(getPreferredTheme());

                for (const toggle of document.querySelectorAll("[data-bs-theme-value]")) {
                    toggle.addEventListener("click", () => {
                        const theme = toggle.getAttribute("data-bs-theme-value");
                        localStorage.setItem("theme", theme);
                        setTheme(theme);
                        showActiveTheme(theme, true);
                    });
                }
            });
        })();
    </script>

    @stack('scripts')
    <!--end::Script-->
</body>
<!--end::Body-->

</html>