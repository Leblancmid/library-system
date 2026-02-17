@if (session('status'))
    <div class="flash">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="errors">
        <strong>Fix these:</strong>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif