<section>
    <div class="mb-4 space-y-3" id="form-alerts">

        {{-- info --}}
        @if (Session::get('info'))
            <div class="alert-box flex items-start gap-3 p-4 text-blue-800 bg-blue-100 border border-blue-200 rounded-lg relative transition-opacity duration-500">
                <span>{!! Session::get('info') !!}</span>
                <button type="button" class="absolute right-2 text-blue-500 hover:text-blue-800"
                    onclick="fadeOut(this.parentElement)">
                    &times;
                </button>
            </div>
        @endif

        {{-- danger --}}
        @if (Session::get('fail'))
            <div class="alert-box flex items-start gap-3 p-4 text-red-800 bg-red-100 border border-red-200 rounded-lg relative transition-opacity duration-500">
                <span>{!! Session::get('fail') !!}</span>
                <button type="button" class="absolute right-2 text-red-500 hover:text-red-800"
                    onclick="fadeOut(this.parentElement)">
                    &times;
                </button>
            </div>
        @endif

        {{-- success --}}
        @if (Session::get('success'))
            <div class="alert-box flex items-start gap-3 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg relative transition-opacity duration-500">
                <span>{!! Session::get('success') !!}</span>
                <button type="button" class="absolute right-2 text-green-500 hover:text-green-800"
                    onclick="fadeOut(this.parentElement)">
                    &times;
                </button>
            </div>
        @endif

    </div>

    {{-- Fade-out script --}}
    <script>
        function fadeOut(element) {
            element.classList.add("opacity-0");
            setTimeout(() => element.remove(), 300);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const alerts = document.querySelectorAll(".alert-box");
            alerts.forEach((alert) => {
                setTimeout(() => {
                    fadeOut(alert);
                }, 3000); // auto-dismiss after 3s
            });
        });
    </script>
</section>
