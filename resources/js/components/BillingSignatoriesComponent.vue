<template>
    <div class="card full-width">
    <div class="card-header">
    <h3 class="card-title">Billing Signatories</h3>
    <button class="btn btn-secondary float-right" @click="createMode">
        <i class="fas fa-plus-circle"></i> Add new signatory
    </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>                  
            <tr>
            <th>Last Name</th>
            <th>Ext Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Position</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="(signatory) in signatories.data" v-bind:key="signatory.id">
            <td>{{signatory.lname}}</td>
            <td>{{signatory.ename}}</td>
            <td>{{signatory.fname}}</td>
            <td>{{signatory.mname}}</td>
            <td>{{signatory.position}}</td>
            <td>
            <a @click="editMode(signatory)">
                <i class="fa fa-edit blue"></i>
            </a>/
            <a @click="deleteSignatory(signatory.id)">
                <i class="fa fa-trash color-red"></i>
            </a>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <pagination :data="signatories" @pagination-change-page="getResults"></pagination>
    </div>

    <!-- modal  -->
    <div class="modal fade" id="addNewSignatory" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Extra Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form @submit.prevent @submit.once="isEdit ? updateSignatory() : addNewSignatory()">
            <div class="modal-body">
                    <input hidden="true" v-model="form.id" class="form-control form-control-sm" type="text" name="id">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="lname">Last Name</label>
                            <input v-model="form.lname" class="form-control form-control-sm" :class="{'is-invalid': form.errors.has('lname')}" type="text" name="lname">
                            <has-error :form="form" field="lname"></has-error>
                        </div>
                        <div class="col-sm-3">
                            <label for="ename">Extension Name</label>
                            <input v-model="form.ename" class="form-control form-control-sm" :class="{'is-invalid': form.errors.has('ename')}" type="text" name="ename">
                            <has-error :form="form" field="ename"></has-error>
                        </div>
                        <div class="col-sm-3">
                            <label for="fname">First Name</label>
                            <input v-model="form.fname" class="form-control form-control-sm" :class="{'is-invalid': form.errors.has('fname')}" type="text" name="fname">
                            <has-error :form="form" field="fname"></has-error>
                        </div>
                        <div class="col-sm-3">
                            <label for="mname">Middle Name</label>
                            <input v-model="form.mname" class="form-control form-control-sm" :class="{'is-invalid': form.errors.has('mname')}" type="text" name="mname">
                            <has-error :form="form" field="mname"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="position">Position</label>
                            <input v-model="form.position" class="form-control form-control-sm" :class="{'is-invalid': form.errors.has('position')}" type="text" name="position">
                            <has-error :form="form" field="position"></has-error>
                        </div>
                    </div>
                    <br>
                    
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
            <!-- <button @click="addNewSignatory" type="button" class="btn btn-primary"><i class="far fa-save"></i> Save</button> -->
            <button v-show="isEdit" type="submit" class="btn btn-success"><i class="far fa-save"></i> Update</button>
            <button v-show="!isEdit" type="submit" class="btn btn-primary"><i class="far fa-save"></i> Create</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- end modal -->

</div>
</template>

<script>
import { log } from 'util';

    export default {
        data(){
            return{
                signatories:{},
                isSubmit: false,
                validationError: [],
                isEdit: false,
                form: new Form({
                    id:'',
                    fname: '',
                    mname: '',
                    ename: '',
                    lname: '',
                    position: ''
                })
            }
        },
        mounted(){
            this.getTasks()
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/api/billingsignatory?page=' + page)
                    .then(response => {
                        this.signatories = response.data;
                    });
            },
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            createJob: function () {
                console.log("test");
            },
            getTasks(){
                axios({method: 'GET', url: '/api/billingsignatory'}).then(({ data }) => (this.signatories = data))
            },
            clearSignatory(){
                this.id=''
                this.fname = ''
                this.mname = ''
                this.lname = ''
                this.ename = ''
                this.position = ''
            },
           addNewSignatory(e){
                this.$Progress.start();

                this.form.post('api/billingsignatory')
                .then(()=>{
                    $('#addNewSignatory').modal('hide')
                    this.$Progress.finish();
                    this.getTasks();
                    toast.fire({
                        icon: 'success',
                        title: 'Signatory created successfully'
                    })
                })
                .catch((err)=>{
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'Signatory not created successfully'
                    })
                })
            

            },
            updateSignatory(){
                this.$Progress.start();
                this.form.put('api/billingsignatory/'+this.form.id)
                .then(() => {
                    $('#addNewSignatory').modal('hide');
                        this.$Progress.finish();
                        this.getTasks();
                        toast.fire({
                            icon: 'success',
                            title: 'Signatory updated successfully'
                    })
                })
                .catch(() => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'Signatory not updated successfully'
                    })
                });
            },
            editMode(signatory){
                this.isEdit = true;
                this.form.reset();
                $('#addNewSignatory').modal('show');
                this.form.fill(signatory);
            },
            createMode(){
                this.isEdit = false;
                this.form.reset();
                $('#addNewSignatory').modal('show');
            },
            deleteSignatory(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.value) {
                            this.form.delete('api/billingsignatory/'+id).then(() => {
                                    swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                
                                this.getResults();

                            }).catch(()=>{
                                swal.fire(
                                    'Failed!',
                                    'Something went wrong.',
                                    'error'
                                    )
                            });
                        }
                    })
                    
            }
        },
        created(){
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/signatorySearch?q='+query)
                .then((data) => {
                    this.signatories = data.data
                    console.log(data.data)
                })
            })
        }
    }
</script>
