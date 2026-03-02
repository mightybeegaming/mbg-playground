<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=get_metrics_projectzomboid', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('status_text').textContent = data.server.status_text;
        // document.getElementById('latency_text').textContent = data.server.latency_text;
        document.getElementById('uptime_24').textContent = data.server.uptime_24;
        document.getElementById('online_players').textContent = `${data.online_players} / 100`;
        document.getElementById('world_age').textContent = data.world_age;
        document.getElementById('world_date').textContent = data.world_date;
        document.getElementById('world_time').textContent = data.world_time;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>