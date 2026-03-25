async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=counterStrike', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    displayCommonMetrics(data);

    let matchScore = '';
    matchScore += `<span class="highlight">Ts : ${data.scoreT}</span>`;
    matchScore += '<b> | </b>';
    matchScore += `<span class="highlight">CTs : ${data.scoreCt}</span>`;

    document.getElementById('matchScore').innerHTML = matchScore;
    document.getElementById('currentMap').textContent = data.currentMap;
    document.getElementById('nextMap').textContent = data.nextMap;

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();