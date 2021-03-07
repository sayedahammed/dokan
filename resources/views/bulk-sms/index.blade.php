@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Bulk SMS</h4>
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="templates-tab" data-toggle="tab" href="#templates" role="tab" aria-controls="home" aria-selected="true">Templates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="records-tab" data-toggle="tab" href="#records" role="tab" aria-controls="contact" aria-selected="false">Records</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="create-template-tab" data-toggle="tab" href="#create-template" role="tab" aria-controls="create-template" aria-selected="false">Create</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="templates" role="tabpanel" aria-labelledby="templates-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Bulk SMS Templates</h4>
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-sm table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Template</th>
                                                    <th style="min-width: 140px;">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                                        <a class="btn btn-info btn-sm"><i class="fas fa-vial"></i></a>
                                                        <a class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-paper-plane"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="records" role="tabpanel" aria-labelledby="records-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Records</h4>
                                        <div class="table-responsive">
                                            <table class="table dataTable table-sm table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Template</th>
                                                    <th>Sent</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque cum dolorem dolores non obcaecati sed!</td>
                                                    <td>2333</td>
                                                    <td>2021/12/12</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="create-template" role="tabpanel" aria-labelledby="create-template-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4>Create Template</h4>
                                                <form action="">
                                                    <div class="form-group">
                                                        <label for="text">Text (Max. 160 Characters)</label>
                                                        <textarea name="text" class="form-control" maxlength="160" id="text" cols="30" rows="3" placeholder="Aa"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary float-right">Save <i class="fas fa-save"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $("#text").focusin(function () {
            if(!$(this).val()) {
                $(this).attr("placeholder", "Type your message...");
            }
        }).focusout(function () {
            if(!$(this).val()) {
                $(this).attr("placeholder", "Aa");
            }
        })
    </script>
@endpush
