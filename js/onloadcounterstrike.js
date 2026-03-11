async function loadServerMetrics() {
    const request = await fetch('/php/server.php?method=getMetricsCounterStrike', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    let matchScore = '';
    if(data.scoreT && data.scoreCt) {
        matchScore += '<span class="highlight">Ts : ' + data.scoreT + '</span>';
        matchScore += '<b> | </b>';
        matchScore += '<span class="highlight">CTs : ' + data.scoreCt + '</span>';
    }

    document.getElementById('statusText').textContent = data.server.statusText;
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / 32';
    document.getElementById('matchScore').innerHTML = matchScore;
    document.getElementById('currentMap').textContent = data.currentMap;
    document.getElementById('nextMap').textContent = data.nextMap;
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();