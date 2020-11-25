<ul style="padding-left: 0">
    @if ($user->getting_started_level == 0)
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
    @else
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none getting-started-disable">
    @endif
        <span class="badge bg-success d-flex align-items-center mr-2 p-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
            </svg>
        </span>
        <p class="d-flex align-items-center h-100 mb-0 text-dark" style="line-height: 1.8rem">Konfirmasi Email</p>
    </a>

    @if ($user->getting_started_level == 1)
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
    @else
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none getting-started-disable">
    @endif
        <span class="badge bg-success d-flex align-items-center mr-2 p-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-lines-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </span>
        <p class="d-flex align-items-center h-100 mb-0 text-dark" style="line-height: 1.8rem">Informasi umum</p>
    </a>

    @if ($user->getting_started_level == 2)
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
    @else
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none getting-started-disable">
    @endif
        <span class="badge bg-success d-flex align-items-center mr-2 p-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                <path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
        </span>
        <p class="d-flex align-items-center h-100 mb-0 text-dark" style="line-height: 1.8rem">Alamat</p>
    </a>

    @if ($user->getting_started_level == 3)
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
    @else
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none getting-started-disable">
    @endif
        <span class="badge bg-success d-flex align-items-center mr-2 px-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card-2-front-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
            </svg>
        </span>
        <p class="d-flex align-items-center h-100 mb-0 text-dark" style="line-height: 1.8rem">KTP</p>
    </a>

    @if ($user->getting_started_level == 4)
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none">
    @else
    <a href="#" class="d-flex flex-row mb-3 text-decoration-none getting-started-disable">
    @endif
        <span class="badge bg-success d-flex align-items-center mr-2 px-2">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
        </span>
        <p class="d-flex align-items-center h-100 mb-0 text-dark" style="line-height: 1.8rem">Persetujuan</p>
    </a>
</ul>