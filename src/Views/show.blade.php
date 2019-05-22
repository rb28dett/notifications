@extends('rb28dett::layouts.master')
@section('icon', 'ion-eye')
@section('title', __('rb28dett_notifications::general.view_notification'))
@section('subtitle', __('rb28dett_notifications::general.notification_info', ['id' => $notification->id, 'created' => $notification->created_at->diffForHumans()]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('rb28dett::index') }}">@lang('rb28dett_notifications::general.home')</a></li>
        <li><a href="{{ route('rb28dett::notifications.index') }}">@lang('rb28dett_notifications::general.notifications')</a></li>
        <li><span>@lang('rb28dett_notifications::general.view_notification')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-body">
                        <article class="uk-article">
                            <h1 class="uk-article-title"><a class="uk-link-reset" href="">{{ $notification->data['subject'] }}</a></h1>
                            <p class="uk-article-meta">@lang('rb28dett_notifications::general.sent_by')
                                @if(array_key_exists('user', $notification->data) and $notification->data['user'])
                                    {{ $notification->data['user']['name'] }}
                                @else
                                    <span class='uk-label'>
                                        {{ \RB28DETT\Settings\Models\Settings::first()->appname }}
                                    </span>
                                @endif
                                {{ $notification->created_at->diffForHumans() }}
                                </p>
                            <p>
                                {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($notification->data['message']) !!}
                            </p>
                        </article>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
        </div>
    </div>
@endsection
