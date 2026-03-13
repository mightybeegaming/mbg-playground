async function loadServerMetrics() {
    const request = await fetch('/php/server.php?method=getMetricsValheim', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = data.server.uptime24 + ' %';
    document.getElementById('onlinePlayers').textContent = data.onlinePlayers + ' / ' + data.maxPlayers;
    document.getElementById('worldAge').textContent = data.worldAge + ' days';

    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = data.server.statusText;
    statusTextElement.classList.add(data.server.statusText);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();