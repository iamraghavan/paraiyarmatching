@extends('layouts.app')
@section('content')



 <!-- BANNER & SEARCH -->
    <section>
        <div class="str">
            <div class="hom-head">
                <div class="container">
                    <div class="row">
                        <div class="hom-ban">
                            <div class="ban-tit">
                                <span><i class="no1">#1</i> Matrimony</span>
                                <h1>Find your<br><b>Right Match</b> here</h1>
                                <p>Most trusted Matrimony Brand in Tamil Nadu.</p>


                                <div class="cta-full-wid">
                                    <a href="{{url('/app/register')}}" class="cta-dark-1 cta-dark">Register your Profile</a>
                                </div>
                            </div>
                            <div class="ban-search chosenini">

                                <form id="searchForm" action="{{ route('searchResult') }}" method="POST">
                                    @csrf
                                    <ul>
                                        <li class="sr-look">
                                            <div class="form-group">
                                                <label for="looking_for">I'm looking for</label>
                                                <select name="looking_for" class="chosen-select" required>
                                                    <option value="">I'm looking for</option>
                                                    <option value="male">Groom</option>
                                                    <option value="female">Bride</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-age">
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <select name="age" class="chosen-select" required>
                                                    <option value="">Age</option>
                                                    @for($i = 21; $i <= 40; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-reli">
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <select name="religion" class="chosen-select" required>
                                                    <option value="">Religion</option>
                                                    <option value="Any">Any</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Muslim">Muslim</option>
                                                    <option value="Jain">Jain</option>
                                                    <option value="Christian">Christian</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-cit">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city" class="chosen-select" required>
                                                    <option value="">Select a city</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-btn">
                                            <input style="background: #4681f4" type="submit" value="Search">
                                        </li>
                                    </ul>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

     <!-- BANNER SLIDER -->
     <section>
        <div class="hom-ban-sli">
            <div>
                <ul class="ban-sli">
                    <li>
                        <div class="image">
                            <img src="images/ban-bg.jpg" alt="" loading="lazy">
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>



@endsection


