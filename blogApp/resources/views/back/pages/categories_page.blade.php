@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')
    <section class="row">

        <section class="col-12">
            <section class="clearfix bg-[var(--second-white)] p-3 rounded-md">
                <div class="pull-left">
                    <h4 class="h4 text-blue">Parent Categories</h4>
                </div>
                <div class="pull-right">
                    <a href="" class="btn btnPers btn-sm">Add P. category</a>
                </div>

                <section class="table-resonsive mt-4">
                    <table class="table table-bordered mt-5">
                        <thread class="bg-secondary text-white">
                            <th>#</th>
                            <th>Name</th>
                            <th>No.of Categories</th>
                            <th>Actions</th>
                        </thread>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Parent Cate.1</td>
                                <td>4</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="" class="text-primary mx-2">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="" class="text-danger mx-2">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>

        <section class="col-12 mt-5">
            <div class="clearfix bg-[var(--second-white)] p-3 rounded-md">
                <div class="pull-left">
                    <h4 class="h4 text-blue">Categories</h4>
                </div>
                <div class="pull-right">
                    <a href="" class="btn btnPers btn-sm">Add Category</a>
                </div>

                <section class="table-resonsive mt-4">
                    <table class="table table-bordered mt-5">
                        <thread class="bg-secondary text-white">
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent Categories</th>
                            <th>No.of Posts</th>
                            <th>Actions</th>
                        </thread>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>P. Cat.1</td>
                                <td>Demo</td>
                                <td>4</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="" class="text-primary mx-2">
                                            <i class="dw dw-edit2"></i>
                                        </a>
                                        <a href="" class="text-danger mx-2">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </section>
    </section>
@endsection
