async function loadServerMetrics() {
    const request = await fetch('/php/metrics?server=projectZomboid', {cache: 'no-store'});
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

    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = data.server.statusText;
    statusTextElement.classList.add(data.server.statusText);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();