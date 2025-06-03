<div>
    <section class="row">

        {{-- parent categories --}}
        <section class="col-12">
            <section class="clearfix p-3 rounded-md">
                <div class="pull-left">
                    <h4 class="h4 text-blue">Parent Categories</h4>
                </div>
                <div class="pull-right">
                    <a href="javascript:;" class="btn btnPers btn-sm" wire:click="addParentCategory()">Add P. category</a>
                </div>

                <section class="table-resonsive mt-4 rounded-md">
                    <table class="table table-bordered mt-5 table-dark">
                        <thread class="bg-secondary text-white">
                            <th>#</th>
                            <th>Name</th>
                            <th>No.of Categories</th>
                            <th>Actions</th>
                        </thread>
                        <tbody id="sortable_parent_categories">
                            @forelse ($pcategories as $item)
                                <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->children->count() }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="javascript:;" wire:click="editParentCategory({{ $item->id }})"
                                                class="text-primary mx-2">
                                                <i class="dw dw-edit2"></i>
                                            </a>
                                            <a href="javascript:;"
                                                wire:click="deleteParentCategory({{ $item->id }})"
                                                class="text-danger mx-2">
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
                {{-- pagination --}}
                <div class="d-block mt-1 text-center">
                    {{ $pcategories->links('livewire::simple-bootstrap') }}
                </div>
            </section>
        </section>

        {{-- categories --}}
        <section class="col-12 mt-5">
            <div class="clearfix p-3 rounded-md">
                <div class="pull-left">
                    <h4 class="h4 text-blue">Categories</h4>
                </div>
                <div class="pull-right">
                    <a href="javascript:;" wire:click="addCategory()" class="btn btnPers btn-sm">Add Category</a>
                </div>

                <section class="table-resonsive mt-4">
                    <table class="table table-bordered mt-5 table-dark">
                        <thread class="bg-secondary text-white">
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent Categories</th>
                            <th>No.of Posts</th>
                            <th>Actions</th>
                        </thread>
                        <tbody>
                            @forelse ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ !is_null($item->parent_category) ? $item->parent_category->name : '-' }}
                                    </td>
                                    <td>{{$item->posts->count()}}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="javascript:;" wire:click="editCategory({{ $item->id }})"
                                                class="text-primary mx-2">
                                                <i class="dw dw-edit2"></i>
                                            </a>
                                            <a href="javascript:;" wire:click="deleteCategory({{ $item->id }})"
                                                class="text-danger mx-2">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <span class="text-danger">No item found</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
                {{-- pagination --}}
                <div class="d-block mt-1 text-center">
                    {{ $categories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </section>
    </section>


    {{-- medium model fade for parent category --}}
    <section wire:ignore.self class="modal fade" id="pcategory_modal" tabindex="-1" role="dialog"
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
                        <input type="text" class="form-control" id="pcategory_name" wire:model.lazy="pcategory_name"
                            x-data x-init="$el.value = '{{ $pcategory_name }}'">
                        @error('pcategory_name')
                            <p
                                class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
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
    </section>

    {{-- medium model fade for category --}}
    <section wire:ignore.self class="modal fade" id="category_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content"
                wire:submit.prevent="{{ $isUpdateCategoryMode ? 'updateCategory' : 'createCategory' }}">

                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdateCategoryMode ? 'Update Category' : 'Add Category' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    @if ($isUpdateCategoryMode)
                        <input type="hidden" wire:model="category_id">
                    @endif
                    <div class="form-group">
                        <label for="p_category"><b>Parent Category</b></label>
                        <select wire:model="parent" class="custom-select">
                            <option value="0">Uncategorized</option>
                            @foreach ($pcategories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('parent')
                            <p
                                class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_name"><b> Category Name</b></label>
                        <input type="text" class="form-control" id="category_name"
                            wire:model.lazy="category_name" x-data x-init="$el.value = '{{ $category_name }}'">
                        @error('category_name')
                            <p
                                class="error-msg text-sm text-[var(--danger)] font-medium transition-opacity duration-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btnPers">
                        {{ $isUpdateCategoryMode ? 'Save Changes' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Toast Notification -->
    @if ($showToast)
        <x-toast :type="$toastType" :message="$toastMessage" :show="$showToast" />
    @endif

</div>
