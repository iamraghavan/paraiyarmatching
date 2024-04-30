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
                                    <a href="#!" class="cta-dark-1 cta-dark">Register your Profile</a>
                                </div>
                            </div>
                            <div class="ban-search chosenini">
                                <form>
                                    <ul>
                                        <li class="sr-look">
                                            <div class="form-group">
                                                <label>I'm looking for</label>
                                                <select class="chosen-select">
                                                    <option value="">I'm looking for</option>
                                                    <option value="Men">Men</option>
                                                    <option value="Women">Women</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-age">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <select class="chosen-select">
                                                    <option value="">Age</option>

                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-reli">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="chosen-select">
                                                    <option>Religion</option>
                                                    <option>Any</option>
                                                    <option>Hindu</option>
                                                    <option>Muslim</option>
                                                    <option>Jain</option>
                                                    <option>Christian</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="sr-cit">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="chosen-select">
                                                    <option value="">Select a city</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </li>
                                        <li class="sr-btn">
                                            <input type="submit" value="Search">
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


