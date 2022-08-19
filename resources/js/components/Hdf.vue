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
                                                    <h5>Here's how can you help us.</h5>
                                                    <p class="mb-10">You can help us top the spread of COVID-19 by staying at home and staying safe. You can also help us by reporting your health condition for us to know that you're safe.</p>

                                                    <div class="row">
                                                        <div class="mb-7 col-sm-6" v-for="symptom in symptoms" :key="symptom.id">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" :value="symptom.id" v-model="symptom.checked" :disabled="is_none == true" @change="updateChange"/>
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    {{ symptom.name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-7 col-sm-6">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="0" v-model="is_none" @click="unSelectAll"/>
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    None of the above
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex w-100 align-items-center">
                                                <div class="row w-100 mt-10 mb-5">
                                                    <div class="col-md-12 text-center">
                                                        <button @click="backtoHome" style="width: 25%" class="btn m-3 btn-light-primary"><i class="fonticon-home fs-1"></i> Back</button>
                                                        <button @click="updateHDF" style="width: 25%" class="btn m-3 btn-light-success"><i class="fas fa-envelope-open-text fs-1"></i>Save</button>
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
                symptoms: [
                    {id: 1, name: "Fever", checked: false},
                    {id: 2, name: "Dry Cough", checked: false},
                    {id: 3, name: "Sore Throat", checked: false},
                    {id: 4, name: "Shortness of Breath", checked: false},
                    {id: 5, name: "Loss of Smell and Taste", checked: false},
                    {id: 6, name: "Fatigue", checked: false},
                    {id: 7, name: "Aches and Pains", checked: false},
                    {id: 8, name: "Runny Nose", checked: false},
                    {id: 9, name: "Diarrhea", checked: false},
                    {id: 10, name: "Headache", checked: false}
                ],
                user: this.auth.user,
                is_none: false,
                selected: [],
                symptomses: [],
            }
        },
        
        created() {
            // console.log(this.auth.user);
        },

        methods: {
            backtoHome() {
                this.$router.push('/dashboard'); 
            },

            updateChange() {
                this.selected = [];
                for (var key in this.symptoms) {
                    if (this.symptoms[key].checked == true ) {
                        this.selected.push(this.symptoms[key].id);
                    }
                }
                console.log(this.selected);
            },
            
            updateHDF() {
                // alert('save');
                let user = this.auth.user.id;
                console.log(API);

                if (this.selected.length > 0) {
                    this.$swal({
                        icon: 'question',
                        title: 'Do you want to save the changes?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            // this.axios.post('http://127.0.0.1:8000/api/hdf/update?user=' + user, this.selected)
                            // .then(({data}) => {
                            //     this.$swal({
                            //         type: 'success',
                            //         title: 'Saved..',
                            //         onClose: () => {
                            //             this.$router.push('/dashboard');
                            //         }
                            //     });
                            // })
                            // .catch((error) => {
                            //     console.log(error);
                            // });

                            let user = JSON.parse(localStorage.getItem('user'));
                            let token = localStorage.getItem('token');
                            let post = { selected: this.selected }
                            API.post(`hdf/update?user_id=${user.id}`, post, { headers: {"Authorization" : `Bearer ${token}`} })
                            .then(response => {
                                console.log(response)
                                let result = response.data
                                if(result.status === 'ok') {
                                    this.$swal({
                                        title: 'Good Job!',
                                        text: 'You have been successfully updated.',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        onClose: () => {
                                            this.$router.push('/dashboard');
                                        }
                                    });
                                } else {
                                    alert('not');
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                        } 
                    })
                } else {
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select a symptom first.',
                        confirmButtonColor: '#f27474',
                    });
                }
                
            },

            unSelectAll() {
                this.selected = [];
                for (var key in this.symptoms) {
                    this.symptoms[key].checked = false;
                }
                if (this.is_none == false) {
                    this.selected.push(0);
                }
                console.log(this.selected);
            }
        }
    }
</script>