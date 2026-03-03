<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=get_metrics_counterstrike', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        let matchScore = '';
        if(data.score_t && data.score_ct) {
            matchScore = `<span class="highlight">Ts : ${data.score_t}</span>`;
            matchScore += '<b> | </b>';
            matchScore += `<span class="highlight">CTs : ${data.score_ct}</span>`;
        }

        document.getElementById('status_text').textContent = data.server.status_text;
        // document.getElementById('latency_text').textContent = data.server.latency_text;
        document.getElementById('uptime_24').textContent = data.server.uptime_24;
        document.getElementById('online_players').textContent = `${data.online_players} / 32`;
        document.getElementById('match_score').innerHTML = matchScore;
        // document.getElementById('score_t').textContent = `Ts : ${data.score_t}`;
        // document.getElementById('score_ct').textContent = `CTs : ${data.score_ct}`;
        document.getElementById('current_map').textContent = data.current_map;
        document.getElementById('next_map').textContent = data.next_map;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>