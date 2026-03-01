<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=get_metrics_counterstrike', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('status_text').textContent = data.server.status_text;
        document.getElementById('latency_text').textContent = data.server.latency_text;
        document.getElementById('online_players').textContent = `${data.online_players} / 32`;
        document.getElementById('score_t').textContent = `Ts : ${data.score_t}`;
        document.getElementById('score_ct').textContent = `CTs : ${data.score_ct}`;
        document.getElementById('current_map').textContent = data.current_map;
        document.getElementById('next_map').textContent = data.next_map;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>