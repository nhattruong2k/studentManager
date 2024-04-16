<div class="card-body">
    @include('admin.layout.partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="mahocphan" class="control-label">{{ __('lophocphan.ma_hp') }}</label>
                <input type="text" name="Ma_hp" value="{{ $lophocphan->Ma_hp }}" class="form-control rounded-0"
                    id="mahocphan" readonly="true" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="tenhocphan" class="control-label required">{{ __('lophocphan.ten_hp') }}</label>
                <input type="text" name="Ten_hp" value="{{ $lophocphan->Ten_hp }}" class="form-control rounded-0"
                    id="tenhocphan" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="tenviettat" class="control-label">{{ __('lophocphan.tenviettat') }}</label>
                <input type="text" name="Ten_viet_tat" value="{{ $lophocphan->Ten_viet_tat }}"
                    class="form-control rounded-0" id="tenviettat" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="tinchi" class="control-label">{{ __('lophocphan.tinchi') }}</label>
                <input type="number" name="So_tc" value="{{ $lophocphan->So_tc ? $lophocphan->So_tc : 1 }}"
                    min="1" class="form-control rounded-0" id="tinchi" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="hinhthuchoc" class="control-label required">{{ __('lophocphan.hinhthuchoc') }}</label>
                <select name="hinh_thuc_hoc" id="hinh_thuc_hoc" class="custom-select rounded-0">
                    <option value="0">{{ __('lophocphan.hinh_thuc_hoc') }}</option>
                    <option
                        {{ $lophocphan->hinh_thuc_hoc == App\Libs\Constants::$hinhthuchoc['ly_thuyet'] ? 'selected' : '' }}
                        value="{{ App\Libs\Constants::$hinhthuchoc['ly_thuyet'] }}">{{ __('lophocphan.lythuyet') }}
                    </option>
                    <option
                        {{ $lophocphan->hinh_thuc_hoc == App\Libs\Constants::$hinhthuchoc['thuc_hanh'] ? 'selected' : '' }}
                        value="{{ App\Libs\Constants::$hinhthuchoc['thuc_hanh'] }}">{{ __('lophocphan.thuchanh') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="level" class="control-label required">{{ __('lophocphan.level') }}</label>
                <select name="level" id="level" class="custom-select rounded-0">
                    <option value="0">{{ __('lophocphan.academic_level') }}</option>
                    <option {{ $lophocphan->hinh_thuc_hoc == App\Libs\Constants::$level['caodang'] ? 'selected' : '' }}
                        value="{{ App\Libs\Constants::$level['caodang'] }}">{{ __('lophocphan.caodang') }}</option>
                    <option {{ $lophocphan->hinh_thuc_hoc == App\Libs\Constants::$level['daihoc'] ? 'selected' : '' }}
                        value="{{ App\Libs\Constants::$level['daihoc'] }}">{{ __('lophocphan.daihoc') }} </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="checkbox" id="thuctap" name="Thuc_tap" value="1"
            @if ($lophocphan->Thuc_tap ?? 0) checked @endif>
            <label for="thuctap">{{ __('lophocphan.thuctap') }}</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-info" id="btn_save"><i class="fa fa-save"></i>
                    {{ !$lophocphan->id ? __('common.create') : __('common.update') }}</button>
                <a href="{{ route(\App\Models\LopHocPhan::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                    {{ __('common.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript">
        $('#tenhocphan').on('keyup', function(e) {
            const tenhocphan = $(this).val();
            const ma_hp = tenhocphan.split(" ").map(word => word.charAt(0)).join("");
            const mahocphan = document.getElementById("mahocphan");
            mahocphan.value = ma_hp;
        });

        $('#form-lophocphan').validate({
            rules: {
                Ten_hp: {
                    required: true,
                    minlength: 3,
                    maxlength: 150,
                    remote: {
                        type: 'POST',
                        url: '{{ route('lophocphan-name-exist') }}',
                        dataType: 'json',
                        data: {
                            'Ten_hp': function() {
                                return $('#tenhocphan').val();
                            },
                            'id': function() {
                                return '{{ $lophocphan->id }}';
                            }
                        },
                    },
                },
                tinchi: {
                    regex: '^[0-9]{6}-[0-9]{4}$',
                },
                level: {
                    selectchecklevel: true
                },
                hinh_thuc_hoc: {
                    selectcheckhinhthuchoc: true
                },
            },
            messages: {
                Ten_hp: {
                    required: "{{ __('lophocphan.validation.name_empty') }}",
                    minlength: "{{ __('lophocphan.validation.name_min', ['amount' => 3]) }}",
                    maxlength: "{{ __('lophocphan.validation.name_max', ['amount' => 150]) }}",
                    remote: "{{ __('lophocphan.validation.name_exist') }}",
                }
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true);
            }
        });

        jQuery.validator.addMethod('selectchecklevel', function(value) {
            return (value != '0');
        }, "{{ __('lophocphan.validation.level') }}");

        jQuery.validator.addMethod('selectcheckhinhthuchoc', function(value) {
            return (value != '0');
        }, "{{ __('lophocphan.validation.hinhthuchoc') }}");
    </script>
@endsection
