<script>
    async function loadServerMetrics() {
        const request = await fetch('<?=URL_SERVERMETRICS?>?server=ProjectZomboid', {cache: 'no-store'});
        const data = await request.json();
        // console.log(data);

        let dateTime = '';
        if(data.worldDate && data.worldTime) {
            dateTime = `<span class="highlight">${data.worldDate}</span>`;
            dateTime += '<b> | </b>';
            dateTime += `<span class="highlight">${data.worldTime}</span>`;
        }

        let weatherTemperature = '';
        if(data.weather && data.temperature) {
            weatherTemperature = `<span class="highlight">${data.weather}</span>`;
            weatherTemperature += '<b> | </b>';
            weatherTemperature += `<span class="highlight">${data.temperature} °C</span>`;
        }

        document.getElementById('statusText').textContent = data.server.statusText;
        document.getElementById('latencyText').textContent = data.server.latencyText;
        // document.getElementById('uptime24').textContent = data.server.uptime24;
        document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 100`;
        document.getElementById('worldAge').textContent = data.worldAge;
        document.getElementById('dateTime').innerHTML = dateTime;
        document.getElementById('weatherTemperature').innerHTML = weatherTemperature;
    }
    setInterval(loadServerMetrics, 5000);
    loadServerMetrics();
</script>