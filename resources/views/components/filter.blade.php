@props(['btn' => 'btn--info'])
<div class="input-group w-auto flex-fill">
    <select name="status" class="form-control">
        <option >@lang('All')</option>
        <option value="{{\App\Constants\Status::ENABLE}}" @selected(\App\Constants\Status::ENABLE == request()->status)>@lang('Enable')</option>
        <option value="{{\App\Constants\Status::DISABLE}}" @selected((\App\Constants\Status::DISABLE == request()->status) && (request()->status !== null))>@lang('Disable')</option>
    </select>
    <button class="btn {{ $btn }}"  type="submit"><i class="la la-search"></i></button>
</div>
