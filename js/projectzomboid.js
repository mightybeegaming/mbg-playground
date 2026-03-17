async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=projectZomboid', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);
    
    let dateTime = '';
    if(data.worldDate && data.worldTime) {
        dateTime += '<span class="highlight">' + data.worldDate + '</span>';
        dateTime += '<b> | </b>';
        dateTime += '<span class="highlight">' + data.worldTime + '</span>';
    }

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / ' + data.maxPlayers;
    document.getElementById('worldAge').textContent = data.worldAge + ' days';
    document.getElementById('dateTime').innerHTML = dateTime;
    document.getElementById('season').textContent = data.season;
    document.getElementById('weather').textContent = data.weather;
    document.getElementById('temperature').textContent = data.temperature + ' °C';

    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();