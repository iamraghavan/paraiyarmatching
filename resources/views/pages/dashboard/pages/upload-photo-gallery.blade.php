@extends('pages.dashboard.layouts.app')
@section('dashboard-content')



<div style="margin: 20rem">
    <form action="{{ route('gallery.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="images[]" multiple accept="image/*">
        <button type="submit">Upload</button>
    </form>


    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <td><img src="{{ url($image->image_url) }}" alt="Image"></td>
                <td>


                    <a onclick="return confirm('Are you sure you want to Delete ?')" href="{{ route('gallery.delete', $image->id) }}"><button class="mx-1 my-2 btn btn-danger">Delete</button></a>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>




@endsection
