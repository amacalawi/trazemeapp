<template>
    <div id="kt_body" class="bg-body">
        <div class="d-flex flex-column flex-root">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                    <!--begin::Logo-->
                    <a href="../../demo1/dist/index.html" class="mb-12">
                        <img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-40px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Sign In to TrazeMe App</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-400 fw-bold fs-4">New Here?
                                <a href="../../demo1/dist/authentication/layouts/basic/sign-up.html" class="link-primary fw-bolder">Create an Account</a></div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="username" v-model="user.username" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Link-->
                                    <a href="../../demo1/dist/authentication/layouts/basic/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="password" v-model="user.password" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button @click="login" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Continue</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Submit button-->
                            </div>
                            <!--end::Actions-->
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-column-auto p-10">
                    <!--begin::Links-->
                    <div class="d-flex align-items-center fw-bold fs-6">
                        <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                        <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                        <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
    </div>

    <!-- <div>
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input type="email" v-model="user.email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" v-model="user.password">
        </div>
        <button @click="login">Login</button>
    </div> -->
</template>

<script>
    import API from '../Api';
    import Auth from '../Auth.js';

    export default {
        data() {
            return {
                user: {
                    username: '',
                    password: '',
                }
            };
        },

        methods: {
            login() {
                API.post(`login`, this.user)
                    .then(({data}) => {
                        Auth.login(data.access_token,data.user); //set local storage
                        this.$router.push('/dashboard');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>