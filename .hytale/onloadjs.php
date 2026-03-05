<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=hytale', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('statusText').textContent = data.server.statusText;
        // document.getElementById('latencyText').textContent = data.server.latencyText;
        document.getElementById('uptime24').textContent = data.server.uptime24;
        document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 100`;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>