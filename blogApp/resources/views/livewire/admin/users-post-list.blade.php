<div>
    <section class="mb-30">
        <div class="row ml-1">

            {{-- Filters section --}}

            {{-- search --}}
            <div class="col-md-3 pl-0">
                <label for="search"><b>Search</b></label>
                <input wire:model.live="search" type="text" id="search" class="form-control"
                    placeholder="Search posts">
            </div>

            {{-- author name --}}
            <div class="col-md-3">
                <label for="author"><b>Author</b></label>
                <select wire:model.live="author" id="author" class="form-control">
                    <option value="">All authors</option>
                    @foreach ($authors as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            

            {{-- category --}}
            <div class="col-md-2">
                <label for="category"><b>Category</b></label>
                <select wire:model.live="category" id="category" class="form-control">
                    <option value="">All categories</option>
                    {!! $categories_html !!}
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

            {{-- all users posts table --}}
            <div class="table-responsive my-3 mr-3 rounded-lg rounded-bl-md rounded-br-md">
                <table class="table table-striped table-auto table-sm table-bordered table-dark">
                    <thead class="bg-secondary text-white">
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Visibility</th>
                    </thead>

                    <tbody>
                        @forelse ($posts as $item)
                            <tr>
                                <td scope="row">{{ $item->id }}</td>
                                <td>
                                    <img src="{{ asset('images/posts/' . $item->featured_image) }}" alt=""
                                        srcset="" width="300" class="rounded-md object-cover">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->author->name }}</td>
                                <td>{{ $item->post_category->name }}</td>
                                <td>
                                    @if ($item->visibility == 1)
                                        <span class="badge badge-pill badge-success">
                                            <i class="icon-copy ti-world"></i> Public</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">
                                            <i class="icon-copy ti-lock"></i> Private</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <span class="text-danger">No post found!</span>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="block mt-3">
            {{$posts->links('livewire::simple-bootstrap')}}
        </div>
    </section>
</div>
