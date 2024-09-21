@extends('dashboard.layout.app')
@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <form action="@isset($category)
                {{route("categories.update", $category->id)}}
            @else
                {{route("categories.store")}}
            @endisset"
                method="post"  enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" @isset($category) value="{{ $category->name }}" @endisset>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile"><span id='val'>Choose file</span></label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@isset($category)
                        Update
                        @else
                        Create
                    @endisset</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("input[type='file']").change(function () {
            $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
        })
    });
</script>
@endpush
