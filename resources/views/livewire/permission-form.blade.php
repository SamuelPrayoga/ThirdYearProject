<div>
    <form wire:submit.prevent="save" method="post" novalidate enctype="multipart/form-data">
        @include('partials.alerts')

        <div class="w-100">
            <div class="mb-3">
                <x-form-label id="title" label='Alasan Utama Izin (Judul)' />
                <x-form-input id="title" name="title" wire:model.defer="permission.title" />
                <x-form-error key="permission.title" />
            </div>
            <div class="mb-3">
                <x-form-label id="description" label='Keterangan Izin (Alasan Lebih Lengkap)' />
                <textarea id="description" name="description" class="form-control"
                    wire:model.defer="permission.description"></textarea>
                <x-form-error key="permission.description" />
            </div>
            <div class="mb-3">
                <x-form-label id="file" label='Upload Bukti Izin' />
                <x-form-upload id="file" name="file" wire:model.defer="permission.file" />
                <x-form-error key="permission.file" />
            </div>

        </div>

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>
