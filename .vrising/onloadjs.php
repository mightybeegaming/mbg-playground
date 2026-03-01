<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=get_metrics_vrising', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('status_text').textContent = data.server.status_text;
        // document.getElementById('latency_text').textContent = data.server.latency_text;
        document.getElementById('uptime_24').textContent = data.server.uptime_24;
        document.getElementById('online_players').textContent = `${data.online_players} / 60`;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>