<template>
    <section id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <div id="kt_header" class="header align-items-stretch">
                        <div class="container-xxl d-flex align-items-stretch justify-content-between w-100">
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15 w-100">
                                <a class="w-100 text-center" href="../../demo1/dist/index.html">
                                    <img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-20px h-lg-30px" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
                                
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body pt-9 pb-0">
                                            <!--begin::Details-->
                                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                                <!--begin: Pic-->
                                                <div class="me-7 mb-4">
                                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                        <img src="assets/media/avatars/300-1.jpg" alt="image">
                                                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                                <!--begin::Info-->
                                                <div class="flex-grow-1">
                                                    <!--begin::Title-->
                                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                                        <!--begin::User-->
                                                        <div class="d-flex flex-column">
                                                            <!--begin::Name-->
                                                            <div class="d-flex align-items-center mb-2">
                                                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ user.name }}</a>
                                                            </div>
                                                            <!--end::Name-->
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-wrap fw-bold fs-6 mb-0 pe-2">
                                                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                                <span class="svg-icon svg-icon-4 me-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                                                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->{{ user.level }} <span v-if="user.type=='student'">- St. Francis</span>
                                                                </a>
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                        <!--end::User-->
                                                        
                                                    </div>
                                                    <!--end::Title-->
                                                    <!--begin::Stats-->
                                                    <div class="d-flex flex-wrap flex-stack">
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex flex-column flex-grow-1 pe-8 pb-8">
                                                            <!--begin::Stats-->
                                                            <div class="d-flex flex-wrap">
                                                                <h4 class="d-block w-100">Health Check</h4>
                                                                <p class="d-block w-100">Update your CTrazing health status everyday.</p>
                                                                <button @click="goHDF" class="btn btn-sm btn-bg-primary text-white">Update Now</button>
                                                                <button @click="goScanner" class="btn btn-sm btn-bg-secondary text-white ms-3">Scan Now</button>
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin: Pic-->
                                                <div class="mb-4">
                                                    <!-- <p>{{user.identification_no}}</p> -->
                                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                        
                                                        <qr-code :size="160" :text="this.auth.user.type === 'administrator' ? 'administrator' : user.identification_no"></qr-code>
                                                    </div>
                                                </div>
                                                <!--end::Pic-->
                                            </div>
                                            <!--end::Details-->
                                            <div class="d-flex flex-column align-items-center">
                                                <h5 class="text-center m-0 mt-5">Continue to practice good hygiene and physical distancing.</h5>
                                                <img style="width:40%" src="assets/media/illustrations/dozzy-1/15-dark.png"/>
                                            </div>

                                            <div class="d-flex w-100 align-items-center">
                                                <div class="row w-100 mt-10 mb-5">
                                                    <div class="col-md-12 text-center">
                                                        <button style="width: 25%" class="btn m-3 btn-light-primary"><i class="fonticon-home fs-1"></i> Home</button>
                                                        <button @click="gotoSettings" style="width: 25%" class="btn m-3 btn-light-success"><i class="fonticon-setting fs-1"></i> Settings</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Post-->
                    </div>

                    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-bold me-1">2022©</span>
                                <a href="#" target="_blank" class="text-gray-800 text-hover-primary">F-Tech I.T Works Solution Provider</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                                <li class="menu-item">
                                    <a href="#" target="_blank" class="menu-link px-2">About</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" target="_blank" class="menu-link px-2">Support</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                        </div>
                        <!--end::Container-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data () {
            return {
                user: this.auth.user
            }
        },
        methods: {
            goHDF() {
                this.$router.push('/hdf'); 
            },

            goScanner() {
                this.$router.push('/scanner'); 
            },

            gotoSettings() {
                this.$router.push('/settings'); 
            },
        },

        created() {
            // console.log(this.auth.user);
        }
    }
</script>