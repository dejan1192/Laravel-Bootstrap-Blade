<p class="d-flex" >

    
    @foreach($tags as $tag)
    <a href="#" class="badge badge-primary mr-2">{{$tag->name}}</a>
    @endforeach
</p>