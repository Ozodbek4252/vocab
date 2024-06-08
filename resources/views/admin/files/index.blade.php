@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Files') }}</h4>
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".create-file-modal">
                            <i class="fas fa-plus"></i>
                            {{ __('body.Create') }}
                        </button>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('body.name_n') }}</th>
                                <th>{{ __('body.Page') }}</th>
                                <th>{{ __('body.Size') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td><a href="{{ $file->full_path }}" target="_blank">{{ $file->name }}</a></td>
                                    <td>{{ $file->page }}</td>
                                    <td>{{ $file->formatted_size }}</td>
                                    <td style="width: 250px;">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".edit-file-modal-{{ $file->id }}"
                                            class="btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-file-modal-{{ $file->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-file-modal-{{ $file->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteFileModalLabel">
                                                    {{ __('body.Delete File') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('files.destroy', $file->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    {{ __('body.Do you really want to delete this?') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        {{ __('body.Close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ __('body.Delete') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  Delete Modal End  --}}

                                {{--  Edit Modal Beginning  --}}
                                <div class="modal fade edit-file-modal-{{ $file->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editFileModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editFileModalLabel">
                                                    {{ __('body.Update File') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('files.update', $file->id) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="file-file">
                                                                    {{ __('body.File') }}
                                                                    <span style="font-size: 10px; color: orange;">
                                                                        {{ __('body.Allowed types') }}
                                                                    </span>
                                                                </label>
                                                                <input name="file" type="file" class="form-control"
                                                                    id="file-file">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="file-name">
                                                                    {{ __('body.Name') }}
                                                                </label>
                                                                <input name="name" value="{{ $file->name }}"
                                                                    type="text"
                                                                    placeholder="{{ __('body.Enter name') }}..."
                                                                    class="form-control" id="file-name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('body.Update') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  Edit Modal End  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  Create Modal Beginning  --}}
    <div class="modal fade create-file-modal" tabindex="-1" role="dialog" aria-labelledby="createFileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFileModalLabel">{{ __('body.Create File') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('files.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="file-file">
                                        {{ __('body.File') }} <span class="text-danger">*</span> <span
                                            style="font-size: 10px; color: orange;">{{ __('body.Allowed types') }}</span>
                                    </label>
                                    <input name="file" type="file" class="form-control" id="file-file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="file-name">
                                        {{ __('body.Name') }}
                                    </label>
                                    <input name="name" type="text" placeholder="{{ __('body.Enter name') }}..."
                                        class="form-control" id="file-name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('body.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Create Modal End  --}}
@endsection
