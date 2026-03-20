async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=counterStrike', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    let matchScore = '';
    matchScore += '<span class="highlight">Ts : ' + data.scoreT + '</span>';
    matchScore += '<b> | </b>';
    matchScore += '<span class="highlight">CTs : ' + data.scoreCt + '</span>';

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / ' + data.maxPlayers;
    document.getElementById('matchScore').innerHTML = matchScore;
    document.getElementById('currentMap').textContent = data.currentMap;
    document.getElementById('nextMap').textContent = data.nextMap;

    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();