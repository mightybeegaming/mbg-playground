<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=hytale', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('online_players').textContent = `${data.online_players} / 100`;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>