<form
    action="{{isset($post) ? route('post.update', $post) : route('post.store')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @if(isset($post))
        {{ method_field('PUT') }}
    @endif
    <div class="form-group">
        <label for="name">Name:</label>
        @if(isset($post))
            <input type="name" class="form-control" id="name" name="name" value="{{$post->name}}">
        @else
            <input type="name" class="form-control" id="name" name="name">
        @endif
    </div>

    <div class="form-group">
        <label for="file">Image:</label>
        <input type="file" name="file" id="file">
    </div>

    <div class="form-group">
        <select name="category_id" id="category_id">
            @if(isset($post))
                <option selected value="{{$post->category_id}}">{{$post->category->name}}</option>
            @endif
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
