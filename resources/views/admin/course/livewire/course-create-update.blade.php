<div class="card card-primary card-outline mb-4" id="crudCourseModal" wire:ignore.self>
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title" wire:loading.remove wire:target="modalSetup">
            @if ($action == 'create')
                Thêm mới khóa học
            @elseif ($action == 'update')
                Chỉnh sửa khóa học
            @endif
        </div>
    </div>
    <div class="container py-4" wire:loading wire:target="modalSetup">
        <div class="row align-items-center justify-content-center">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="ml-2">Vui lòng đợi</span>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form wire:submit.prevent="{{ $action }}">
        <!--begin::Body-->
        <div class="card-body" wire:loading.remove wire:target="modalSetup">
            <div class="mb-3">
                <label class="form-label">Tên khóa học</label>
                <input type="text" class="form-control" wire:model.lazy="ten_khoa_hoc" />
                @error('ten_khoa_hoc')
                    <div class="form-text">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input class="form-control" type="date" name="start_date" required='required'
                        wire:model.lazy="start_date">
                    @error('start_date')
                        <div class="form-text">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-6">
                    <label class="form-label">Ngày kết thúc</label>
                    <input class="form-control" type="date" name="end_date" required='required'
                        wire:model.lazy="end_date">
                    @error('end_date')
                        <div class="form-text">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!--end::Footer-->
    </form>
    <!--end::Form-->
</div>
