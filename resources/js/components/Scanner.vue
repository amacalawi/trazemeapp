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
                                        <div class="card-body pt-9">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="qr-layer">
                                                        <qrcode-stream @decode="onDecode" @init="onInit" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="d-flex flex-stack py-4" v-for="list in lists" :key="list.id">
														<!--begin::Details-->
														<div class="d-flex align-items-center">
															<!--begin::Avatar-->
															<div class="symbol symbol-45px symbol-circle">
																<img alt="Pic" :src="`${list.img}`">
															</div>
															<!--end::Avatar-->
															<!--begin::Details-->
															<div class="ms-5">
																<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">{{ list.name }}</a>
																<div class="fw-bold text-muted">{{ list.noti }}</div>
															</div>
															<!--end::Details-->
														</div>
														<!--end::Details-->
														<!--begin::Lat seen-->
														<div class="d-flex flex-column align-items-end ms-2">
															<span class="text-muted fs-7 mb-1">{{ list.time }}</span>
														</div>
														<!--end::Lat seen-->
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
    import { QrcodeStream, QrcodeCapture } from 'vue-qrcode-reader';
    import API from '../Api';
    export default {
        components: { QrcodeStream, QrcodeCapture },
        data () {
            return {
                user: this.auth.user,
                result: '',
                camera: 'auto',
                noRearCamera: false,
                noFrontCamera: false,
                onTrack: this.paintOutline,
                lists: []
            }
        },

        methods: {  
            onDecode (result) {
                let self = this
                this.result = result
                console.log(this.result);
            },

            paintOutline (detectedCodes, ctx) {
                for(const i = 0; i < detectedCodes.length; i++) {
                    const { boundingBox: { x, y, width, height } } = detectedCodes[i]

                    ctx.lineWidth = 2
                    ctx.strokeStyle = '#007bff'
                    ctx.strokeRect(x, y, width, height)
                }
            },

            switchCamera () {
                switch (this.camera) {
                    case 'front':
                        this.camera = 'auto'
                        break
                    case 'auto':
                        this.camera = 'front'
                        break
                }
            },

            async onInit (promise) {
                try {
                    await promise
                } catch (error) {
                    const triedFrontCamera = this.camera === 'front'
                    const triedRearCamera = this.camera === 'rear'

                    const cameraMissingError = error.name === 'OverconstrainedError'

                    if (triedFrontCamera && cameraMissingError) {
                        this.noFrontCamera = true
                    }
                    
                    if (triedRearCamera && cameraMissingError) {
                        this.noRearCamera = true
                    }

                    console.error(error)
                }
            },
        },

        created() {
            // console.log(this.auth.user);
        },

        mounted() { 
            let self = this;
            let token = localStorage.getItem('token');
            let laboratoryID = 1;

            const fetchData = async() => {
                try {
                    const response = await API.get(`scan-lists?laboratory_id=${laboratoryID}`, { headers: {"Authorization" : `Bearer ${token}`} })
                    self.lists = response.data;
                    console.log(response.data);
                } catch (error) {
                    console.log(error);
                }
            }
            fetchData();

            // API.get(`scan-list`, { headers: {"Authorization" : `Bearer ${token}`} })
            // .then(response => {
            //     console.log(response)
            //     // self.lists = response.data
            //     // console.log(self.lists)
            // })
            // .catch((error) => {
            //     console.log(error);
            // });
        }
    }
</script>