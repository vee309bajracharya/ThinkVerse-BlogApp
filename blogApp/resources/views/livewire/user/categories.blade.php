<div>
    <section class="row">

        <section class="col-12">
            <section class="clearfix bg-[var(--second-white)] p-3 rounded-md">
                <div class="pull-left">
                    <h4 class="h4 text-blue">Parent Categories</h4>
                </div>
                <div class="pull-right">
                    <a href="javascript:;" class="btn btnPers btn-sm" wire:click="addParentCategory()">Add P. category</a>
                </div>

                <section class="table-resonsive mt-4">
                    <table class="table table-bordered mt-5">
                        <thread class="bg-secondary text-white">
                            <th>#</th>
                            <th>Name</th>
                            <th>No.of Categories</th>
                            <th>Actions</th>
                        </thread>
                        <tbody id="sortable_parent_categories">
                            @forelse ($pcategories as $item)
                                <tr data-index="{{$item->id}}" data-ordering="{{$item->ordering}}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>-</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="javascript:;" wire:click="editParentCategory({{ $item->id }})"
                                                class="text-primary mx-2">
                                                <i class="dw dw-edit2"></i>
                                            </a>
                                            <a href="javascript:;" wire:click="deleteParentCategory({{$item->id}})" class="text-danger mx-2">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <p class="error-msg text-sm text-[var(--danger)] font-medium mt-1">No item found
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
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

    {{-- medium model fade --}}
    <div wire:ignore.self class="modal fade" id="pcategory_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content"
                wire:submit.prevent="{{ $isUpdateParentCategoryMode ? 'updateParentCategory' : 'createParentCategory' }}">

                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdateParentCategoryMode ? 'Update P. Category' : 'Add Category' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    @if ($isUpdateParentCategoryMode)
                        <input type="hidden" wire:model="pcategory_id">
                    @endif
                    <div class="form-group">
                        <label for="pcategory_name"><b>Parent Category Name</b></label>
                        <input type="text" 
                               class="form-control" 
                               id="pcategory_name" 
                               wire:model.lazy="pcategory_name" 
                               x-data 
                               x-init="$el.value = '{{ $pcategory_name }}'">
                        @error('pcategory_name')
                        <p class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btnPers">
                        {{ $isUpdateParentCategoryMode ? 'Save Changes' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    @if ($showToast)
        <x-toast :type="$toastType" :message="$toastMessage" :show="$showToast" />
    @endif

</div>
