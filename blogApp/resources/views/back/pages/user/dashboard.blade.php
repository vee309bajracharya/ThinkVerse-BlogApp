@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <h3 class="font-bold text-gray-500 mb-8 text-2xl">{{ $pageTitle }}</h3>

        {{-- top section --}}
        <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-5 my-8">

            @php
                $stats = [
                    [
                        'label' => 'Total Posts',
                        'value' => $totalPosts,
                        'color' => 'blue',
                        'icon' =>  'M19 7l-7 7-7-7',
                    ],
                    [
                        'label' => 'Public Posts',
                        'value' => $publishedPosts,
                        'color' => 'green',
                        'icon' =>  'M5 13l4 4L19 7',
                    ],
                    [
                        'label' => 'Private Posts',
                        'value' => $privatePosts,
                        'color' => 'red',
                        'icon' => 'M17,9V7c0-2.8-2.2-5-5-5S7,4.2,7,7v2c-1.7,0-3,1.3-3,3v7c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3v-7C20,10.3,18.7,9,17,9z M9,7c0-1.7,1.3-3,3-3s3,1.3,3,3v2H9V7z',

                    ],
                ];

            @endphp

            @foreach ($stats as $stat)
                <div
                    class="bg-[var(--second-white)] shadow rounded-lg p-5 flex items-center space-x-4 hover:shadow-md transition-shadow mt-4">
                    <div class="p-3 rounded-full bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-md font-semibold text-gray-700">{{ $stat['label'] }}</h4>
                        <p class="text-md font-bold text-gray-900">{{ $stat['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Mid Section --}}
        <div class="w-full">

            {{-- Recent Posts --}}
            <h3 class="text-lg font-semibold text-gray-800 mt-4 mb-14">Recent Posts</h3>
            <div class="bg-transparent shadow rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 rounded-md">
                    <thead class="bg-gray-50 font-bold">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Title</th>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPosts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-700 truncate">{{ $post->title }}</td>
                                <td class="px-4 py-2 text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No recent posts
                                    found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4 text-center font-bold">
                    <a href="{{ route('user.posts') }}" class="text-sm">View All</a>
                </div>
            </div>


        </div>
    </div>
@endsection
