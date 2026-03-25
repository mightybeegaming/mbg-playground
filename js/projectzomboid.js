async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=projectZomboid', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);
    
    let dateTime = '';
    dateTime += `<span class="highlight">${data.worldDate}</span>`;
    dateTime += '<b> | </b>';
    dateTime += `<span class="highlight">${data.worldTime}</span>`;

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / ${data.maxPlayers}`;
    document.getElementById('worldAge').textContent = `Day ${data.worldAge}`;
    document.getElementById('dateTime').innerHTML = dateTime;
    document.getElementById('season').textContent = data.season;
    document.getElementById('weather').textContent = data.weather;
    document.getElementById('temperature').textContent = `${data.temperature} °C`;

    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();