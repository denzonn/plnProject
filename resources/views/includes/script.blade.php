<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
</script>

<script>
    const notificationIcons = document.querySelectorAll('.notification-icon');

    notificationIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            icon.nextElementSibling.classList.toggle('hidden');
        });
    });
</script>