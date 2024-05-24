@extends('pages.dashboard.layouts.app')
@section('dashboard-content')

<section>
    <div class="login pro-edit-update">
        <div class="container">
            <div class="row">
                <div class="inn">
                    <div class="rhs">

                            <form action="{{ route('horoscope.uploads') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="display:none;">
                                    <label for="user_pmid">User PM ID:</label>
                                    <input type="text" id="user_pmid" value="{{$user->pmid}}" name="user_pmid" required>
                                </div>
                                <div>
                                    <label for="horoscope">Horoscope PDF:</label>
                                    <input type="file" id="horoscope" name="horoscope" accept="application/pdf" required>
                                </div>
                                <div>
                                    <button type="submit">Upload</button>
                                </div>
                            </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
