@extends('components.__master')
@section('title') Notifikasi @endsection
@section('content')
@include('components._top_navigation')
<div class="container mb-5">
  <div class="row mt-3">
    <div class="col-12 p-0 shadow-sm mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="{{ url('/') }}">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              </svg>
            </a>
          </li>
          {{-- <li class="breadcrumb-item">
            <a href="/portofolio" class="text-decoration-none">Portofolio</a>
          </li> --}}
          <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
        </ol>
      </nav>
    </div>

    <div class="d-xl-block d-none col-12 bg-white shadow-sm" style="min-height: 500px">
      <div class="row">
        <div class="col-4" style="height: 500px; overflow-y: scroll">
          <div class="p-3">
            <ul class="list-group list-group-flush">
              @foreach ($notifications as $notification)
                <a class="list-group-item text-dark" href="/notification/{{ $notification->id }}">
                  <h6>{{ $notification->title }} @if($notification->status == 'unread')<span class="badge bg-success">Baru</span>@endif</h6>
                  <div style="height: 1.4rem; overflow-y: hidden">
                    <p class="mb-0">{!! $notification->body !!}</p>
                  </div>
                  <small>{{ date('d M Y H:i:s', strtotime($notification->created_at)) }}</small>
                </a>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-8 p-4">
          <div style="height: 100%">
            @if (!$notification_detail)
              <p>&nbsp;</p>
            @else
              <h4 class="mb-1">{{ $notification_detail->title }}</h4>
              <small>{{ date('d M Y - H:i:s', strtotime($notification_detail->created_at)) }}</small>
              <hr/>
              {!! $notification_detail->body !!}
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="d-xl-none d-block list-group bg-white" style="height: 600px; overflow-y: scroll">
      @foreach ($notifications as $notification)
        <a href="/notification/{{$notification->id}}/view" class="list-group-item list-group-item-action shadow-none border-0 shadow-sm">
          <div class="d-flex flex-row py-2">
            <div class="flex-fill">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 {{ $notification->status == 'unread' ? 'text-success' : 'text-dark' }}">{{ $notification->title }}</h5>
              </div>
              <p class="mb-1">{!! \Str::limit($notification->body, 100) !!}</p>
              <small class="text-muted">{{ $notification->created_at}}</small><br/>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>
@include('components._footer')
@endsection