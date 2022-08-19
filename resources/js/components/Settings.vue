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
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                            <div class="d-flex w-100 align-items-center">
                                                <div class="row w-100 mt-10 mb-5">
                                                    <div class="col-md-12 text-center">
                                                        <button @click="backtoHome" style="width: 25%" class="btn m-3 btn-light-primary"><i class="fonticon-home fs-1"></i> Back</button>
                                                        <button @click="updateSettings" style="width: 25%" class="btn m-3 btn-light-success"><i class="fas fa-envelope-open-text fs-1"></i>Save</button>
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
    import API from '../Api';
    export default {

        data () {
            return {
                user: this.auth.user
            }
        },

        
        methods: {
            backtoHome() {
                this.$router.push('/dashboard'); 
            },

            updateSettings() {
                alert('save');
            },
        },
        
        created() {
            // console.log(this.auth.user);
        },
    }
</script>