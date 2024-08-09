<form wire:submit.prevent="submit" enctype="multipart/form-data">
    <div class="form-group">
        <label for="csv_file">Upload CSV File</label>
        <input type="file" id="csv_file" wire:model="csv_file" class="form-control">
        @error('csv_file') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="gap-4 mt-4 d-flex align-items-center justify-content-end">
        <button type="submit" class="btn btn-primary">Upload</button>
    </div>
</form>

<script>
document.addEventListener('livewire:load', function () {
    Livewire.on('bulk-clients-uploaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Clients Uploaded',
            text: 'Bulk clients have been uploaded successfully!',
            showConfirmButton: false,
            timer: 2000
        });
    });
});
</script>