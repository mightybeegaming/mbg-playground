<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=vrising', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('status_text').textContent = data.status_text;
        document.getElementById('latency_text').textContent = data.latency_text;
        document.getElementById('online_players').textContent = `${data.online_players} / 60`;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>