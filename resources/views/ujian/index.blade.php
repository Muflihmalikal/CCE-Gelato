@extends('admin.layout.app')

@section('content')

<div class="main-container">
    <textarea id="editor" name="content"></textarea>
</div>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/filemanager?type=Images',
        filebrowserBrowseUrl: '/filemanager?type=Files'
    };
</script>
@endsection