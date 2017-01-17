<h4>Catégories</h4>
<div class="list-group">
    @foreach($categories as $category)
    <a href="{{ route('posts.category', ['slug' => $category->slug]) }}" class="list-group-item justify-content-between">
        {{ $category->name }}
        <span class="badge badge-default badge-pill badge-primary">{{ $category->posts_count }}</span>
    </a>
    @endforeach
</div>

<p>&nbsp;</p>

<h4>Last posts</h4>
<div class="list-group">
    @foreach($posts as $post)
    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}" class="list-group-item">
        {{ $post->name }}
    </a>
    @endforeach
</div>
