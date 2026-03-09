async function loadServerMetrics() {
    const request = await fetch('/php/servermetrics.php?server=VRising', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    document.getElementById('statusText').textContent = data.server.statusText;
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 60`;
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();