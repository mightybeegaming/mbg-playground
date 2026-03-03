<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=get_metrics_projectzomboid', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        let dateTime = '';
        if(data.world_date && data.world_time) {
            dateTime = `<span class="highlight">${data.world_date}</span>`;
            dateTime += '<b> | </b>';
            dateTime += `<span class="highlight">${data.world_time}</span>`;
        }

        let weatherTemp = '';
        if(data.weather && data.temperature) {
            weatherTemp = `<span class="highlight">${data.weather}</span>`;
            weatherTemp += '<b> | </b>';
            weatherTemp += `<span class="highlight">${data.temperature} °C</span>`;
        }

        document.getElementById('status_text').textContent = data.server.status_text;
        // document.getElementById('latency_text').textContent = data.server.latency_text;
        document.getElementById('uptime_24').textContent = data.server.uptime_24;
        document.getElementById('online_players').textContent = `${data.online_players} / 100`;
        document.getElementById('world_age').textContent = data.world_age;
        document.getElementById('datetime').innerHTML = dateTime;
        document.getElementById('weathertemp').innerHTML = weatherTemp;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>