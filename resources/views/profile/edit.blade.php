@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- Update Profile --}}
        <div class="card mb-4">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="card mb-4">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card">
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
