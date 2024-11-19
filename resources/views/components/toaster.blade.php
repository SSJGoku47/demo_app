<!-- resources/views/components/toaster.blade.php -->
<div class="d-flex justify-content-center">
    @if (session('success'))                                                                                         <!-- Success -->
        <div class="toaster alert alert-success alert-dismissible position-absolute fade show text-center mx-5" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))                                                                                           <!-- Error -->
        <div class="toaster alert alert-danger alert-dismissible position-absolute fade show text-center mx-5" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 115000);
    });
</script>

<style>


</style>