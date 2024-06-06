<tr @if ($word->duplicated) class="table-info" @endif>
    <th scope="row">{{ $count }}</th>
    <td>{{ $word->word }}</td>
    <td>{{ $word->guide_word }}</td>
    <td>{{ $word->level }}</td>
    <td>{{ $word->type }}</td>
    <td>
        <div class="btn-group me-1 mt-2">
            @if ($word->status == null)
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">{{ __('body.I don\'t know') }}
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <div wire:click="changeStatus(1)" class="dropdown-item know-option">
                        {{ __('body.I know') }}
                    </div>
                </div>
            @else
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{{ __('body.I know') }}
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <div wire:click="changeStatus(null)" class="dropdown-item dont-know-option">
                        {{ __('body.I don\'t know') }}
                    </div>
                </div>
            @endif
        </div>
    </td>
    <td style="width: 250px;">
        <button type="button" data-bs-toggle="modal" data-bs-target=".edit-word-modal-{{ $word->id }}"
            class="btn btn-warning waves-effect waves-light my-2">
            <i class="fas fa-pen"></i>
            {{ __('body.Edit') }}
        </button>
    </td>
</tr>
