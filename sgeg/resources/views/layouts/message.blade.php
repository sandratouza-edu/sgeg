@if (session()->has('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // Oculta el mensaje después de 3 segundos
    </script>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger" id="error-message">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 3000); // Oculta el mensaje después de 3 segundos
    </script>
@endif