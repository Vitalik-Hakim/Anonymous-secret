<div class="col-lg-3">
    <div class="card mb-3 shadow @if($item->featured == 1) card-featured @endif">
        <div class="card-header {{ $item->gender->bg_color }}">
            <div class="col text-truncate">
                <a href="{{ route('show', ['id'=>$item->id, 'slug'=>$item->slug]) }}" class="text-white text-decoration-none">
                    <h3 class="card-title">
                        {{ $item->gender->name }} - {{ __('main.years_old', ['age' => $item->age]) }}
                    </h3>
                </a>
            </div>

            <div class="col-auto">
                <div class="dropdown">
                    <a href="#" class="card-dropdown text-white" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled " width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="5" cy="9" r="1" /><circle cx="5" cy="15" r="1" /><circle cx="12" cy="9" r="1" /><circle cx="12" cy="15" r="1" /><circle cx="19" cy="9" r="1" /><circle cx="19" cy="15" r="1" /></svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        @if(Auth::check() && Auth::id() == $item->user_id || Auth::check() && Auth::user()->isAdministrator())
                        <!-- actions enabled by the post user -->
                        <a href="{{ route('delete_user_post', $item->id) }}" onclick="return confirm('Do you confirm this operation?');" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> 
                            {{ __('main.card_delete') }}
                        </a>
                        <!-- end actions enabled by the post user -->
                        @endif

                        <a href="{{ route('report', $item->id) }}" onclick="return confirm('Do you confirm this operation?');" class="dropdown-item text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="5" x2="5" y2="21" /><line x1="19" y1="5" x2="19" y2="14" /><path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0" /><path d="M5 14a5 5 0 0 1 7 0a5 5 0 0 0 7 0" /></svg>
                            {{ __('main.card_report') }}
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">
            <h3 class="card-title text-truncate text-muted">
                {{ $item->title }}
            </h3>
            
            <p class="h3">
                {{ Str::limit($item->story, $story_preview_chars) }}
            </p>

            <p>
                @foreach($item->tags as $tag)
                <a href="{{ route('tag', ['slug' => $tag->slug]) }}" class="badge bg-azure-lt">
                    {{ $tag->slug }}
                </a>
                @endforeach
            </p>
        </div>



        <div class="card-footer">
            <div class="row g-2 mb-2 align-items-center">
                <div class="col">
                    <a href="javascript:void(0);" onclick="likePost({{ $item->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" id="like-icon-{{ $item->id }}" class="icon @if(Auth::check()) @if(Auth::user()->hasLiked($item)) icon-filled text-danger @else text-muted @endif @else text-muted @endif" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                    </a>
                </div>

                <!-- share -->
                <div class="col-auto">

                    <span class="dropdown">
                        <a href="" class="text-muted" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><line x1="10" y1="14" x2="20" y2="4" /><polyline points="15 4 20 4 20 9" /></svg>
                        </a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item text-success strong" href="whatsapp://send?text={{ url('view/'.$item->id.'/'.$item->slug) }}" data-action="share/whatsapp/share">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-success strong" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" /></svg>
                                {{ __('Whatsapp') }}
                            </a>
                            <a class="dropdown-item" href="http://www.facebook.com/sharer/sharer.php?u={{ url('view/'.$item->id.'/'.$item->slug) }}&t={{ $item->title }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                                {{ __('Facebook') }}
                            </a>
                            <a class="dropdown-item" href="https://twitter.com/share?url={{ url('view/'.$item->id.'/'.$item->slug) }}&text={{ $item->title }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                                {{ __('Twitter') }}
                            </a>
                        </div>
                    </span>

                </div>
                <!-- end share -->

                <!-- bookmark -->
                <div class="col-auto">
                    <a href="javascript:void(0);" onclick="savePost({{ $item->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" id="save-icon-{{ $item->id }}" class="icon @if(Auth::check()) @if(Auth::user()->hasFavorited($item)) icon-filled @else text-muted @endif @else text-muted @endif" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h6a2 2 0 0 1 2 2v14l-5 -3l-5 3v-14a2 2 0 0 1 2 -2" /></svg>
                    </a>
                </div>
                <!-- end bookmark -->
            </div>

            <div class="row small">

                <div class="col-auto d-flex align-items-center pe-2">
                    <span class="text-muted text-truncate"> 
                        <span id="like-{{ $item->id }}">@json($item->likers()->count())</span> {{ __('main.card_likes') }}
                    </span>
                </div>

                <div class="col d-flex align-items-center pe-2">
                    <span class="text-muted text-truncate">
                        {{ $item->itemView() }} {{ __('main.card_views') }}
                    </span>
                </div>

                <div class="col-auto align-items-center">
                    <a href="{{ route('show', ['id'=>$item->id, 'slug'=>$item->slug]) }}" class="text-muted text-truncate">
                        {{ __('main.card_comments', ['count' => $item->comments()->count()]) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>