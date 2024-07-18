<form wire:submit.prevent="submit" enctype="multipart/form-data">
    <div class="form-group">
        <label for="csv_file">Upload CSV File</label>
        <input type="file" id="csv_file" wire:model="csv_file" class="form-control">
        @error('csv_file') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

@if (session('status') === 'bulk-clients-uploaded')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Clients Uploaded',
                text: 'Bulk clients have been uploaded successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
