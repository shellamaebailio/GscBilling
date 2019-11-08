<template>
    <div class="card full-width">

        <div class="card-header">
            <h3 class="card-title">DMPI DAR</h3>
        </div>

        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="sel1">Month</label>
                                    <select class="form-control form-control-sm">
                                        <option>Small select</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="sel1">Year</label>
                                    <select class="form-control form-control-sm">
                                        <option>Small select</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="sel1">Period</label>
                                    <select class="form-control form-control-sm">
                                        <option>Small select</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Period Coverage:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="reservation">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>SOA Date:</strong>
                                        <input class="form-control form-control-sm" type="text" placeholder="">
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>SOA Number:</strong>
                                        <select class="form-control form-control-sm">
                                            <option>Small select</option>
                                        </select>
                                    </div>
                                </div>
                                &nbsp;
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>Prepared By:</strong>
                                        <input class="form-control form-control-sm" type="text" placeholder="">
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Confirmed By:</strong>
                                        <input class="form-control form-control-sm" type="text" placeholder="">
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Approved By:</strong>
                                        <input class="form-control form-control-sm" type="text" placeholder="">
                                    </div>
                                </div>
                                &nbsp;
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <strong>File:</strong>
                                            <input type="file" class="form-control" v-on:change="onFileChange">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <button class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
