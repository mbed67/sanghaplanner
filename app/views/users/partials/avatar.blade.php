<a href="{{ route('profile_path', $user->id) }}">
    <img class="media-object img-circle avatar" src="{{ $user->present()->gravatar(isset($size) ? $size : 30) }}" alt="{{ $user->id }}">
</a>