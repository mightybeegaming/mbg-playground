async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=hytale', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    let worldAge = '';
    worldAge += '<span class="highlight">Day ' + data.dayOfYear + '</span>';
    worldAge += '<b> | </b>';
    worldAge += '<span class="highlight">Year ' + data.year + '</span>';

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / ' + data.maxPlayers;
    document.getElementById('worldAge').innerHTML = worldAge;
    document.getElementById('moonPhase').textContent = data.moonPhase + ' phase';

    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();