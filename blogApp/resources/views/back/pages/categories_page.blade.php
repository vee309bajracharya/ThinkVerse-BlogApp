@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')
    @livewire('user.categories')
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
