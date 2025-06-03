<section>
    <div class="ml-1">
        {{-- search --}}
        <section>
            <div class="col-md-6 pl-0">
                <label for="search"><b>Search</b></label>
                <input wire:model.live="search" type="text" id="search" class="form-control" placeholder="Search user">
            </div>
    
            {{-- Total Users --}}
            <div class="my-3 pl-0 pr-2 float-right">
                <h6 class="text-[var(--primary-color)]">Total Users: {{ $totalUsers }}</h6>
            </div>
        </section>

        {{-- users list --}}
        <section class="table-responsive mt-3 mr-3 rounded-md">
            <table class="table table-striped table-auto table-sm table-bordered table-dark">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Picture</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usersList as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <img src="{{ $item->picture }}" alt="Profile" width="100" height="100"
                                    class="rounded-md object-cover">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">No users found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <div class="block mt-3">
            {{ $usersList->links('livewire::simple-bootstrap') }}
        </div>
    </div>
</section>
