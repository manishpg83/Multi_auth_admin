<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="true">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="additional-info-tab" data-toggle="tab" href="#additional-info" role="tab"
            aria-controls="additional-info" aria-selected="false">Additional Information</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $("#profile-form").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // Update the form fields with the new values
                        $("#first_name").val(response.first_name);
                        $("#last_name").val(response.last_name);
                        $("#company_name").val(response.company_name);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function(xhr) {
                    var response = JSON.parse(xhr.responseText);
                    var errors = response.errors;
                    var errorMessage = '';

                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessage += errors[key][0] + ' ';
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: errorMessage,
                        showConfirmButton: true
                    });
                }
            });
        });
    });
</script>
