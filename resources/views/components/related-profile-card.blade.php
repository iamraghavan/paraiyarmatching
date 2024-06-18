<div class="wedd-rel-box">
    <div class="wedd-rel-img">
        <img src="{{ $profile->profile_image }}" alt="">
        <span class="badge badge-success">{{ $profile->age }} Years old</span>
    </div>
    <div class="wedd-rel-con">
        <h5>{{ $profile->name }}</h5>
        <span>City: <b>{{ $profile->city }}</b></span>
    </div>
    <a href="{{ route('profile.details', $profile->id) }}" class="fclick"></a>
</div>
