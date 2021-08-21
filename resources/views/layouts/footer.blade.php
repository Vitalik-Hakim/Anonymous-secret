<footer class="footer footer-dark d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        <a href="{{ url('viral') }}" class="link-secondary">
                            {{ __('main.nav_viral') }}
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal--write--story" class="link-success strong">
                            {{ __('main.nav_submit_a_story') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        &copy; {{ date('Y') }} {{ $site_name }}
                    </li>
                    <li class="list-inline-item">
                        Made with <span class="text-red"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg></span> by <a href="" target="_blank" title="Number Pal - Portfolio" class="text-muted strong text-decoration-none"><span class="text-green">Number</span>Pal</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>