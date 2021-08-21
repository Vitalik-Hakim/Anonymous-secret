<div class="card shadow mb-4">
    
    <div class="card-body">
        <h2 class="form-label">{{ __('main.card_comments_header', ['count' => $item->comments()->count()]) }}</h2>
        <form method="POST" action="{{ route('store') }}" role="form" id="post-comment">
            @csrf
            <div class="row">
                <div class="col">
                    <textarea type="text" class="form-control form-control-flush @error('comment_text') is-invalid @enderror" rows="2" name="comment_text" placeholder="{{ __('main.card_add_public_comment') }}">{{ old('comment_text') }}</textarea>

                    @error('comment_text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="col-auto">
                    <input type="hidden" id="recipient_id" name="recipient_id" value="{{ $item->user_id }}">
                    <input type="hidden" id="item_id" name="item_id" value="{{ $item->id }}">
                    <button class="btn w-100">
                        {{ __('main.btn_send') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body card-body-scrollable card-body-scrollable-shadow" style="height: calc(24rem + 10px)">
        <div class="divide-y-4">
            @forelse($item->comments() as $comment)
            <div class="row" id="comment-{{ $comment->id }}">
                <div class="col-auto">
                    <a href="{{ url('profile/@'.$comment->user()->name) }}">
                        <span class="avatar rounded" @if(!empty($comment->user()->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$comment->user()->avatar) }})" @endif>
                            @if(empty($comment->user()->avatar))
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            @endif

                            @if(Cache::has('user-is-online-' . $comment->user_id))
                            <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                            @else
                            <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                            @endif
                        </span>
                    </a>
                </div>
                <div class="col">
                    <div class="text-muted">
                        <a href="{{ url('profile/@'.$comment->user()->name) }}"><strong>{{ $comment->user()->name }}</strong></a> @if($item->user_id == $comment->user_id)<span class="badge badge-pill bg-red">{{ __('OP')}}</span>@endif {{ $comment->comment_text }}
                    </div>
                    <div class="text-muted">{{ Carbon::parse($comment->created_at)->diffForHumans() }}</div>
                </div>

                @if($comment->user_id == Auth::id())
                <div class="col-auto">
                    <a href="javascript:void(0);" onclick="deleteComment({{ $comment->id }})" class="btn btn-link btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                    </a>
                </div>
                @endif

            </div>

            @empty
            <div class="empty">
                <div class="empty-img">
                    <img src="{{ asset('resources/views/assets/img/comments.svg') }}" alt="">
                </div>
                <p class="empty-title">{{ __('main.card_there_are_no_comments') }}</p>
            </div>
            @endforelse

        </div>
    </div>
</div>
