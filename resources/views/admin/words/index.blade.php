@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Words') }}</h4>
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".create-word-modal">
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
                                <th>{{ __('body.Word') }}</th>
                                <th>{{ __('body.Level') }}</th>
                                <th>{{ __('body.Status') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($words->currentPage() - 1) * $words->perPage();
                            @endphp
                            @foreach ($words as $word)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>{{ $word->word }}</td>
                                    <td>{{ $word->level }}</td>
                                    <td>{{ $word->status }}</td>
                                    <td style="width: 250px;">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".edit-word-modal-{{ $word->id }}"
                                            class="btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Edit Modal Beginning  --}}
                                {{--  <div class="modal fade edit-word-modal-{{ $word->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editIconModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editIconModalLabel">
                                                    {{ __('body.Update Icon') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('words.update', $word->id) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <img src="{{ $word->word_path }}"
                                                                    style="width: 50px; height: auto;"
                                                                    alt="{{ $word->name }}">
                                                                {{ __('body.Icon Preview') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="word-word">
                                                                    {{ __('body.Icon') }}
                                                                </label>
                                                                <input name="word" type="file" class="form-control"
                                                                    id="word-word">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="word-name">
                                                                    {{ __('body.Name') }} <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input name="name" value="{{ $word->name }}"
                                                                    type="text"
                                                                    placeholder="{{ __('body.Enter name') }}..."
                                                                    class="form-control" id="word-name">
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
                                </div>  --}}
                                {{--  Edit Modal End  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $words->links() }}
            </div>
        </div>
    </div>
@endsection
