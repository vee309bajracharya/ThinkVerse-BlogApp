@extends('back.layout.admin-layout')

@section('adminPageTitle', isset($adminPageTitle) ? $adminPageTitle : 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Page Title --}}
    <h3 class="font-bold text-gray-500 mb-8 text-2xl">{{ $adminPageTitle }}</h3>

    {{-- Top Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 my-8">
        {{-- Stat Cards --}}
        @php
            $stats = [
            [
                'label' => 'Total Users', 
                'value' => $totalUsers, 
                'color' => 'blue', 
                'icon' => 'M5.121 17.804A13.937 13.937 0 0112 15c2.761 0 5.27.865 7.379 2.343M15 11a3 3 0 11-6 0 3 3 0 016 0z M19.071 4.929a10 10 0 11-14.142 0 10 10 0 0114.142 0z'
            ],

            [
                'label' => 'Total Posts',
                'value' => $totalPosts,
                'color' => 'green',
                'icon' => 'M19 7l-7 7-7-7'
            ],

            [
                'label' => 'Published Posts',
                'value' => $publishedPosts,
                'color' => 'indigo',
                'icon' => 'M5 13l4 4L19 7'
            ],

            [   
                'label' => 'Parent Categories',
                'value' => $totalParentCategories,
                'color' => 'yellow',
                'icon' => 'M4 6h16M4 12h16M4 18h7'
            ],
            
            [
                'label' => 'Sub Categories',
                'value' => $totalCategories,
                'color' => 'pink',
                'icon' => 'M9 17v-2a4 4 0 014-4h4 M16 7a4 4 0 110 8'
            ],
        ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-[var(--second-white)] shadow rounded-lg p-5 flex items-center space-x-4 hover:shadow-md transition-shadow mt-4">
            <div class="p-3 rounded-full bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-lg font-semibold text-gray-700">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Mid Section --}}
    <div class="grid grid-cols-1 gap-6 my-10">
        
        {{-- Recent Posts --}}
        <h3 class="text-lg font-semibold text-gray-800 mt-4 mb-14">Recent Posts</h3>
        <div class="bg-secondary shadow rounded-lg p-6 text-white">
            <table class="min-w-full divide-y rounded-md text-white">
                <thead class="font-bold">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Author</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentPosts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700 truncate">{{ $post->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $post->author->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</td>
                         
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No recent posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 text-center font-bold">
                <a href="{{ route('admin.users-posts') }}" class="text-sm">View All</a>
            </div>
        </div>

        {{-- Recent Users --}}
        <h4 class="text-lg font-semibold text-gray-800 my-14">Recent Users</h4>
        <div class="bg-transparent shadow rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentUsers as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-sm text-gray-500">No recent users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 text-center font-bold">
                <a href="{{ route('admin.users-list') }}" class="text-sm">View All</a>
            </div>
        </div>

    </div>

    <div class="py-10">
        <h4 class="text-lg font-semibold text-gray-800 ">Posts per Month</h4>
        <div class="bg-[var(--second-white)] shadow-md rounded-lg p-5 mt-6">
            <canvas id="postsViewsChart" height="100"></canvas>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('postsViewsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Posts per Month',
                        data: @json($postsPerMonth),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.3
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>
    
</div>
@endsection
