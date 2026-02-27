<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=counterstrike', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        document.getElementById('online_players').textContent = `${data.online_players} / 32`;
        document.getElementById('score_t').textContent = `Ts : ${data.score_t}`;
        document.getElementById('score_ct').textContent = `CTs : ${data.score_ct}`;
        document.getElementById('current_map').textContent = data.current_map;
        document.getElementById('next_map').textContent = data.next_map;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>