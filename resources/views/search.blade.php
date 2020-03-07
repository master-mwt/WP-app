@extends('layouts.exskel')

@section('content')

<div class="container"></div>
    <div class="row justify-content-center">

        <h1 class="text-center">POSTS</h1>

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($posts as $post)
            <p class="text-center">{{ $post->title }}</p>
        @endforeach
        {{ $posts->links() }}
        </div>
        
        <h1 class="text-center">USERS</h1>

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($users as $user)
            <p class="text-center">{{ $user->name }}</p>
        @endforeach
        {{ $users->links() }}
        </div>
        
        <h1 class="text-center">CHANNELS</h1>

        <div class="col-md-12 text-center infinite-scroll px-0">
        @foreach($channels as $channel)
            <p class="text-center">{{ $channel->title }}</p>
        @endforeach
        {{ $channels->links() }}
        </div>

    </div>
</div>

<!-- JScroll func -->
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('document').ready(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="spinner-grow text-primary" role="status"><span class="sr-only">loading...</span></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            }); 
        });
    });
</script>

@endsection