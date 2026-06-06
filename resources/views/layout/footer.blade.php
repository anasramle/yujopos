    </div>

    @if (Auth::check() && Auth::user()->is_first_login)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let modalEl = document.getElementById('forcePasswordModal');
                if (modalEl) {
                    let modal = new bootstrap.Modal(modalEl, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    modal.show();
                }
            });
        </script>
    @endif

    <script>
        function clearAllCart() {
            localStorage.clear();
        }
    </script>

    <script>
        function handleLogout() {
            // Clear all cart data from localStorage
            Object.keys(localStorage).forEach(key => {
                if (key.startsWith('cart_')) {
                    localStorage.removeItem(key);
                }
            });
            document.getElementById('logoutForm').submit();
        }
    </script>

    <!-- Auto hide alert script -->
    <script>
        setTimeout(function() {
            let alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 7000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

    @if(session('logout'))
        <script>
            localStorage.clear();
        </script>
    @endif

</body>
</html>
