<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=vrising', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('online_players').textContent = `${data.online_players} / 60`;
    }
    setInterval(loadServerMetrics, 1000);
    loadServerMetrics();
</script>