async function loadServerMetrics() {
    const request = await fetch('/php/server.php?method=getMetricsVRising', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    let incursionPhase = '';
    if(data.phase && data.timeLeft) {
        incursionPhase += `<span class="highlight">${data.phase}</span>`;
        incursionPhase += '<b> | </b>';
        incursionPhase += `<span class="highlight">${data.timeLeft} minutes</span>`;
    }

    document.getElementById('statusText').textContent = data.server.statusText;
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 60`;
    document.getElementById('incursionPhase').innerHTML = incursionPhase;
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();