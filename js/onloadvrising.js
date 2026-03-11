async function loadServerMetrics() {
    const request = await fetch('/php/server.php?method=getMetricsVRising', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    document.getElementById('statusText').textContent = data.server.statusText;
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / 60';
    document.getElementById('phase').textContent = data.phase;
    document.getElementById('timeLeft').textContent = data.timeLeft;
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();