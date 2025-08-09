 <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="index.html" class="header-logo">
                    <img src="{{ URL::asset('assets/images/brand-logos/desktop-logo1.png')}}" alt="logo" class="desktop-logo">
                    <img src="{{ URL::asset('assets/images/brand-logos/toggle-logo1.png')}}" alt="logo" class="toggle-logo">
                    <img src="{{ URL::asset('assets/images/brand-logos/desktop-white1.png')}}" alt="logo" class="desktop-white">
                    <img src="{{ URL::asset('assets/images/brand-logos/toggle-white1.png')}}" alt="logo" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">General</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>cog-box</title><path d="M17.25,12C17.25,12.23 17.23,12.46 17.2,12.68L18.68,13.84C18.81,13.95 18.85,14.13 18.76,14.29L17.36,16.71C17.27,16.86 17.09,16.92 16.93,16.86L15.19,16.16C14.83,16.44 14.43,16.67 14,16.85L13.75,18.7C13.72,18.87 13.57,19 13.4,19H10.6C10.43,19 10.28,18.87 10.25,18.7L10,16.85C9.56,16.67 9.17,16.44 8.81,16.16L7.07,16.86C6.91,16.92 6.73,16.86 6.64,16.71L5.24,14.29C5.15,14.13 5.19,13.95 5.32,13.84L6.8,12.68C6.77,12.46 6.75,12.23 6.75,12C6.75,11.77 6.77,11.54 6.8,11.32L5.32,10.16C5.19,10.05 5.15,9.86 5.24,9.71L6.64,7.29C6.73,7.13 6.91,7.07 7.07,7.13L8.81,7.84C9.17,7.56 9.56,7.32 10,7.15L10.25,5.29C10.28,5.13 10.43,5 10.6,5H13.4C13.57,5 13.72,5.13 13.75,5.29L14,7.15C14.43,7.32 14.83,7.56 15.19,7.84L16.93,7.13C17.09,7.07 17.27,7.13 17.36,7.29L18.76,9.71C18.85,9.86 18.81,10.05 18.68,10.16L17.2,11.32C17.23,11.54 17.25,11.77 17.25,12M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M12,10C10.89,10 10,10.89 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12C14,10.89 13.1,10 12,10Z" /></svg>
                                <span class="side-menu__label">Apps</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0);">Apps</a>
                                </li>
                                <li class="slide {{ Route::is('roles.index')  || Route::is('roles.edit')  ||  Route::is('roles.create') ? 'active' : '' }}">
                                    <a href="{{ route('roles.index') }}" class="side-menu__item">
                                        <span class="side-menu__label">{{ __('Roles') }}</span>
                                    </a>
                                </li>
                                <li class="slide slide {{ Route::is('permissions.index')  || Route::is('permissions.edit')  ||  Route::is('permissions.create') ? 'active' : '' }}">
                                    <a href="{{route('permissions.index')}}" class="side-menu__item">
                                        <span class="side-menu__label">{{ __('Permissions') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide slide {{ Route::is('users.index')  || Route::is('users.edit')  ||  Route::is('users.create') ? 'active' : '' }}">
                            <a href="{{route('users.index')}}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M10 4A4 4 0 0 0 6 8A4 4 0 0 0 10 12A4 4 0 0 0 14 8A4 4 0 0 0 10 4M10 6A2 2 0 0 1 12 8A2 2 0 0 1 10 10A2 2 0 0 1 8 8A2 2 0 0 1 10 6M17 12C16.84 12 16.76 12.08 16.76 12.24L16.5 13.5C16.28 13.68 15.96 13.84 15.72 14L14.44 13.5C14.36 13.5 14.2 13.5 14.12 13.6L13.16 15.36C13.08 15.44 13.08 15.6 13.24 15.68L14.28 16.5V17.5L13.24 18.32C13.16 18.4 13.08 18.56 13.16 18.64L14.12 20.4C14.2 20.5 14.36 20.5 14.44 20.5L15.72 20C15.96 20.16 16.28 20.32 16.5 20.5L16.76 21.76C16.76 21.92 16.84 22 17 22H19C19.08 22 19.24 21.92 19.24 21.76L19.4 20.5C19.72 20.32 20.04 20.16 20.28 20L21.5 20.5C21.64 20.5 21.8 20.5 21.8 20.4L22.84 18.64C22.92 18.56 22.84 18.4 22.76 18.32L21.72 17.5V16.5L22.76 15.68C22.84 15.6 22.92 15.44 22.84 15.36L21.8 13.6C21.8 13.5 21.64 13.5 21.5 13.5L20.28 14C20.04 13.84 19.72 13.68 19.4 13.5L19.24 12.24C19.24 12.08 19.08 12 19 12H17M10 13C7.33 13 2 14.33 2 17V20H11.67C11.39 19.41 11.19 18.77 11.09 18.1H3.9V17C3.9 16.36 7.03 14.9 10 14.9C10.43 14.9 10.87 14.94 11.3 15C11.5 14.36 11.77 13.76 12.12 13.21C11.34 13.08 10.6 13 10 13M18.04 15.5C18.84 15.5 19.5 16.16 19.5 17.04C19.5 17.84 18.84 18.5 18.04 18.5C17.16 18.5 16.5 17.84 16.5 17.04C16.5 16.16 17.16 15.5 18.04 15.5Z" /></svg>
                                <span class="side-menu__label">{{ __('Users') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Data Utama</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide {{ Route::is('opd.index')  || Route::is('opd.edit')  ||  Route::is('opd.create') ? 'active' : '' }}">
                            <a href="{{ route('opd.index') }}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>office-building-cog-outline</title><path d="M17 13C16.87 13 16.76 13.09 16.74 13.21L16.55 14.53C16.25 14.66 15.96 14.82 15.7 15L14.46 14.5C14.35 14.5 14.22 14.5 14.15 14.63L13.15 16.36C13.09 16.47 13.11 16.6 13.21 16.68L14.27 17.5C14.25 17.67 14.24 17.83 14.24 18S14.25 18.33 14.27 18.5L13.21 19.32C13.12 19.4 13.09 19.53 13.15 19.64L14.15 21.37C14.21 21.5 14.34 21.5 14.46 21.5L15.7 21C15.96 21.18 16.24 21.35 16.55 21.47L16.74 22.79C16.76 22.91 16.86 23 17 23H19C19.11 23 19.22 22.91 19.24 22.79L19.43 21.47C19.73 21.34 20 21.18 20.27 21L21.5 21.5C21.63 21.5 21.76 21.5 21.83 21.37L22.83 19.64C22.89 19.53 22.86 19.4 22.77 19.32L21.7 18.5C21.72 18.33 21.74 18.17 21.74 18S21.73 17.67 21.7 17.5L22.76 16.68C22.85 16.6 22.88 16.47 22.82 16.36L21.82 14.63C21.76 14.5 21.63 14.5 21.5 14.5L20.27 15C20 14.82 19.73 14.65 19.42 14.53L19.23 13.21C19.22 13.09 19.11 13 19 13H17M18 16.5C18.83 16.5 19.5 17.17 19.5 18S18.83 19.5 18 19.5C17.16 19.5 16.5 18.83 16.5 18S17.17 16.5 18 16.5M10 5H12V7H10V5M16 7H14V5H16V7M14 9H16V11H14V9M10 9H12V11H10V9M13.11 23H2V1H20V11.29C19.37 11.11 18.7 11 18 11V3H4V21H10V17.5H11.03C11 17.67 11 17.83 11 18C11 19.96 11.81 21.73 13.11 23M8 15H6V13H8V15M8 11H6V9H8V11M8 7H6V5H8V7M6 17H8V19H6V17M10 13H12V14.41C11.89 14.6 11.78 14.8 11.68 15H10V13Z" /></svg>
                                <span class="side-menu__label">{{ __('Data OPD') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ Route::is('rekanan.index')  || Route::is('rekanan.edit')  ||  Route::is('rekanan.create') ? 'active' : '' }}">
                            <a href="{{route('rekanan.index')}}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>content-save-cog</title><path d="M21 11.7V7L17 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H11.7C11.4 20.3 11.2 19.6 11.1 18.8C9.9 18.4 9 17.3 9 16C9 14.3 10.3 13 12 13C12.3 13 12.6 13.1 12.9 13.2C14.2 11.8 16 11 18 11C19.1 11 20.1 11.2 21 11.7M15 9H5V5H15V9M21.7 18.6V17.6L22.8 16.8C22.9 16.7 23 16.6 22.9 16.5L21.9 14.8C21.9 14.7 21.7 14.7 21.6 14.7L20.4 15.2C20.1 15 19.8 14.8 19.5 14.7L19.3 13.4C19.3 13.3 19.2 13.2 19.1 13.2H17.1C16.9 13.2 16.8 13.3 16.8 13.4L16.6 14.7C16.3 14.9 16.1 15 15.8 15.2L14.6 14.7C14.5 14.7 14.4 14.7 14.3 14.8L13.3 16.5C13.3 16.6 13.3 16.7 13.4 16.8L14.5 17.6V18.6L13.4 19.4C13.3 19.5 13.2 19.6 13.3 19.7L14.3 21.4C14.4 21.5 14.5 21.5 14.6 21.5L15.8 21C16 21.2 16.3 21.4 16.6 21.5L16.8 22.8C16.9 22.9 17 23 17.1 23H19.1C19.2 23 19.3 22.9 19.3 22.8L19.5 21.5C19.8 21.3 20 21.2 20.3 21L21.5 21.4C21.6 21.4 21.7 21.4 21.8 21.3L22.8 19.6C22.9 19.5 22.9 19.4 22.8 19.4L21.7 18.6M18 19.5C17.2 19.5 16.5 18.8 16.5 18S17.2 16.5 18 16.5 19.5 17.2 19.5 18 18.8 19.5 18 19.5Z" /></svg>
                                <span class="side-menu__label">{{ __('Rekanan') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ Route::is('bank.index')  || Route::is('bank.edit')  ||  Route::is('bank.create') ? 'active' : '' }}">
                            <a href="{{route('bank.index')}}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>bank-check</title><path d="M17.8 21.2L15 18.2L16.2 17L17.8 18.6L21.4 15L22.6 16.4L17.8 21.2M13 10H10V17H12.1C12.2 16.2 12.6 15.4 13 14.7V10M16 10V12.3C16.6 12.1 17.3 12 18 12C18.3 12 18.7 12 19 12.1V10H16M12.1 19H2V22H13.5C12.8 21.2 12.3 20.1 12.1 19M21 6L11.5 1L2 6V8H21V6M7 17V10H4V17H7Z" /></svg>
                                <span class="side-menu__label">{{ __('Bank') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ Route::is('dana.index')  || Route::is('dana.edit')  ||  Route::is('dana.create') ? 'active' : '' }}">
                            <a href="{{route('dana.index')}}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" viewBox="0 0 24 24"><title>chart-donut</title><path d="M13,2.05V5.08C16.39,5.57 19,8.47 19,12C19,12.9 18.82,13.75 18.5,14.54L21.12,16.07C21.68,14.83 22,13.45 22,12C22,6.82 18.05,2.55 13,2.05M12,19A7,7 0 0,1 5,12C5,8.47 7.61,5.57 11,5.08V2.05C5.94,2.55 2,6.81 2,12A10,10 0 0,0 12,22C15.3,22 18.23,20.39 20.05,17.91L17.45,16.38C16.17,18 14.21,19 12,19Z" /></svg>
                                <span class="side-menu__label">{{ __('Sumber Dana') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Entry Data</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>book-edit-outline</title><path d="M6 20H11V22H6C4.89 22 4 21.11 4 20V4C4 2.9 4.89 2 6 2H18C19.11 2 20 2.9 20 4V10.3C19.78 10.42 19.57 10.56 19.39 10.74L18 12.13V4H13V12L10.5 9.75L8 12V4H6V20M22.85 13.47L21.53 12.15C21.33 11.95 21 11.95 20.81 12.15L19.83 13.13L21.87 15.17L22.85 14.19C23.05 14 23.05 13.67 22.85 13.47M13 19.96V22H15.04L21.17 15.88L19.13 13.83L13 19.96Z" /></svg>
                                <span class="side-menu__label">BKU</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0);">BKU</a>
                                </li>
                                <li class="slide {{ Route::is('bku-pengeluaran.index')  || Route::is('bku-pengeluaran.edit')  ||  Route::is('bku-pengeluaran.create') ? 'active' : '' }}">
                                    <a href="{{ route('bku-pengeluaran.index') }}" class="side-menu__item">{{ __('BKU Pengeluara') }}</a>
                                </li>
                                <li class="slide {{ Route::is('bku-penerimaan.index')  || Route::is('bku-penerimaan.edit')  ||  Route::is('bku-penerimaan.create') ? 'active' : '' }}">
                                    <a href="{{route('bku-penerimaan.index')}}" class="side-menu__item">{{ __('BKU Penerimaan') }}</a>
                                </li>
                                <li class="slide {{ Route::is('rekap.index')  || Route::is('rekap.edit')  ||  Route::is('rekap.create') ? 'active' : '' }}">
                                    <a href="{{route('rekap.index')}}" class="side-menu__item">{{ __('Data Rekap BKU') }}</a>
                                </li>
                                <li class="slide {{ Route::is('pagupeneriman.index')  || Route::is('pagupeneriman.edit')  ||  Route::is('pagupeneriman.create') ? 'active' : '' }}">
                                    <a href="{{route('pagupeneriman.index')}}" class="side-menu__item">{{ __('Input Pagu Peneriman') }}</a>
                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Laporan</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><title>book-sync-outline</title><path d="M13.5 20C13.81 20.75 14.26 21.42 14.82 22H6C4.89 22 4 21.11 4 20V4C4 2.9 4.89 2 6 2H18C19.11 2 20 2.9 20 4V11.03C19.84 11 19.67 11 19.5 11C19 11 18.5 11.07 18 11.18V4H13V12L10.5 9.75L8 12V4H6V20H13.5M19 20C17.62 20 16.5 18.88 16.5 17.5C16.5 17.1 16.59 16.72 16.76 16.38L15.67 15.29C15.25 15.92 15 16.68 15 17.5C15 19.71 16.79 21.5 19 21.5V23L21.25 20.75L19 18.5V20M19 13.5V12L16.75 14.25L19 16.5V15C20.38 15 21.5 16.12 21.5 17.5C21.5 17.9 21.41 18.28 21.24 18.62L22.33 19.71C22.75 19.08 23 18.32 23 17.5C23 15.29 21.21 13.5 19 13.5Z" /></svg>
                                <span class="side-menu__label">Laporan BKU</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0);">BKU</a>
                                </li>
                                <li class="slide {{ Route::is('laporan.bku.index')  || Route::is('laporan.bku.edit')  ||  Route::is('laporan.bku.create') ? 'active' : '' }}">
                                    <a href="{{route('laporan.bku.index')}}" class="side-menu__item">{{ __('Lap BKU') }}</a>
                                </li>
                                <li class="slide {{ Route::is('laporan.rincianbku.index')  || Route::is('laporan.rincianbku.edit')  ||  Route::is('laporan.rincianbku.create') ? 'active' : '' }}">
                                    <a href="{{route('laporan.rincianbku.index')}}" class="side-menu__item">{{ __('Lap Rincian BKU') }}</a>
                                </li>
                                <li class="slide {{ Route::is('laporan.rekappenerimaan.index')  || Route::is('laporan.rekappenerimaan.edit')  ||  Route::is('laporan.rekappenerimaan.create') ? 'active' : '' }}">
                                    <a href="{{route('laporan.rekappenerimaan.index')}}" class="side-menu__item">{{ __('Lap Rekap Penerimaan') }}</a>
                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->
