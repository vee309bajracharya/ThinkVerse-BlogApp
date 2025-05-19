<script>
    function fadeOut(element) {
        element.classList.add("opacity-0");
        setTimeout(() => element.remove(), 500);
    }

    function runFadeErrors() {
        document.querySelectorAll('.error-msg').forEach((el) => {
            setTimeout(() => fadeOut(el), 5000);
        });
    }

</script>
