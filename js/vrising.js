async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=vRising', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / ${data.maxPlayers}`;
    document.getElementById('phase').textContent = data.phase;
    document.getElementById('timeLeft').textContent = data.timeLeft;
    document.getElementById('time').textContent = data.time;

    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();