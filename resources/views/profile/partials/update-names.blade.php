<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
    <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="true">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="additional-info-tab" data-toggle="tab" href="#additional-info" role="tab"
            aria-controls="additional-info" aria-selected="false">Additional Information</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="smtp-tab" data-toggle="tab" href="#smtp-settings" role="tab"
            aria-controls="smtp-settings" aria-selected="false">SMTP Settings</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @livewire('user-profile-form-component')
    </div>
    <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
        @livewire('user-additional-info-component')
    </div>
    <div class="tab-pane fade" id="smtp-settings" role="tabpanel" aria-labelledby="smtp-tab">
        @livewire('smtp-form-component')
    </div>
</div>

@if (session('status') === 'names-updated')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated',
                text: 'Your Profile has been updated successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
