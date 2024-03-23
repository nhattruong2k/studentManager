<div class="card-body">
    @include('admin.layout.partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name" class="control-label required">{{ __('roles.name') }}</label>
                <input type="text" name="name" value="{{ $role->name }}"  class="form-control" id="name"
                    placeholder=" {{ __('roles.name') }}" autocomplete="off" autofocus="true" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">{{ __('common.description') }}</label>
                {!! Form::textArea('description', $role->description, array('class' => 'form-control', 'maxlength' => 50, 'id' => 'description', 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('is_visible', 1, $role->is_visible ?? 1, array('id' => 'is_visible')) !!}
                <label for="is_visible">{{__('common.is_visible')}}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>
                <input type="checkbox" class="check_all">
                {{ __('common.checkedAll') }}
            </label>
        </div>
        @foreach ($permissions as $item)
            <div class="col-md-12">
                <div class="card border-primary mb-4" id="card">
                    <div class="card-header bg-primary text-white">
                        <label>
                            <input type="checkbox" id="child_{{ $item->key_code }}" value="{{ $item->id }}"
                                name="permission_id[]" class="checkbox_all"
                                {{ isset($permissionsChecked) ? ($permissionsChecked->contains('id', $item->id) ? 'checked' : '') : '' }}>
                        </label>
                        {{ $item->name }}
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($item->permissionChildrent as $value)
                                <div class="card-body text-primary col-md-3">
                                    <h5 class="card-title">
                                        <label>
                                            <input type="checkbox" class="checkbox_childrent child_{{ $value->type }}"
                                                data-code="child_{{ $value->type }}" name="permission_id[]"
                                                {{ isset($permissionsChecked) ? ($permissionsChecked->contains('id', $value->id) ? 'checked' : '') : '' }}
                                                value="{{ $value->id }}">
                                        </label>
                                        {{ $value->name }}
                                    </h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info" id="btn_save"><i class="fa fa-save">
            {{ __('common.create') }}</i></button>
    <a href="{{ route(\App\Models\Roles::LIST) }}" class="btn btn-default"><i class="fa fa-reply">
            {{ __('common.cancel') }}</i></a>
</div>
<script type="text/javascript">
    mn_selected = 'mn_roles';
</script>
@section('script')
    <script type="text/javascript">
        $(function() {
            $('.checkbox_all').on('click', function() {
                $(this).parents('#card').find('.checkbox_childrent').prop('checked', $(this).prop(
                    'checked'));
                let all_checkbox = $('.checkbox_all').length
                let all_checkbox_checked = $('.checkbox_all:checked').length
                if (all_checkbox == all_checkbox_checked) {
                    $('.check_all').prop('checked', $(this).prop('checked'));
                } else {
                    $('.check_all').prop('checked', false);
                }
            });

            $('.check_all').on('click', function() {
                $(this).parents('').find('.checkbox_all').prop('checked', $(this).prop('checked'));
                $(this).parents('').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            });
        });


        var checked = $('input[class=checkbox_all]:checked').length;
        var checked_dis = $('input[class=checkbox_all_dis]:checked').length;
        var count = '<?php echo count(config('permission.access')); ?>'
        if (count == (checked + checked_dis)) {
            $('.check_all').attr('checked', true)
        }

        $('.checkbox_childrent').click(function() {
            let code = $(this).data('code');
            var count_child_all = $('.' + code).length;
            var count_child_checked = $('input.' + code + ':checked').length;
            if (count_child_all == count_child_checked) {
                $('#' + code).prop('checked', $(this).prop('checked'));
            } else {
                $('#' + code).prop('checked', false)
            }
        });

        $("#form-roles").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 50,
                    remote: {
                        type: 'post',
                        url: '{{ route('role-name-exist') }}',
                        headers: {
                            "Accept": "application/json",
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        },
                        data: {
                            'name': function() {
                                return $('#name').val();
                            },
                            'id': function() {
                                return '{{ $role->id }}';
                            }
                        }
                    },
                },
            },
            messages: {
                name: {
                    required: "{{ __('roles.name_empty') }}",
                    minlength: "{{ __('roles.name_min', ['amount' => 4]) }}",
                    maxlength: "{{ __('roles.name_max', ['amount' => 50]) }}",
                    remote: "{{ trans('roles.name_exist') }}"
                },
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });
    </script>
@endsection
