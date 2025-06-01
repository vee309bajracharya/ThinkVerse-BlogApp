<div>
{{-- fetch all posts --}}
<section class="mb-30">
    <div class="row ml-1">
        Filters
    </div>

    <div class="table-responsive my-3 rounded-lg rounded-bl-md rounded-br-md">
        <table class="table table-striped table-auto table-sm table-bordered table-dark">
            <thead class="bg-secondary text-white">
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Visibility</th>
                <th scope="col">Action</th>
            </thead>

            <tbody>
                @forelse ($posts as $item)

                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>
                        <a href="">
                            <img src="{{ asset('images/posts/' . $item->featured_image) }}" alt="" srcset="" width="300" class="rounded-md object-cover">
                        </a>
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->author->name}}</td>
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
                            <a href="" data-color="#265ed7" style="color: rgb(38,94,215)">
                                <i class="icon-copy dw dw-edit2"></i>
                            </a>
                            <a href="" data-color="#e95959" style="color: rgb(233,94,215)">
                                <i class="icon-copy dw dw-delete-1"></i>
                            </a>
                        </div>
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
    <div class="block mt-3">
        {{$posts->links('livewire::simple-bootstrap')}}
    </div>
</section>

</div>
