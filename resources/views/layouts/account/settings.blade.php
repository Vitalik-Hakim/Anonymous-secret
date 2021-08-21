@extends('layouts.app')
@section('content')
<!--
* Latest Items Section
-->
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                {{ __('main.account_settings') }}
            </h2>
            <div class="page-pretitle">
                {{ __('main.account_hi_name', ['name' => Auth::user()->name]) }}
            </div>
        </div>
    </div>
</div>

<!-- Row -->
<div class="row row-cards">
    
    <div class="col-lg-3">
        @include('layouts.account.sidebar_settings')
    </div>

    <div class="col-lg-9">
        <form method="post" action="{{ url('settings/edit') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="card card-md mb-4 shadow">
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="7" cy="5" r="2" /><path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" /><circle cx="17" cy="5" r="2" /><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" /></svg>
                        </label>
                        <div class="col">
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                <option value="" {{ $user->genders_id == null ? 'selected' : '' }}>
                                    {{ __('Not selected') }}
                                </option>
                                @foreach($gendersList as $gender)
                                <option value="{{ $gender->id }}" {{ $gender->id == $user->genders_id ? 'selected' : '' }}>
                                    {{ $gender->name }}
                                </option>
                                @endforeach
                            </select>
                            
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>


                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="10" y1="16" x2="14" y2="16" /><line x1="12" y1="14" x2="12" y2="18" /></svg>
                        </label>
                        <div class="col">

                            <div class="row g-2">
                                <div class="col-5">
                                    <select name="month" class="form-select @error('month') is-invalid @enderror">
                                        <option value="">- Month</option>
                                        <option value="01" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "01" ? 'selected' : '' }}>January</option>
                                        <option value="02" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "02" ? 'selected' : '' }}>February</option>
                                        <option value="03" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "03" ? 'selected' : '' }}>March</option>
                                        <option value="04" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "04" ? 'selected' : '' }}>April</option>
                                        <option value="05" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "05" ? 'selected' : '' }}>May</option>
                                        <option value="06" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "06" ? 'selected' : '' }}>June</option>
                                        <option value="07" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "07" ? 'selected' : '' }}>July</option>
                                        <option value="08" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "08" ? 'selected' : '' }}>August</option>
                                        <option value="09" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "09" ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "10" ? 'selected' : '' }}>October</option>
                                        <option value="11" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "11" ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ Carbon::createFromDate($user->birth)->isoFormat('MM') == "12" ? 'selected' : '' }}>December</option>
                                    </select>
                                    
                                    @error('month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-3">
                                    <select name="day" class="form-select @error('day') is-invalid @enderror">
                                        <option value="">- Day</option>
                                        <option value="01" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "01" ? 'selected' : '' }}>1</option>
                                        <option value="02" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "02" ? 'selected' : '' }}>2</option>
                                        <option value="03" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "03" ? 'selected' : '' }}>3</option>
                                        <option value="04" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "04" ? 'selected' : '' }}>4</option>
                                        <option value="05" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "05" ? 'selected' : '' }}>5</option>
                                        <option value="06" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "06" ? 'selected' : '' }}>6</option>
                                        <option value="07" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "07" ? 'selected' : '' }}>7</option>
                                        <option value="08" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "08" ? 'selected' : '' }}>8</option>
                                        <option value="09" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "09" ? 'selected' : '' }}>9</option>
                                        <option value="10" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "10" ? 'selected' : '' }}>10</option>
                                        <option value="11" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "11" ? 'selected' : '' }}>11</option>
                                        <option value="12" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "12" ? 'selected' : '' }}>12</option>
                                        <option value="13" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "13" ? 'selected' : '' }}>13</option>
                                        <option value="14" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "14" ? 'selected' : '' }}>14</option>
                                        <option value="15" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "15" ? 'selected' : '' }}>15</option>
                                        <option value="16" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "16" ? 'selected' : '' }}>16</option>
                                        <option value="17" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "17" ? 'selected' : '' }}>17</option>
                                        <option value="18" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "18" ? 'selected' : '' }}>18</option>
                                        <option value="19" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "19" ? 'selected' : '' }}>19</option>
                                        <option value="20" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "20" ? 'selected' : '' }}>20</option>
                                        <option value="21" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "21" ? 'selected' : '' }}>21</option>
                                        <option value="22" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "22" ? 'selected' : '' }}>22</option>
                                        <option value="23" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "23" ? 'selected' : '' }}>23</option>
                                        <option value="24" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "24" ? 'selected' : '' }}>24</option>
                                        <option value="25" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "25" ? 'selected' : '' }}>25</option>
                                        <option value="26" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "26" ? 'selected' : '' }}>26</option>
                                        <option value="27" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "27" ? 'selected' : '' }}>27</option>
                                        <option value="28" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "28" ? 'selected' : '' }}>28</option>
                                        <option value="29" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "29" ? 'selected' : '' }}>29</option>
                                        <option value="30" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "30" ? 'selected' : '' }}>30</option>
                                        <option value="31" {{ Carbon::createFromDate($user->birth)->isoFormat('DD') == "31" ? 'selected' : '' }}>31</option>
                                    </select>
                                    
                                    @error('day')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-4">
                                    <select name="year" class="form-select @error('year') is-invalid @enderror">
                                        <option value="">- Year</option>
                                        <option value="2005"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2005" ? 'selected' : '' }}>2005</option>
                                        <option value="2004"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2004" ? 'selected' : '' }}>2004</option>
                                        <option value="2003"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2003" ? 'selected' : '' }}>2003</option>
                                        <option value="2002"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2002" ? 'selected' : '' }}>2002</option>
                                        <option value="2001"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2001" ? 'selected' : '' }}>2001</option>
                                        <option value="2000"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "2000" ? 'selected' : '' }}>2000</option>
                                        <option value="1999"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1999" ? 'selected' : '' }}>1999</option>
                                        <option value="1998"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1998" ? 'selected' : '' }}>1998</option>
                                        <option value="1997"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1997" ? 'selected' : '' }}>1997</option>
                                        <option value="1996"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1996" ? 'selected' : '' }}>1996</option>
                                        <option value="1995"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1995" ? 'selected' : '' }}>1995</option>
                                        <option value="1994"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1994" ? 'selected' : '' }}>1994</option>
                                        <option value="1993"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1993" ? 'selected' : '' }}>1993</option>
                                        <option value="1992"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1992" ? 'selected' : '' }}>1992</option>
                                        <option value="1991"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1991" ? 'selected' : '' }}>1991</option>
                                        <option value="1990"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1990" ? 'selected' : '' }}>1990</option>
                                        <option value="1989"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1989" ? 'selected' : '' }}>1989</option>
                                        <option value="1988"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1988" ? 'selected' : '' }}>1988</option>
                                        <option value="1987"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1987" ? 'selected' : '' }}>1987</option>
                                        <option value="1986"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1986" ? 'selected' : '' }}>1986</option>
                                        <option value="1985"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1985" ? 'selected' : '' }}>1985</option>
                                        <option value="1984"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1984" ? 'selected' : '' }}>1984</option>
                                        <option value="1983"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1983" ? 'selected' : '' }}>1983</option>
                                        <option value="1982"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1982" ? 'selected' : '' }}>1982</option>
                                        <option value="1981"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1981" ? 'selected' : '' }}>1981</option>
                                        <option value="1980"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1980" ? 'selected' : '' }}>1980</option>
                                        <option value="1979"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1979" ? 'selected' : '' }}>1979</option>
                                        <option value="1978"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1978" ? 'selected' : '' }}>1978</option>
                                        <option value="1977"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1977" ? 'selected' : '' }}>1977</option>
                                        <option value="1976"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1976" ? 'selected' : '' }}>1976</option>
                                        <option value="1975"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1975" ? 'selected' : '' }}>1975</option>
                                        <option value="1974"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1974" ? 'selected' : '' }}>1974</option>
                                        <option value="1973"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1973" ? 'selected' : '' }}>1973</option>
                                        <option value="1972"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1972" ? 'selected' : '' }}>1972</option>
                                        <option value="1971"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1971" ? 'selected' : '' }}>1971</option>
                                        <option value="1970"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1970" ? 'selected' : '' }}>1970</option>
                                        <option value="1969"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1969" ? 'selected' : '' }}>1969</option>
                                        <option value="1968"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1968" ? 'selected' : '' }}>1968</option>
                                        <option value="1967"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1967" ? 'selected' : '' }}>1967</option>
                                        <option value="1966"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1966" ? 'selected' : '' }}>1966</option>
                                        <option value="1965"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1965" ? 'selected' : '' }}>1965</option>
                                        <option value="1964"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1964" ? 'selected' : '' }}>1964</option>
                                        <option value="1963"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1963" ? 'selected' : '' }}>1963</option>
                                        <option value="1962"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1962" ? 'selected' : '' }}>1962</option>
                                        <option value="1961"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1961" ? 'selected' : '' }}>1961</option>
                                        <option value="1960"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1960" ? 'selected' : '' }}>1960</option>
                                        <option value="1959"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1959" ? 'selected' : '' }}>1959</option>
                                        <option value="1958"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1958" ? 'selected' : '' }}>1958</option>
                                        <option value="1957"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1957" ? 'selected' : '' }}>1957</option>
                                        <option value="1956"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1956" ? 'selected' : '' }}>1956</option>
                                        <option value="1955"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1955" ? 'selected' : '' }}>1955</option>
                                        <option value="1954"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1954" ? 'selected' : '' }}>1954</option>
                                        <option value="1953"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1953" ? 'selected' : '' }}>1953</option>
                                        <option value="1952"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1952" ? 'selected' : '' }}>1952</option>
                                        <option value="1951"{{ Carbon::createFromDate($user->birth)->isoFormat('YYYY') == "1951" ? 'selected' : '' }}>1951</option>
                                    </select>
                                    
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                          </div>
                        
                            
                        </div>
                    </div>
                    
                </div>
            </div>
                    
                    
            <div class="card card-md shadow">
                
                <div class="card-body">

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_avatar') }}</label>
                        <div class="col">
                            
                            @if(!empty($user->avatar))
                            <div class="mb-2">
                                <span class="avatar avatar-md" style="background-image: url({{ url('storage/app/public/images/avatar/'.Auth::user()->avatar) }})">
                                    <a href="{{ url('settings/avatar/delete') }}" title="{{ __('main.btn_delete') }}">
                                        <span class="avatar-upload-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                        </span>
                                    </a>
                                </span>
                            </div>
                            @endif
                            
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_username') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Username" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_email') }}</label>
                        <div class="col">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{ !empty(old('email')) ? old('email') : $user->email }}">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_bio') }}</label>
                        <div class="col">
                            <textarea class="form-control @error('bio') is-invalid @enderror" rows="4" name="bio">{{ !empty(old('bio')) ? old('bio') : $user->bio }}</textarea>

                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_website') }}</label>
                        <div class="col">
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="Website" value="{{ !empty(old('website')) ? old('website') : $user->website }}">
                            
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_twitter') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" placeholder="Twitter" value="{{ !empty(old('twitter')) ? old('twitter') : $user->twitter }}">
                            
                            @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_instagram') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="Instagram" value="{{ !empty(old('instagram')) ? old('instagram') : $user->instagram }}">
                            
                            @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_tiktok') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('tiktok') is-invalid @enderror" name="tiktok" placeholder="Tiktok" value="{{ !empty(old('tiktok')) ? old('tiktok') : $user->tiktok }}">
                            
                            @error('tiktok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_telegram') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('telegram') is-invalid @enderror" name="telegram" placeholder="Telegram" value="{{ !empty(old('telegram')) ? old('telegram') : $user->telegram }}">
                            
                            @error('telegram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    

                    <div class="hr-text hr-text-left text-red">{{ __('main.account_tagline_new_password') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_new_password') }}</label>
                        <div class="col">
                            <input type="password" class="form-control form-control-lg @error('new_password') is-invalid @enderror" name="new_password" placeholder="{{ __('main.account_new_password') }}" value="{{ old('new_password') }}">
                            
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('main.account_repeat_new_password') }}</label>
                        <div class="col">
                            <input type="password" class="form-control form-control-lg @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" placeholder="{{ __('main.account_repeat_new_password') }}" value="{{ old('new_confirm_password') }}">
                            
                            @error('new_confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>{{ __('main.btn_update') }}
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection('content')