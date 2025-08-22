<?php 

    use App\Models\ParentCategory;
    use App\Models\Category;
    use App\Models\Post;
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    // dynamic navigation
    function navigations($isMobile = false) {
        $html = '';
        $pcategories = ParentCategory::whereHas('children', fn($q) => $q->whereHas('posts'))->orderBy('name')->get();
        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name')->get();
    
        // Desktop View
        if (!$isMobile) {
            $html .= '<div class="flex items-center space-x-6">'; // Horizontal layout container
            
            foreach ($pcategories as $parent) {
                $html .= '
                    <div class="relative group">
                        <button class="hover:cursor-pointer hover:text-orange-400 focus:outline-none px-3 py-2 font-semibold">
                            ' . $parent->name . '
                        </button>
                        <div class="absolute hidden group-focus-within:flex flex-col bg-white mt-2 rounded shadow-lg z-50 min-w-[200px] border border-gray-200 dark:border-gray-700">
                ';
                foreach ($parent->children as $child) {
                    if ($child->posts->count() > 0) {
                        $html .= '
                            <a href="' . route('category_posts', $child->slug) . '" 
                               class="px-4 py-2 text-sm hover:bg-gray-100 transition-colors">
                                ' . $child->name . '
                            </a>
                        ';
                    }
                }
                $html .= '</div></div>';
            }
    
            foreach ($categories as $cat) {
                $html .= '<a href="' . route('category_posts', $cat->slug) . '" class="hover:underline px-3 py-2">' . $cat->name . '</a>';
            }
    
            $html .= '</div>'; // Close flex container
        }
        // Mobile View
        else {
            $html .= '<div class="space-y-3 py-4">'; // Vertical stack
            
            foreach ($pcategories as $parent) {
                $html .= '<div class="block">';
                $html .= '<span class="font-semibold">' . $parent->name . '</span>';
                foreach ($parent->children as $child) {
                    if ($child->posts->count() > 0) {
                        $html .= '<a href="' . route('category_posts', $child->slug) . '" class="block ml-4 mt-1">' . $child->name . '</a>';
                    }
                }
                $html .= '</div>';
            }
    
            foreach ($categories as $cat) {
                $html .= '<a href="' . route('category_posts', $cat->slug) . '" class="block py-1">' . $cat->name . '</a>';
            }
    
            $html .= '</div>'; // Close mobile container
        }
    
        return $html;
    }
    

    // date format
    if(!function_exists('date_formatter')){

        function date_formatter($value){
            return Carbon::createFromFormat('Y-m-d H:i:s', $value)->isoFormat('LL');
        }
    }

    // strip words
    if(!function_exists('words')){
        function words($value, $words = 15, $end = '...'){
            return Str::words(strip_tags($value),$words,$end);
        }
    }

    // calculate post reading duration
    if(!function_exists('readDuration')){
        function readDuration(...$text){
            Str::macro('timeCounter', function($text){
                $totalWords = str_word_count(implode(" ",$text));
                $minutesToRead = round($totalWords/200);
                return (int)max(1, $minutesToRead);
            });
            return Str::timeCounter($text);
        }
    }

    // display latest posts
    if(!function_exists('latest_posts')){
        function latest_posts($skip = 0, $limit = 5){
            return Post::skip($skip)
                        ->limit($limit)
                        ->where('visibility',1)
                        ->orderBy('created_at','desc')
                        ->get();
        }
    }

    //categories listing
    if(!function_exists('sidebar_categories')){
        function sidebar_categories($limit=8){
            return Category::withCount('posts')
                            ->having('posts_count', '>', 0)
                            ->limit($limit)
                            ->orderBy('posts_count', 'desc')
                            ->get();
        }
    }

    //tags listing
    if(!function_exists('getTags')){
        function getTags($limit = null){
            $tags = Post::where('tags','!=','')->pluck('tags');
            $uniqueTags = $tags->flatMap(function($tagsString){
                return explode(',', $tagsString);
            })->map(fn($tag)=>trim($tag))
            ->unique()
            ->sort()
            ->values();
            if($limit){
                $uniqueTags = $uniqueTags->take($limit);
            }
            return $uniqueTags->all();
        }
    }

    // latest posts listing
    if(!function_exists('sidebar_latest_posts')){
        function sidebar_latest_posts($limit=6, $except=null){
            $posts = Post::limit($limit);
            if($except){
                $posts = $posts->where('id', '!=', $except);
            }
            return $posts->where('visibility',1)
                        ->orderBy('created_at','desc')
                        ->get();
        }
    }


?>