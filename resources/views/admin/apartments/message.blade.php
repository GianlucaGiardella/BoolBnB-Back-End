@extends('admin.layouts.base')
@section('contents')
@forelse ($messages as $message)
            <div class="pb-4">
                <a class="d-inline-block" href="{{ route('admin.apartments.show', $message->apartment->id) }}"></a>
                <p>
                    email: {{ $message->email_sender }} >
                </p>
                <p class="ms_messageText">{{ $message->text_message }}</p>
                <div>{{ $message->created_at }}</div>
                <hr>
            </div>
        @empty
            Non ci sono messaggi!
        @endforelse
@endsection