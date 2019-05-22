@extends('rb28dett::layouts.master')
@section('icon', 'ion-android-notifications')
@section('title', __('rb28dett_notifications::general.notifications'))
@section('subtitle', __('rb28dett_notifications::general.notifications_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('rb28dett::index') }}">@lang('rb28dett_notifications::general.home')</a></li>
        <li><span>@lang('rb28dett_notifications::general.notifications')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('rb28dett_notifications::general.notifications')
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('rb28dett_notifications::general.status')</th>
                                        <th>@lang('rb28dett_notifications::general.subject')</th>
                                        <th>@lang('rb28dett_notifications::general.date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user->notifications as $notification)
                                        <tr>
                                            <td>
                                                @if ($notification->unread())
                                                    <span class="uk-label uk-label-success">@lang('rb28dett_notifications::general.unread')</span>
                                                @else
                                                    <span class="uk-label uk-label-warning">@lang('rb28dett_notifications::general.read')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="" href="{{ route('rb28dett::notifications.show', ['notification' => $notification->id]) }}">
                                                    {{ $notification->data['subject'] }}
                                                </a>
                                            </td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
        </div>
    </div>
@endsection
