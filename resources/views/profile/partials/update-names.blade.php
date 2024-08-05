<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="additional-info-tab" data-toggle="tab" href="#additional-info" role="tab"
            aria-controls="additional-info" aria-selected="false">Additional Information</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @livewire('user-profile-form-component')
    </div>
    <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
        @livewire('user-additional-info-component')
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
