<div>
    @if (session()->has('success'))
    <div class="alert alert-success mt-2 rounded-md w-72">
        {{ session('success') }}
    </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-2 rounded-md w-72">
            {{ session('error') }}
        </div>
    @endif
{{-- fetch all posts --}}
<section class="mb-30">
    <div class="row ml-1">
        {{-- Filters section --}}

        {{-- search --}}
        <div class="col-md-5 pl-0">
            <label for="search"><b class="text-secondary">Search</b></label>
            <input wire:model.live="search" type="text" id="search" class="form-control" placeholder="Search posts">
        </div>

        {{-- category --}}
        <div class="col-md-3">
            <label for="category"><b>Category</b></label>
            <select wire:model.live="category" name="" id="category" class="custom-select form-control" autocomplete="off">
                <option value="">No selected</option>
                {{!! $categories_html !!}}
            </select>
        </div>

        {{-- visibility --}}
        <div class="col-md-2">
            <label for="visibility"><b>Visibility</b></label>
            <select wire:model.live="visibility" name="" id="visibility" class="custom-select form-control">
                <option value="">No selected</option>
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>

        {{-- sort --}}
           <div class="col-md-2">
            <label for="sort"><b>Sort By</b></label>
            <select wire:model.live="sortBy" name="" id="sort" class="custom-select form-control">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>

    </div>


    {{-- posts table --}}
    <div class="table-responsive my-3 rounded-lg rounded-bl-md rounded-br-md">
        <table class="table table-striped table-auto table-sm table-bordered table-dark">
            <thead class="bg-secondary text-white">
                {{-- <th scope="col">ID</th> --}}
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Visibility</th>
                <th scope="col">Action</th>
            </thead>

            <tbody>
                @forelse ($posts as $item)

                <tr>
                    {{-- <td scope="row">{{$item->id}}</td> --}}
                    <td>
                            <img src="{{ asset('images/posts/' . $item->featured_image) }}" alt="" srcset="" width="300" class="rounded-md object-cover">
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->post_category->name}}</td>
                    <td>
                        @if ($item->visibility == 1)
                         <span class="badge badge-pill badge-success">
                            <i class="icon-copy ti-world"></i> Public</span>
                        @else
                        <span class="badge badge-pill badge-warning">
                            <i class="icon-copy ti-lock"></i> Private</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{route('user.edit_post',['id'=>$item->id])}}" data-color="#265ed7" style="color: rgb(38,94,215)">
                                <i class="icon-copy dw dw-edit2"></i>
                            </a>
                            <a href="javascript:;" wire:click="deletePost({{$item->id}})" data-color="#e95959" style="color: rgb(233,94,215)">
                                <i class="icon-copy dw dw-delete-1"></i>
                            </a>
                        </div>
                    </td>
                </tr>              
                @empty
                <tr>
                    <td colspan="6" class="text-center text-danger">No post found!</td>
                </tr>
                @endforelse 
    
            </tbody>
        </table>
    </div>
    <div class="block mt-3">
        {{$posts->links('livewire::simple-bootstrap')}}
    </div>
</section>

</div>
