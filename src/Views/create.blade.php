@extends('rb28dett::layouts.master')
@section('icon', 'ion-plus-round')
@section('title', __('rb28dett_notifications::general.create_notification'))
@section('subtitle', __('rb28dett_notifications::general.create_notification_info'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('rb28dett::index') }}">@lang('rb28dett_notifications::general.home')</a></li>
        <li><a href="{{ route('rb28dett::notifications.index') }}">@lang('rb28dett_notifications::general.notifications')</a></li>
        <li><span>@lang('rb28dett_notifications::general.create_notification')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-body">
                        <form action="{{ route('rb28dett::notifications.store') }}" class="uk-form-stacked" method="POST">
                            {{ csrf_field() }}
                            <div class="uk-margin">
                                <div uk-grid class="uk-grid-small">
                                    <div class="uk-width-1-1@l uk-width-3-5@xl">
                                        <label class="uk-form-label">@lang('rb28dett_notifications::general.subject')</label>
                                        <div class="uk-form-controls">
                                            <input value="{{ old('subject') }}" name="subject" class="uk-input" type="text" placeholder="@lang('rb28dett_notifications::general.subject_ph')">
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1@l uk-width-2-5@xl">
                                        <label class="uk-form-label">@lang('rb28dett_notifications::general.user_email')</label>
                                        <div class="uk-form-controls">
                                            <input value="{{ old('email') }}" name="email" class="uk-input" type="email" placeholder="@lang('rb28dett_notifications::general.user_email_ph')">
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1">
                                        <label class="uk-form-label">@lang('rb28dett_notifications::general.message')</label>
                                        <div class="uk-form-controls">
                                            <textarea name="message" rows="8" class="uk-textarea" placeholder="@lang('rb28dett_notifications::general.message_ph')">{{ old('message') }}</textarea>
                                            <small class="uk-text-meta">@lang('rb28dett_notifications::general.markdown_accepted')</small>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-1">
                                        <button type="submit" class="uk-button uk-width-1-1 uk-button-primary">
                                            <span class="ion-forward"></span>&nbsp; @lang('rb28dett_notifications::general.send_notification')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l"></div>
        </div>
    </div>
@endsection
