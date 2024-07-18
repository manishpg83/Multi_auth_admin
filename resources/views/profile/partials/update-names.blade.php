<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="additional-info-tab" data-toggle="tab" href="#additional-info" role="tab"
            aria-controls="additional-info" aria-selected="false">Additional Information</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="smtp-tab" data-toggle="tab" href="#smtp-settings" role="tab" aria-controls="smtp-settings"
            aria-selected="false">SMTP Settings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="upload-client-tab" data-toggle="tab" href="#upload-client" role="tab"
            aria-controls="upload-client" aria-selected="false">Upload Client</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="bulk-upload-client-tab" data-toggle="tab" href="#bulk-upload-client" role="tab"
            aria-controls="bulk-upload-client" aria-selected="false">Bulk Upload Client</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @livewire('user-profile-form-component')
    </div>
    <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
        @livewire('user-additional-info-component')
    </div>
    <div class="tab-pane fade" id="smtp-settings" role="tabpanel" aria-labelledby="smtp-tab">
        @livewire('smtp-form-component')
    </div>
    <div class="tab-pane fade" id="upload-client" role="tabpanel" aria-labelledby="upload-client-tab">
        @livewire('client-form-component')
    </div>
    <div class="tab-pane fade" id="bulk-upload-client" role="tabpanel" aria-labelledby="bulk-upload-client-tab">
        @livewire('bulk-client-upload-component')
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            var activeTabElement = document.getElementById(activeTab);
            if (activeTabElement) {
                activeTabElement.classList.add('active');
                activeTabElement.setAttribute('aria-selected', 'true');
                var tabPaneId = activeTabElement.getAttribute('href').substring(1);
                var tabPane = document.getElementById(tabPaneId);
                if (tabPane) {
                    tabPane.classList.add('show', 'active');
                }
            }
        } else {
            document.getElementById('profile-tab').classList.add('active');
            document.getElementById('profile-tab').setAttribute('aria-selected', 'true');
            document.getElementById('profile').classList.add('show', 'active');
        }

        var tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                localStorage.setItem('activeTab', this.id);
            });
        });
    });
</script>
