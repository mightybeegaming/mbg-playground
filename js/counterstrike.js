async function loadServerMetrics() {
    const request = await fetch('/php/server.php?method=getMetricsCounterStrike', {cache: 'no-store'});
    const data = await request.json();
    console.log(data);

    let matchScore = '';
    if(data.scoreT && data.scoreCt) {
        matchScore += '<span class="highlight">Ts : ' + data.scoreT + '</span>';
        matchScore += '<b> | </b>';
        matchScore += '<span class="highlight">CTs : ' + data.scoreCt + '</span>';
    }

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / ' + data.maxPlayers;
    document.getElementById('matchScore').innerHTML = matchScore;
    document.getElementById('currentMap').textContent = data.currentMap;
    document.getElementById('nextMap').textContent = data.nextMap;

    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = data.server.statusText;
    statusTextElement.classList.add(data.server.statusText);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();