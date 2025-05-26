@extends('back.layout.admin-layout')

@section('adminPageTitle', isset($pageTitle) ? $pageTitle : 'Manage Categories')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Categories</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.admin-dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Categories
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    @livewire('admin.categories')
@endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            // Toast handling
            Livewire.on('toast-shown', () => {
                setTimeout(() => {
                    Livewire.dispatch('hideToast');
                }, 3000);
            });

            // Modal handling for parent category
            window.addEventListener('showParentCategoryModalForm', function() {
                $('#pcategory_modal').modal('show');
            });

            window.addEventListener('hideParentCategoryModalForm', function() {
                $('#pcategory_modal').modal('hide');
            });

            // Modal handling for category
            window.addEventListener('showCategoryModalForm', function() {
                $('#category_modal').modal('show');
            });

            window.addEventListener('hideCategoryModalForm', function() {
                $('#category_modal').modal('hide');
            });

            // ordering
            $('table tbody#sortable_parent_categories').sortable({
                cursor: 'move',
                update: function(event, ui) {
                    $(this).children().each(function(index) {
                        if ($(this).attr('data-ordering') != (index + 1)) {
                            $(this).attr('data-ordering', (index + 1)).addClass('updated');
                        }
                    });
                    var positions = [];
                    $('.updated').each(function() {
                        positions.push([$(this).attr('data-index'), $(this).attr(
                            'data-ordering')]);
                        $(this).removeClass('updated');
                    });
                    Livewire.dispatch('updateCategoryOrdering', [positions]);
                }
            });

        });
    </script>
@endpush
