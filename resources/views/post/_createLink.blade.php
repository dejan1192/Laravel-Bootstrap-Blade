<div class="card p-2 mb-3">
    <h5 class="text-center"><i class="fas fa-cog"></i> Utils</h5>

    <a class="text-center" href="{{ route('users.show', Auth::user()) }}"><i class="fas fa-user-alt"></i> View profile</a>

    <a class="text-center" href="{{ route('users.edit', Auth::user()) }}"><i class="fas fa-user-edit"></i> Edit profile</a>

    <a class="text-center" href="{{ route('posts.create') }}"><i class="fas fa-plus-circle"></i> Create new post</a>

    <a href="{{ route('tags.create') }}" class="text-center"><i class="fas fa-tags"></i> Create new tag</a>

    

</div>